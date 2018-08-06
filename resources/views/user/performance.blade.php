@extends('layouts.user')

@section('content')
<section id="evaluation">
    <div class="container-fluid">
        <div class="row" id="list-of-employees">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employees
                    </div>
                    <div class="card-body" style="background-color: gray">
                        <div class="container-fluid">
                            <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="0">
                                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                    @if(count(auth()->user()->employees) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach(auth()->user()->employees as $employee)
                                        
                                        <div class="carousel-item col-md-2 {{ $count == 0 ? 'active' : '' }}">
                                            <div class="card" style="padding:10px">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="img-fluid mx-auto d-block" src="{{ asset('storage/avatar/') }}/{{ auth()->user()->profile->avatar }}" alt="slide 2">
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
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="#carouselExample" data-slide="prev" style="padding:5px">
                                        <span class="fa fa-arrow-left text-white"></span>
                                    </a>
                                    <a href="#carouselExample" data-slide="next" style="padding:5px">
                                        <span class="fa fa-arrow-right text-white"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="evaluation-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Performance Evaluation Form</div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    Name: <strong>Richard Evaristo</strong>
                                </div>
                                <div class="col-6">
                                    <p class="float-right"> Date: <strong>{{ date('F d, Y') }} </strong></p>
                                </div>
                                <div class="col-6">
                                    Employee ID: <strong> 20473143 </strong>
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
                            @foreach(\App\Evaluation::all() as $eval)
                            <div class="row">
                                <div class="col-3">
                                    {{ $eval->factor }}
                                </div>
                                <div class="col-6">
                                    {{ $eval->description }} 
                                </div>
                                <div class="col-3">
                                    <select class="form-control" name="eval" id="eval">
                                        <option value="0">0 - Not Applicable</option>
                                        <option value="1">1 - Above Average</option>
                                        <option value="2">2 - Average</option>
                                        <option value="3">3 - Below Average</option>
                                        <option value="4">4 - Unsatisfactory</option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                      <textarea class="form-control" name="qualities" id="qualities" rows="3" placeholder="Best qualities demonstrated"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control" name="improvements" id="improvements" rows="3" placeholder="How improvements can be Made"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-md-12">
                                    <a class="btn btn-primary form-control text-white" href="{{ route('auth.admin') }}">
                                        {{ __('Save & Print') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
    <script>
        $('#carouselExample').on('slide.bs.carousel', function (e) {

            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 6;
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
    </script>
@endsection