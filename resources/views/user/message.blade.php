@extends('layouts.user')

@section('content')
<section style="margin-top:30px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        {{ $message->title }}
                        <span class="float-right">
                            <a href="{{ route('user.messages')}}" class="text-white"> View all</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <p>From: {{ App\Employee::find($message->from)->firstname }} {{ App\Employee::find($message->from)->lastname }}</p>
                        <p>Date: {{ date('F d, Y', strtotime($message->created_at)) }}</p>
                        <p>Message: {{ $message->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection