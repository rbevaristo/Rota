@extends('layouts.user')
@section('content')
<section id="user-dashboard">
    <div class="container-fluid">
        @include('components.messages')
        @include('components.sessions')
        <div class="row" id="employee-list">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employees
                        <span class="float-right" style="position:absolute; right: 50px; top: 5px;">
                            <form>
                                <div class="input-group">
                                    <input class="form-control border-secondary py-2" type="search" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </span>
                        <span class="float-right dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.manage') }}">Manage</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="0">

                                <div class="carousel-inner row no-gutters w-100 mx-auto" role="listbox">
                                    @if(count(auth()->user()->employees) > 0)
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach(auth()->user()->employees as $employee)
                                    <div class="carousel-item col-sm-4 col-md-3 {{ $count == 0 ? 'active' : '' }}">
                                        <div class="card" style="padding:10px">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img class="img-fluid mx-auto d-block" src="{{ asset('storage/avatar/') }}/{{ $employee->profile->avatar }}" alt="avatar">
                                                </div>
                                                <div class="col-8">
                                                    <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                                    <p>{{ $employee->position->name }}</p>
                                                    <div>
                                                        <input type="hidden" id="employee_id" value="{{ $employee->id }}">
                                                        <a href="#myModal" class="profile" data-toggle="modal" role="button">
                                                            <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i>
                                                        </a>
                                                        {{-- <a href="#myModal" class="schedule" data-toggle="modal" role="button">
                                                            <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i>
                                                        </a> --}}
                                                        <a href="#myModal" class="message" data-toggle="modal" role="button">
                                                            <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i>
                                                        </a>
                                                        <a href="#myModal" class="evaluation" data-toggle="modal" role="button">
                                                            <i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @php
                                            $count++;
                                        @endphp
                                        @endforeach
                                    @else
                                    No Data
                                    @endif
                                   
                                </div>
                                        
                                 <!-- /.carousel-inner -->
                                 <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="schedule">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <strong>Schedule</strong>
                        <span class="float-right dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.manage') }}">Manage</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.modal')

@endsection

@section('custom_scripts')
    <script>
        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#carousel').on('slide.bs.carousel', function (e) {
                var $e = $(e.relatedTarget);
                var idx = $e.index();
                var itemsPerSlide = 4;
                var totalItems = $('.carousel-item').length;
                
                if (idx >= totalItems-(itemsPerSlide-1)) {
                    var it = itemsPerSlide - (totalItems - idx);
                    for (var i=0; i<it; i++) {
                        // append slides to end
                        if (e.direction=="left") {
                            $('.carousel-item').eq(i).appendTo('.carousel-inner');
                        }
                        else {
                            $('.carousel-item').eq(0).appendTo('.carousel-inner');
                        }
                    }
                }
            });
            
            $('a.profile').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Profile
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="author text-center">
                                                    <a href="#">
                                                        <img class="avatar border-gray" src="{{ asset('storage/avatar/') }}/`+result["data"]["profile"]["avatar"]+`" alt="Avatar" width="70" height="70">
                                                        <h5 class="name">`+result["data"]["name"]+`</h5>
                                                    </a>
                                                    <p class="text-black">`+check(result["data"]["email"])+`</p>
                                                    <p class="text-black">`+result["data"]["position"]+`</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Personal Information</div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td>
                                                                @if(`+result["data"]["profile"]["gender"]+`)
                                                                    Male
                                                                @else
                                                                    Female
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Birthday</td>
                                                            <td>
                                                                `+check(result["data"]["profile"]["birthdate"])+`
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact</td>
                                                            <td>
                                                                `+check(result["data"]["profile"]["contact"])+`
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                `+check(result["data"]["address"]["number"])+`
                                                                `+check(result["data"]["address"]["street"])+`
                                                                `+check(result["data"]["address"]["city"])+`
                                                                `+check(result["data"]["address"]["state"])+`
                                                                `+check(result["data"]["address"]["zip"])+`
                                                                `+check(result["data"]["address"]["country"])+`
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Schedules</div>
                                            <div class="card-body" style="height: 250px; overflow-y: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Evaluation</div>
                                            <div class="card-body" style="height: 350px; overflow-y: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        );
                    },
                });
            });

            $('a.message').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Message
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Messages</div>
                                            <div class="card-body" style="height:70vh; overflow-y: auto">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Messages</div>
                                            <div class="card-body" style="height:70vh">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        );
                    },
                });
            });

            $('a.evaluation').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Evaluation
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                            <div class="container-fluid">
                                <div class="row" id="evaluation-form">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Performance Evaluation Form</div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ url('/dashboard/employee/`+id+`/evaluation_results') }}">
                                                @csrf
                                                <div class="container-fluid text-default">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Name: <strong>`+result["data"]["name"]+`</strong>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="float-right"> Date: <strong>{{ date('F d, Y') }} </strong></p>
                                                        </div>
                                                        <div class="col-6">
                                                            Employee ID: <strong> `+result["data"]["username"]+` </strong>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-3">
                                                        <strong>FACTOR</strong> 
                                                        </div>
                                                        <div class="col-6">
                                                            <strong>DESCRIPTION</strong> 
                                                        </div>
                                                        <div class="col-3">
                                                            <strong>Evaluation</strong>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @foreach(\App\Evaluation::all() as $eval)
                                                    <div class="row">
                                                        <div class="col-3">
                                                            {{ $eval->factor }}
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $eval->description }} 
                                                        </div>
                                                        <div class="col-3">
                                                            <select class="form-control" name="{{ $eval->factor }}" id="eval">
                                                                <option value="0">0 - Not Applicable</option>
                                                                <option value="1">1 - Above Average</option>
                                                                <option value="2">2 - Average</option>
                                                                <option value="3">3 - Below Average</option>
                                                                <option value="4">4 - Unsatisfactory</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                            <textarea class="form-control noresize" name="qualities" max-length="200" id="qualities" rows="3" placeholder="Best qualities demonstrated"></textarea>
                                                            <span class="float-right label label-default" id="count_message"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                                <textarea class="form-control noresize" name="improvements" id="improvements" rows="3" placeholder="How improvements can be Made"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                                <textarea class="form-control noresize" name="comments" id="comments" rows="3" placeholder="Comments"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row text-center">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary form-control text-white"">
                                                                {{ __('Save & Print') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            `
                        );
                    },
                });
                var text_max = 200;
                    $('#count_message').html('0 / ' + text_max );

                    $('#evaluation-form #qualities').keyup(function() {
                        var text_length = $('#qualities').val().length;
                        var text_remaining = text_max - text_length;
                        
                        $('#count_message').html(text_length + ' / ' + text_max);
                });
                    
            });
            
            function check(value){
                if(value == null)
                    return "";
                return value;
            }

        });
        
    </script>
@endsection