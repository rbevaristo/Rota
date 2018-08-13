@extends('layouts.employee')

@section('content')
<section id="employee-dashboard">
    <div class="container-fluid">
        @if(!auth()->user()->is_reset)
            <div class="row">
                <div class="col-12">
                    <div class="alert fade show notice notice-warning" role="alert">
                        <strong> Notice </strong> 
                        Click <a href="#" data-toggle="modal" data-target="#exampleModalCenter"> here </a> 
                            to change your password
                    </div>
                </div>
            </div>
        @endif
        @include('components.sessions')
        @include('components.messages')
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="author text-center">
                            <a href="#">
                                <img class="avatar border-gray" src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" alt="Avatar" width="70" height="70">
                                <h5 class="name">{{ Helper::name() }}</h5>
                            </a>
                            <p class="text-black">{{ auth()->user()->email }}</p>
                            <p class="text-black">{{ auth()->user()->position->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Schedules
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalLongTitle">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert" id="alert"></div>
            <form>
                <div class="form-label-group">
                    <input type="password" id="current_password" name="current_password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" required placeholder="Current Password">
                    <label for="current_password" class="text-primary"><i class="fa fa-user-secret"></i> Current Password</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="checkPassword" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#checkPassword').on('click', function() {
                if($('#current_password').val() == null){
                    $('.modal-body .alert').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            Please enter your current password.
                        </strong> 
                    </div>
                    `);
                } else {
                    var url = "{{ url('employee/dashboard/password-check/') }}"+"/"+$('#current_password').val();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json; charset=utf-8',
                        success: function (result) {
                            if(result['success']){
                                $('.modal-body').html(`
                                    <form action="{{ route('employee.change-password') }}" method="POST" class="form-signin">
                                        @csrf
                                        <div class="form-label-group">
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Current Password">
                                            <label for="password" class="text-primary"><i class="fa fa-user-secret"></i> New Password</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                                            <label for="password-confirm" class="text-primary"><i class="fa fa-user-secret"></i> Confirm Password</label>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                `);
                                $('.modal-footer').html('');
                            } else {
                                $('.modal-body .alert').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>
                                            Incorrect Password.
                                        </strong> 
                                    </div>
                                `); 
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection