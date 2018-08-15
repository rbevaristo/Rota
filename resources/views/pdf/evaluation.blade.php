<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="text-center">
            <h1>{{ $data['company']['name'] }}</h1>
            <h6>{{ $data['company']['location'] }}</h6>
            <h6>{{ $data['company']['email'] }}</h6>
            <h6>{{ $data['company']['contact'] }}</h6>
        </div>
        <br>
        Name: <strong>{{ $data['employee']['firstname'] }} {{ $data['employee']['lastname'] }}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Date: <strong>{{ date('F d, Y') }} </strong></span><br>
        Employee ID: <strong> {{ $data['employee']['username'] }} </strong> <br>
        <div class="text-center">
            <h3>Performance Evaluation</h3>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Factors</th>
                        <th>Description</th>
                        <th>Evaluation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['results'] as $key => $eval)
                        <tr style="padding-bottom: 5px;">
                            <td>
                                {{ $key }}
                            </td>
                            <td>
                                @foreach(\App\Evaluation::all() as $e)
                                    @if($e->factor == $key)
                                        {{ $e->description }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{ $eval }} 
                                @if($eval == 0)
                                {{ ' - Not Applicable' }}
                                @elseif($eval == 1)
                                {{ ' - Above Average' }}
                                @elseif($eval == 2)
                                {{ ' - Average' }}
                                @elseif($eval == 3)
                                {{ ' - Below Average' }}
                                @else
                                {{ ' - Unsatisfactory' }}
                                @endif
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div>
            <p style="word-wrap: break-word"><strong>Best qualities demonstrated: </strong><br>{{ $data['comments']['qualities'] }}</p>
        </div>
        <div>
            <p style="word-wrap: break-word"><strong>How improvements are made: </strong><br>{{ $data['comments']['improvements'] }}</p>
        </div>
        <div>
            <p style="word-wrap: break-word"><strong>Comments: </strong><br>{{ $data['comments']['comments'] }} </span></p>
        </div>
        <br>
        <div>
            Evaluated by: <br><br>
            <p style="text-decoration: underline">{{ $data['user']['firstname'] }} {{ $data['user']['lastname'] }}</p>
        </div>
    </div>

    {{-- <div class="container-fluid">
        <div class="row" id="evaluation-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">Performance Evaluation</div>
                    <div class="card-body">
                        <div class="container-fluid text-default">
                            <div class="row">
                                Name: <strong>{{ $data['employee']['firstname'] }} {{ $data['employee']['lastname'] }}</strong><br>
                                Date: <strong>{{ date('F d, Y') }} </strong><br>
                                Employee ID: <strong> {{ $data['employee']['username'] }} </strong>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <strong>FACTOR</strong> 
                                </div>
                                <div class="col-6">
                                    <strong>DESCRIPTION</strong> 
                                </div>
                                <div class="col-3">
                                    <strong>Evaluation</strong>
                                </div>
                            </div>
                            <hr>
                            @foreach($data['results'] as $key => $eval)
                            <div class="row">
                                <div class="col-3">
                                    {{ $key }}
                                </div>
                                <div class="col-6">
                                    @foreach(\App\Evaluation::all() as $e)
                                        @if($e->factor == $key)
                                            {{ $e->description }}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-3">
                                    {{ $eval }} 
                                    @if($eval == 0)
                                    {{ ' - Not Applicable' }}
                                    @elseif($eval == 1)
                                    {{ ' - Above Average' }}
                                    @elseif($eval == 2)
                                    {{ ' - Average' }}
                                    @elseif($eval == 3)
                                    {{ ' - Below Average' }}
                                    @else
                                    {{ ' - Unsatisfactory' }}
                                    @endif
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Best qualities demonstrated: </strong><br>{{ $data['comments']['qualities'] }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p><strong>How improvements are make: </strong><br>{{ $data['comments']['improvements'] }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Best qualities demonstrated: </strong><br>{{ $data['comments']['comments'] }} </span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <div class="col-12">
            <p style="text-decoration: underline">{{ $data['user']['firstname'] }} {{ $data['user']['lastname'] }}</p>
            Evaluated by
        </div>
    </div> --}}
</body>
</html>