@extends('layouts.app')

@section('content')
{{-- Home --}}
<section id="home" class="animated fadeIn">
    <div class="content d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="row">
                <div class="col-md-6">
                    <img id="rota-logo" src="{{ asset('img/Rota-13.png') }}" alt="">
                    <h2>Support <span>tasks and decisions </span> in scheduling workers.</h2>
                    <div>
                        <a href="#about" class="btn btn-primary">Learn More</a>
                        <a href="{{ route('auth.admin') }}" class="btn btn-primary">Get Started</a>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <img id="screens" src="{{ asset('img/screens.png') }}" alt="https://pixabay.com/p-815644/?no_redirect">
                </div>
            </div>
        </div>
    </div>       
</section>

{{-- About --}}
<section id="about">
    <div class="content animated fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">About Routa</h2>
                    <h5 class="description">ROUTA is a web-based and mobile-based application with an employee scheduling, performance evaluation, and attendance monitoring system.<br>
                        ROUTA aims to save time and make their work easier by reducing the chance of human error and producing consistent results through the automatic scheduling done by the application.
                        </h5>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Services --}}
<section id="services">
    <div class="content">

        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Services</h2>
                        <h5 class="description">Objectives can’t be met without implementing solutions. That’s why the ROUTA provides your managerial needs through the use of the following:</p>
                    </div>
                </div>
            <div class="separator separator-primary"></div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="box animated fadeIn">
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <h4 class="title">Staff Scheduling</h4>
                    <p class="description">The app produces a schedule for your employees based on your demands. Freely adjust the factors that you want to affect the generation of your staffs’ schedule.</p>
                    </div>
                </div>
        
                {{-- <div class="col-lg-6">
                    <div class="box animated fadeIn">
                    <div class="icon"><i class="fa fa-desktop"></i></div>
                    <h4 class="title">Attendance Monitoring</h4>
                    <p class="description">Employees can login to the system for their attendance, and also file a leave of absence in the app. All of these can be easily monitored by the manager.</p>
                    </div>
                </div> --}}
        
                <div class="col-lg-12">
                    <div class="box animated fadeIn" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-bar-chart"></i></div>
                    <h4 class="title">Performance Evaluation</h4>
                    <p class="description">Managers can continuously record their employees’ performance in the app. It allows them to see the progress of their staff’s performance over time which can aid in their professional decision making. </p>
                    </div>
                </div>
        
                <div class="col-lg-12">
                    <div class="box animated fadeIn" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-file"></i></div>
                    <h4 class="title">Report Generation</h4>
                    <p class="description">Data regarding the employees’ schedule, and evaluated performance, easily accessible by the manager through the use of the app.</p>
                    </div>
                </div>
              
            </div>
              
        </div>
    </div>
</section>

{{-- Teams --}}
<section class="section section-team text-center" id="team">
    <div class="container-fluid">
        <h2 class="title">The Team</h2>
        <div class="team">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Jaspher Dingal</h5>
                        <p class="category">Programmer</p>
                        <p class="description"> 
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, error?
                        </p>
                        {{-- <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.facebook.com/jaspherdingal" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/chard.jpg') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Richard Evaristo</h5>
                        <p class="category">Programmer</p>
                        <p class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur.
                        </p>
                        {{-- <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.facebook.com/richardbarbosaevaristo" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/kennet.jpg') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Kennet Mallari</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, nisi.
                        </p>
                        {{-- <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.facebook.com/kennetgotswag" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/luc.jpg') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Luc Racca</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam, modi.
                        </p>
                        {{-- <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.facebook.com/luc.racca" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/renz.jpg') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Renz Tolentino</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam, modi.                            
                        </p>
                        {{-- <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a> --}}
                        <a href="https://www.facebook.com/renzctolentino" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-primary"></div>
    </div>
</section>

<section id="contact" class="animated fadeIn">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">Contact Us</h2>
                    <h5 class="description">Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="box col-md-12">
                    @include('components.sessions')
                    <form action="{{ route('message.send') }}" method="post" role="form">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="4" cols="80" placeholder="Type a message..." required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-round btn-block btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- #contact -->
@endsection

{{-- Scripts appended at the bottom of the page --}}
@section('custom_scripts')
    <script src="{{ asset('js/lib/smooth-scroll.js') }}"></script>
    {{-- <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script>
        window.sr = ScrollReveal();
        sr.reveal('#home', { duration: 2000 }, 50);
        sr.reveal('#about', { duration: 2000 }, 50);
        sr.reveal('#services', { duration: 2000 }, 50);
        sr.reveal('#team', { duration: 2000 }, 50);
        sr.reveal('#contact', { duration: 2000 }, 50);
    </script> --}}
@endsection