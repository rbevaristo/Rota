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
                @foreach(auth()->user()->employees->where('status', 1)->sortBy('position_id') as $employee)
                <tr>
                    <td>
                        {{ $employee->firstname }} {{ $employee->lastname }} <br>
                        {{ $employee->position->name }}
                    </td>
                    @foreach($data as $d)
                    <td>
                        @foreach($d['employees'] as $emp)
                            @if($emp['firstname'] == $employee->firstname)
                            {{ $d['shift'] }}
                            @else
                            
                            @endif
                        @endforeach
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</section>
@endsection
