@extends('layouts.user')

@section('content')
<section id="users-message" style="margin-top:30px">
    <div class="container">
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
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th class="text-center">Body</th>
                                        <th class="text-right">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Message::all()->sortByDesc('id')->where('to', auth()->user()->id) as $message)
                                    <tr>
                                        <td><a href="#">{{ $message->title }}</a></td>
                                        <td class="text-center">{{ Helper::limit_message($message->body, 5)}}</td>
                                        <td class="text-right">{{ date('F d, Y', strtotime($message->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
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