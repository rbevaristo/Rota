@extends('layouts.user')
@section('custom_styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
@endsection
@section('content')
<section id="user-dashboard">
    <div class="container-fluid">
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
                                                    <p>
                                                        <a href="#">
                                                            <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="View Schedule"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i>
                                                        </a>
                                                    </p>
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

<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">
    TODO: modal Profile View, Schedule View, Message, Evaluate
</a>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="result">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        Content
                    </div>
                    <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            Content
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_scripts')
    <script>
        $(document).ready(() => {
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

            $('#myModal').on('hide.bs.modal', function () {
                $(this).removeClass().addClass('modal zoomOut animated');
            });

            $('#myModal').on('show.bs.modal', function () {
                $(this).removeClass().addClass('modal zoomIn animated');
            });
        });
        
    </script>
@endsection