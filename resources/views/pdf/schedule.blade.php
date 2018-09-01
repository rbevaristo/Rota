<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        td {
            font-size: 10px;
            padding: 5px;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
@php
$n; $start; $holder = 0; $count = 0;
    foreach(auth()->user()->employee_schedules as $schedule){
        $temp = sizeof(json_decode($schedule->schedule));
        if( $temp > $holder){
            $count += 1;
            $n = json_decode($schedule->schedule);
            $holder = $temp;
        } 
    }
@endphp
        <div class="container-fluid">
            <div class="text-center">
                <h1>{{ $data['company']['name'] }}</h1>
                <h6>{{ $data['company']['location'] }} | {{ $data['company']['email'] }} | {{ $data['company']['contact'] }}</h6>
            </div>
            <div class="text-center">
                <h3>Schedule <span class="float-right"><small>Date: {{ date('F d, Y') }}</small></span></h3>
            </div>
            <div class="text-center">
                <table border="1">
                    <thead>
                        <tr>
                            <td></td>
                            @php
                                $ns; $start; $holder = 0;
                                foreach(auth()->user()->employee_schedules as $schedule){
                                    $temp = sizeof(json_decode($schedule->schedule));
                                    if( $temp > $holder){
                                        $ns = json_decode($schedule->schedule);
                                        $holder = $temp;
                                    } 
                                }
    
                            @endphp
                            @if(sizeof($ns) > 0)
                                @php
                                    $s = explode(',',$ns[0]);
                                    $start = date('Y-m-d', strtotime($s[0]));
                                    $e = explode(',', $ns[sizeof($ns) - 1]);
                                    $end = date('Y-m-d', strtotime($e[0]));
                                @endphp
                                @while(strtotime($end) >= strtotime($start))
                                    <td>
                                        {{ date('M d', strtotime($start)) }} <br>
                                        {{ date('D', strtotime($start)) }}
                                    </td>
                                    @php
                                        $start = date('Y-m-d', strtotime('+1 day', strtotime($start)));
                                    @endphp
                                @endwhile
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->employee_schedules as $schedule)
                        <tr>
                            <td>
                            @php
                                $emp = \App\Employee::where('id', $schedule->emp_id)->first();
                                $name = $emp->firstname . ' ' . $emp->lastname;
                                $position = $emp->position->name;
                            @endphp
                            <strong>{{ $name }} <br> {{ $position }}</strong>
                            </td>
                            @php
                                $ns = json_decode($schedule->schedule);
                                $d = date('Y-m-d', strtotime($s[0]));
                            @endphp
                            @if(sizeof($ns) > 0)
                                @for($i = 0 ; $i < sizeof($ns);)
                                    @php
                                        $v = explode(',', $ns[$i])
                                    @endphp
                                    @if($v[0] == $d)
                                    @php
                                        $i++;
                                        $z = explode('-', $v[1]);
                                    @endphp
                                    <td>{{ \Helper::getStartToEndAMPM($z[0],$z[1]) }}</td>
                                    @else
                                    <td> - </td>
                                    @endif
                                    @php
                                        $d = date('Y-m-d', strtotime('+1 day', strtotime($d)));
                                    @endphp
                                @endfor
                            @else
                                <td colspan="{{ (sizeof($n)+$count) }}" class="text-center">No schedule</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
</body>
</html>