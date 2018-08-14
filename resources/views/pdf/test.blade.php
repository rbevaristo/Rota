<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample Pdf layout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style>

    </style>
</head>
<body>
    <div class="container text-center" style="margin-top: 50px;">
        <h1>{{ $data['company']['name'] }}</h1>
        <h6>{{ $data['company']['location'] }}</h6>
        <h6>{{ $data['company']['email'] }}</h6>
        <h6>{{ $data['company']['contact'] }}</h6>
    </div>
    <div class="container">
        <div class="row" id="evaluation-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">Performance Evaluation</div>
                    <div class="card-body">
                        <div class="container-fluid text-default">
                            <div class="row">
                                <div class="col-6">
                                    Name: <strong>{{ $data['employee']['firstname'] }} {{ $data['employee']['lastname'] }}</strong>
                                </div>
                                <div class="col-6">
                                    <p class="float-right"> Date: <strong>{{ date('F d, Y') }} </strong></p>
                                </div>
                                <div class="col-6">
                                    Employee ID: <strong> {{ $data['employee']['username'] }} </strong>
                                </div>
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
    <div class="container">
        <div class="col-12">
            <p style="text-decoration: underline">{{ $data['user']['firstname'] }} {{ $data['user']['lastname'] }}</p>
            Evaluated by
        </div>
    </div>
</body>
</html>