@extends('layouts.employee')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@endsection


@section('content')
<div class="row" >
    <div class="col-12">
        @include('components.messages')
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Request Message
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('employee.request.create') }}">
                @csrf
                <div class="service-form">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="subject"></label>
                                <select name="name" id="name" class="form-control" required>
                                    <option value="">Select Request</option>
                                    @foreach($user->requests as $request)
                                <option value="{{ $request->id }}"> {{ $request->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="start"></label>
                                <input type="text" class="form-control" name="start_date" id="start" required placeholder="Start Date">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="end"></label>
                                <input type="text" class="form-control" name="end_date" id="end" required placeholder="End Date">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="message"></label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Reason for request." required></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button type="submit" class="btn btn-primary btn-block mb10">Send Request</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Personal Message
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.message.create') }}">
                    @csrf
                    <div class="service-form">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <label class="control-label sr-only" for="title"></label>
                                    <input type="text" class="form-control" id="title" required placeholder="Title">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <label class="control-label sr-only" for="textarea"></label>
                                    <textarea class="form-control" id="textarea" name="textarea" rows="3" placeholder="Messages"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <button type="submit" class="btn btn-primary btn-block mb10">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                List of Messages
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/plugins/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#end').attr('disabled', 'true');
            $('#start').datepicker({
                showAnim: 'drop',
                numberOfMonth: 1,
                minDate: new Date(),
                dateFormat: 'dd/mm/yy',
                onClose: function(selected) {
                    $('#end').datepicker('option', 'minDate', selected);
                }
            }).on('change', function(){
                console.log($(this).val());
                $('#end').removeAttr('disabled');
            });

            $('#end').datepicker({
                showAnim: 'drop',
                numberOfMonth: 1,
                minDate: new Date(),
                dateFormat: 'dd/mm/yy',
            });

        });
    </script>
@endsection