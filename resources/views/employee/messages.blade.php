@extends('layouts.employee')

@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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
                                    <i class="fa fa-file-text"></i> {{ __('Request') }}
                                </a>
                                {{-- <a class="dropdown-item" id="message-form" href="#myModal" data-toggle="modal" role="button">
                                    <i class="fa fa-envelope"></i> {{ __('Message') }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(\App\UserRequest::all()->sortByDesc('id')->where('emp_id', auth()->user()->id)->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Date Requested</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->notifications as $notification)
                                    {{-- @foreach(\App\UserRequest::all()->sortByDesc('id')->where('user_id', auth()->user()->id) as $message) --}}
                                    <tr>
                                        <td><a href="{{route('employee.message.read', [
                                                'notification_id' => $notification->id,
                                                'message_id' => $notification->data["messages"]["id"],
                                            ])}}">
                                        {{ $notification->data["messages"]["title"] }}</a>
                                        </td>
                                        <td class="text-center">{{ Helper::limit_message($notification->data["messages"]["message"], 5)}}</td>
                                        <td class="text-right">{{ date('F d, Y', strtotime($notification->data["messages"]["created_at"])) }}</td>
                                        @if(\App\UserRequest::find($notification->data["messages"]["id"])->approved)
                                            <td class="text-right">Approved</td>
                                        @else
                                            @if((strtotime($notification->data["messages"]["from"]) - strtotime(date('Y-m-d'))) / (3600*24) < 7)
                                            <td class="text-right">Expired</td>
                                            @else
                                            <td class="text-right">Pending</td>
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
            
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
    <script src="{{ asset('js/lib/jquery-ui.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({

            });

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
            
            $('#request-form').click(function(){
                $('.modal-content').html('');
                $('.modal-content').html(`
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
                `);
            });

            $('#message-form').click(function(){
                $('.modal-content').html('');
                $('.modal-content').html(`
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Send a message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employee.message.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="subject"></label>
                                <select name="name" id="name" class="form-control" required>
                                    <option value="">Choose User</option>
                                    @foreach(\App\User::all()->where('id', auth()->user()->user->id) as $user)
                                        <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}} ({{$user->role->name}})</option>
                                    @endforeach
                                    @foreach(\App\Employee::all()->where('user_id', auth()->user()->user->id)->where('id', '!=', auth()->user()->id) as $user)
                                        <option value="{{$user->username}}">{{$user->firstname}} {{$user->lastname}} ({{$user->position->name}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label sr-only" for="title"></label>
                                <input type="text" class="form-control" name="title" id="title" required placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="message"></label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                `);
            });
        });
    </script>
@endsection