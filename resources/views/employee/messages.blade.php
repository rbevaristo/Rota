@extends('layouts.employee')

@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('content')
<section id="employee-message" style="margin-top:30px">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-12">
                @include('components.sessions')
                @include('components.messages')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Inbox
                        <div class="float-right dropdown">
                            <a id="navbarDropdown2" class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Compose
                            </a>
            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" id="request-form" href="#myModal" data-toggle="modal" role="button">
                                    <i class="fa fa-file-text"></i> {{ __('Request for Leave') }}
                                </a>
                                {{-- <a class="dropdown-item" id="message-form" href="#myModal" data-toggle="modal" role="button">
                                    <i class="fa fa-envelope"></i> {{ __('Message') }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(count(auth()->user()->user_requests->sortByDesc('id')) > 0)
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Date Request</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->user_requests as $req)
                                         <tr>
                                            <td> 
                                                <a href="{{ route('employee.message.view', ['id' => $req->id]) }}">
                                                    {{ $req->title }}
                                                </a>
                                            
                                            </td>
                                            <td>{{ Helper::limit_message($req->message, 5)}}</td>
                                            <td>
                                                {{ date('F d, Y', strtotime($req->from)) }} - 
                                                {{ date('F d, Y', strtotime($req->upto)) }}
                                            </td>
                                            @if($req->approved)
                                                <td>Approved</td>
                                            @else
                                                @if((strtotime($req->from) - strtotime(date('Y-m-d'))) / (3600*24) < 7)
                                                <td>Expired</td>
                                                @else
                                                <td>Pending</td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            @else
                                No message
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade align-items-center" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-half modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send a request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('employee.request.create') }}">
                @csrf

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <label class="control-label sr-only" for="subject"></label>
                            <select name="title" id="title" class="form-control" required>
                                <option value="">Select Request</option>
                                @foreach(\App\RequestType::all()->where('user_id', null) as $request)
                                    <option value="{{$request->name}}">{{$request->name}}</option>
                                @endforeach
                                @foreach(\App\RequestType::all()->where('user_id', auth()->user()->id) as $request)
                                    <option value="{{$request->name}}">{{$request->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="date" class="form-control" name="start_date" id="start" min="{{ date('Y-m-d') }}" required placeholder="Start Date">
                                <div class="input-group-text">to</div>
                                <input type="date" class="form-control" name="end_date" id="end" min="{{ date('Y-m-d') }}" required placeholder="End Date">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label sr-only" for="message"></label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Reason for request." required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
    <script src="{{ asset('js/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/lib/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({

            });

            $('#end').attr('disabled', 'true');
            $('#start').on('change', function(){
                $('#end').val("");
                $('#end').removeAttr('disabled');
                $('#end').attr('min', $(this).val());
            });          
        });
    </script>
@endsection