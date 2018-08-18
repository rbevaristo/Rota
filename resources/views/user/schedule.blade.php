@extends('layouts.user')

@section('content')
<section style="margin-top: 30px">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < sizeof($data); $i++)
                <tr>
                    <td>{{ $data[$i]['day'] }}</td>
                    <td>{{ $data[$i]['shift'][0]['start'] }}</td>
                    <td>{{ $data[$i]['shift'][0]['end'] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
        
    </div>
</section>
@endsection
