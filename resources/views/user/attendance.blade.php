@extends('layouts.user')
@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<section style="margin-top:30px" id="attendance">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Employees
                        <span class="float-right">{{ date('F d, Y') }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(auth()->user()->employees as $employee)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/avatar') }}/{{ $employee->profile->avatar }}" class="rounded" alt="avatar">
                                        {{ Helper::employee_name($employee->firstname, $employee->lastname) }}
                                    </td>
                                    <td>{{ $employee->position->name }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/lib/dataTables.bootstrap4.min.js') }}"></script>
<script>
        $(document).ready(function(){
            $('.table').DataTable({
               
            });
        });
</script>
@endsection