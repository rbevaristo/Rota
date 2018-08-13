@extends('layouts.employee')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@endsection


@section('content')
<section id="employee-message" style="margin-top:30px">
    <div class="container">
        <div class="row" >
            <div class="col-12">
                @include('components.messages')
            </div>
            {{-- <div class="col-md-3">
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
            </div> --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Inbox
                        {{-- <div class="float-right dropdown">
                            <a id="navbarDropdown2" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                                Compose
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                <a href="#" class="dropdown-item">
                                    Request
                                </a>
                                <a href="#" class="dropdown-item">
                                    Message
                                </a>
                            </div>
                        </div> --}}
                        <div class="float-right dropdown">
                            <a id="navbarDropdown2" class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Compose
                            </a>
            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" id="request-form" href="#myModal" data-toggle="modal" role="button">
                                    <i class="fa fa-file-text"></i> {{ __('Request') }}
                                </a>
                                <a class="dropdown-item" id="message-form" href="#myModal" data-toggle="modal" role="button">
                                    <i class="fa fa-envelope"></i> {{ __('Message') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>Request for Leave</td>
                                        <td>Message...</td>
                                        <td class="text-right">March 15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send a message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for=""></label>
              <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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