@extends('layouts.employee')
@section('custom_styles')
    <style>
        @media (max-width: 576px){
            #users-message{
                font-size: 12px;
            }
        }
    </style>
@endsection
@section('content')
<section style="margin-top:30px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        {{ $message->title }}
                        <span class="float-right">
                            <a href="{{ route('employee.messages')}}" class="text-white"> View all</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <p>From:  <strong>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} </strong></p>
                        <p>Date Requested:  <strong>{{ date('F d, Y', strtotime($message->created_at)) }}
                            </strong></p>
                        <p>Request Date:  <strong>{{ date('F d, Y', strtotime($message->from)) }} - {{ date('F d, Y', strtotime($message->upto)) }}
                                </strong></p>
                        Message: <p style="text-indent:60px;"> <strong>{{ $message->message }}</strong></p>
                    </div>
                    <div class="card-footer text-right">
                        @if($message->approved)
                        <small>
                            Approved {{ date('F d, Y', strtotime($message->updated_at)) }}
                        </small>
                        @else
                        <small>
                            @if((strtotime($message->from) - strtotime(date('Y-m-d'))) / (3600*24) < 7)
                                Expired
                            @else
                                Pending
                            @endif
                        </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection