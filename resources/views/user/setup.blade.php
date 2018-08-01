@extends('layouts.app')

@section('content')
<section id="setup">
    <div class="container d-flex justify-content-center h-100 align-items-center">
        
        <div class="col-md-6">
            <h2 class="title text-center">Company</h2>
            <div class="card">
                <div class="card-header">
                    <strong>Almost Done</strong> Please fill up the form to complete registration.
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('user.company.create') }}" class="form-signin">
                        @csrf
                        
                        <div class="form-label-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                            <label for="name" class="text-primary"><i class="fa fa-building-o"></i> Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                            <label for="email" class="text-primary"><i class="fa fa-envelope"></i> Email</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="location" name="location" class="form-control" placeholder="Location" required>
                            <label for="location" class="text-primary"><i class="fa fa-map-marker"></i> Location</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
                            <label for="contact" class="text-primary"><i class="fa fa-phone"></i> Contact</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-round btn-md form-control">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection