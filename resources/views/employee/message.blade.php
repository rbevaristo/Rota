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
                @include('components.sessions')
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
                        <small>
                            Approved {{ date('F d, Y', strtotime($message->updated_at)) }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection