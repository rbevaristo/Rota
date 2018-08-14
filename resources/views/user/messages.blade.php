@extends('layouts.user')
@section('custom_styles')
    <style>
        @media (max-width: 576px){
            #users-message{
                font-size: 10px;
            }
        }
    </style>
@endsection
@section('content')
<section id="users-message" style="margin-top:30px">
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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                @if(\App\UserRequest::all()->sortByDesc('id')->where('user_id', auth()->user()->id)->count() > 0)
                                <tbody>
                                    @foreach(auth()->user()->notifications as $notification)
                                    {{-- @foreach(\App\UserRequest::all()->sortByDesc('id')->where('user_id', auth()->user()->id) as $message) --}}
                                    <tr>
                                        <td><a href="{{route('user.message.read', [
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
                                @else
                                    No message
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')

@endsection