@extends('layouts.user')
@section('styles')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap.tagsInput.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/settings') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.settings')}}"><span class="fa fa-gear"></span><span class="breadcrumb-text"> Settings</span></a>
    </li>
@endsection

@section('content')
<div class="row text-black">
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Settings
                </div>
                <div class="card-body">
                    <div class="bg-white rounded box-shadow">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Employee</h6>
                        <div class="text-muted pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">
                                        Positions
                                        <small>
                                            <i class="fa fa-question-circle text-warning"  data-toggle="tooltip" data-placement="top" title="info on sharing ...."></i>
                                        </small>
                                    </strong>
                                    @php
                                        $value = "";
                                    @endphp
                                    @foreach($user->positions as $position)
                                        @php
                                            $value .= $position->name . ",";
                                        @endphp
                                    @endforeach
                                        <input type="text" value="{{ $value }}" class="form-control" data-role="tagsinput" placeholder="Add Positions" id="positions"/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h6 class="border-bottom border-gray pb-2 mb-0">Schedule</h6>
                        <input type="hidden" id="user_id" value="{{$user->id}}">
                        <div class="text-muted pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">
                                        Sharing
                                        <small>
                                            <i class="fa fa-question-circle text-warning"  data-toggle="tooltip" data-placement="top" title="info on sharing ...."></i>
                                        </small>
                                    </strong>
                                    <input type="checkbox" data-toggle="toggle" name="sharing" {{ $user->setting->sharing == false ? '' : 'checked' }}> 
                                </div>
                            </div>
                        </div>
                        <div class="media text-muted pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">
                                        Back up 
                                        <small>
                                            <i class="fa fa-question-circle text-warning"  data-toggle="tooltip" data-placement="top" title="info on back up ...."></i>
                                        </small>
                                    </strong>
                                    
                                    <input type="checkbox" data-toggle="toggle" id="backup" name="backup" {{ $user->setting->backup == false ? '' : 'checked' }}>
                                </div>
                            </div>
                        </div>
                        <div class="media text-muted pt-3">
                            <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">
                                        Option etc...
                                        <small>
                                            <i class="fa fa-question-circle text-warning"  data-toggle="tooltip" data-placement="top" title="info on back up ...."></i>
                                        </small>
                                    </strong>
                                    
                                    <input type="checkbox" data-toggle="toggle">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{ asset('js/bootstrap.tagsInput.js') }}"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#positions').on('change', function(){
            if($(this).val() == ""){
                var url = "{{ url('/dashboard/positions/delete-position/') }}"+"/"+$('#user_id').val();
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {},
                });
            } else {
                var url = "{{ url('/dashboard/positions/update-position/') }}"+"/"+$('#user_id').val()+"/"+$(this).val();
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {},
                });
            }
            
        });

        $('input[type="checkbox"]').on('change', function() {
            if ($(this).is(':checked')){ 
                var url = "{{ url('/dashboard/settings/update-setting/') }}"+"/"+$('#user_id').val()+"/"+$(this).attr('name')+"/"+1;
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {},
                });
            } 
            else { 
                var url = "{{ url('/dashboard/settings/update-setting/') }}"+"/"+$('#user_id').val()+"/"+$(this).attr('name')+"/"+0;
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {}
                });
            }
        });
    });
</script>
@endsection