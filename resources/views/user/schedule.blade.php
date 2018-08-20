@extends('layouts.user')
@section('custom_styles')
    <style>
    </style>
@endsection
@section('content')
<section style="margin-top: 30px">
    <div class="container-fluid">
        <table class="table text-center">
            <thead>
                <tr>
                    <td></td>
                    @for($i = 0; $i < auth()->user()->setting->num_days; $i++)
                    <td>
                        {{ date('F d, Y', strtotime($date . ' +'.$i.' day')) }} <br>
                        {{ date('D', strtotime($date . ' +'.$i.' day'))}}
                    </td>
                    @endfor
                </tr>
            </thead>
            <tbody>
                
                @for($i = 0; $i < sizeof($data); $i++)
                    <tr>
                        <td>{{ $data[$i]['schedule']['name'] }} <br> {{ $data[$i]['schedule']['position'] }}</td>
                        @for($j = 0; $j < sizeof($data[$i]['schedule']['shifts']); $j++)
                            <td>
                                @php
                                    $dayoff = $data[$i]['schedule']['shifts'][$j]['day'.($j+1)];
                                @endphp
                            @for($k = 0; $k < sizeof($data[$i]['dayoff']); $k++)
                                @if($data[$i]['dayoff'][$k]['dayoff'.($k+1)] == $j)
                                    @php
                                        $dayoff = 'dayoff';
                                    @endphp
                                @endif
                            @endfor
                                {{ $dayoff }}
                                
                            </td>

                        @endfor

                    </tr>
                @endfor
                

                  
                

                {{-- @foreach($employees as $employee)
                <tr>
                   
                    
                    <td class="fix-column">
                        {{ $employee->firstname }} {{ $employee->lastname }} <br>
                        {{ $employee->position->name }}
                    </td>
                    @for($i = 0; $i < $data['days']; $i++)
                        @php
                            $shift = $shifts->random();
                        @endphp
                        <td class="flexible">{{ $shift->start }} - {{ $shift->end }}</td>
                    @endfor


                </tr>
                @endforeach --}}
            </tbody>
        </table>
        
    </div>
</section>
@endsection
