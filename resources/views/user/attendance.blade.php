@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-12">
        <table class="table" id="employee-attendance">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                        Richard Evaristo
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                        Jaspher Dingal
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')

@endsection