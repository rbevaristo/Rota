@extends('layouts.employee')

@section('custom_styles')
<style>

</style>
@endsection

@section('content')
<section id="user-profile">
    <div class="container-fluid">
        <div class="row text-black" id="user-profile">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="avatar border-gray" src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" alt="Avatar">
                            <h5 class="text-primary">{{ Helper::name() }}</h5>
                            <p> <small>{{ auth()->user()->email }} </small></p>
                            <p> <strong>{{ auth()->user()->role->name}} </strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Edit Profile
                    </div>
                    <div class="card-body">
                        @include('components.messages')
                        @include('components.sessions')
                    <form action="{{ route('employee.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="customFile" accept=".jpg,.gif,.png,.jpeg">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-label-group">
                                    <input type="text" id="firstname" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ auth()->user()->firstname }}" required placeholder="First Name">
                                    <label for="firstname" class="text-primary"> First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-label-group">
                                    <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ auth()->user()->lastname }}" required placeholder="Last Name">
                                    <label for="firstname" class="text-primary"> Last Name</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ auth()->user()->email }}" placeholder="Email">
                                    <label for="email" class="text-primary"> Email</label>
                                </div>
                            </div>
                            <div class="col-md-6 px-1" style="padding:5px;">
                                <div class="radio">
                                    <label for="gender">Gender </label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="male" name="gender" class="custom-control-input" {{ auth()->user()->profile->gender && auth()->user()->profile->gender != null ? 'checked': '' }} value="1">
                                    <label class="custom-control-label" for="male">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" class="custom-control-input" {{ auth()->user()->profile->gender && auth()->user()->profile->gender != null ? '': 'checked' }} value="0">
                                    <label class="custom-control-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label for="birthdate">Birthday</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ auth()->user()->profile->birthdate }}" placeholder="Birthdate">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h3>Address</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="text" id="number" name="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->number }}" placeholder="House Number">
                                        <label for="number" class="text-primary"> House Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="text" id="street" name="street" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->street }}" placeholder="Street">
                                        <label for="street" class="text-primary"> Street</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="city" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->city }}" placeholder="City">
                                    <label for="city" class="text-primary"> City</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="state" name="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->state }}" placeholder="State">
                                    <label for="state" class="text-primary"> State</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="zip" name="zip" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->zip }}" placeholder="Zip Code">
                                    <label for="zip" class="text-primary"> Zip Code</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="country" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" value="{{ auth()->user()->profile->address->country }}" placeholder="Country">
                                    <label for="country" class="text-primary"> Country</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">Save</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
@endsection

@section('custom_scripts')
<script>
    $(document).ready(() => {
        $('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName); 
        });
    });    
</script>
@endsection