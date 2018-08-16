@extends('layouts.app')

@section('content')
{{-- Home --}}
<section id="home" class="animated fadeIn">
    <div class="content d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="row">
                <div class="col-6">
                    <h1>ROTA </h1>
                    <h2>Supporting businesses small to medium with <span>tasks and decisions </span> in scheduling and monitoring workers.</h2>
                    <div>
                        <a href="#about" class="btn btn-primary">Learn More</a>
                        <a href="{{ route('auth.admin') }}" class="btn btn-primary">Get Started</a>
                    </div>
                    
                </div>
                <div class="col-6">
                    <img src="{{ asset('img/screens.png') }}" alt="https://pixabay.com/p-815644/?no_redirect">
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
                    <h2 class="title">About Rota</h2>
                    <h5 class="description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus ab dolor sequi possimus quas laudantium atque mollitia at! Nobis sint, at exercitationem, necessitatibus error inventore, odio perspiciatis vero mollitia explicabo labore? Itaque mollitia nisi veritatis, est repellendus praesentium accusamus at ut, fuga labore aperiam excepturi maiores hic vel impedit!</h5>
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
                        <h5 class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur unde soluta modi illum, praesentium harum porro! Et commodi eum perferendis quia minus recusandae odit ipsum doloremque libero neque, tempora quos?</p>
                    </div>
                </div>
            <div class="separator separator-primary"></div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="box animated fadeIn">
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <h4 class="title"><a href="#">Staff Scheduling</a></h4>
                    <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeIn">
                    <div class="icon"><i class="fa fa-desktop"></i></div>
                    <h4 class="title"><a href="#">Attendance Monitoring</a></h4>
                    <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata nodera clas.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeIn" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-bar-chart"></i></div>
                    <h4 class="title"><a href="#">Performance Evaluation</a></h4>
                    <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trinige zareta lobur trade.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeIn" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-file"></i></div>
                    <h4 class="title"><a href="#">Report Generation</a></h4>
                    <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum rideta zanox satirente madera</p>
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
                <div class="col-md-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Jaspher Dingal</h5>
                        <p class="category">Programmer</p>
                        <p class="description"> 
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, error?
                        </p>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Richard Evaristo</h5>
                        <p class="category">Programmer</p>
                        <p class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur.
                        </p>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Kennet Mallari</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, nisi.
                        </p>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Luc Racca</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam, modi.
                        </p>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h5 class="team-name text-primary">Renz Tolentino</h5>
                        <p class="category">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, soluta.
                        </p>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-default btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
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
                    <form action="#" method="post" role="form">
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
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-primary btn-round btn-block btn-lg">Send Message</a>
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