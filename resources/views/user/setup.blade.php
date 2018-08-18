@extends('layouts.app')

@section('content')
<section id="setup">
    <div class="container d-flex justify-content-center h-100 align-items-center">
       
        <div class="col-md-6">
            <h2 class="title text-center">Company</h2>
            @include('components.sessions')
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Almost Done</strong> Please fill up the form to complete registration.
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('user.company.create') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-building-o"></i></div>
                                    </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Location" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                </div>
                                <input type="text" id="contact_number" name="contact_number" class="form-control" placeholder="09*********" required>
                            </div>
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