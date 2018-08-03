@extends('layouts.app')

@section('custom_styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
@endsection

@section('content')
{{-- Home --}}
<section id="home" class="animated fadeInUp">
    <div class="content">
    <h1>ROTA </h1>
        <h2>Making <span>your scheduling tasks</span><br>easy!</h2>
        <div>
            <a href="#" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>       
</section>
<hr class="my-4">
{{-- About --}}
<section id="about">
    <div class="content animated fadeInUp">
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
<hr class="my-4">
{{-- Services --}}
<section id="services">
    <div class="content">

        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Services</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur unde soluta modi illum, praesentium harum porro! Et commodi eum perferendis quia minus recusandae odit ipsum doloremque libero neque, tempora quos?</p>
                    </div>
                </div>
            <div class="separator separator-primary"></div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="box animated fadeInLeft">
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <h4 class="title"><a href="#">Staff Scheduling</a></h4>
                    <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeInRight">
                    <div class="icon"><i class="fa fa-desktop"></i></div>
                    <h4 class="title"><a href="#">Attendance Monitoring</a></h4>
                    <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata nodera clas.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeInLeft" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-bar-chart"></i></div>
                    <h4 class="title"><a href="#">Performance Evaluation</a></h4>
                    <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trinige zareta lobur trade.</p>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="box animated fadeInRight" data-wow-delay="0.2s">
                    <div class="icon"><i class="fa fa-file"></i></div>
                    <h4 class="title"><a href="#">Report Generation</a></h4>
                    <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum rideta zanox satirente madera</p>
                    </div>
                </div>
              
            </div>
              
        </div>
    </div>
</section>
<hr class="my-4">
{{-- Teams --}}
<section class="section section-team text-center" id="team">
    <div class="container">
        <h2 class="title">Here is our team</h2>
        <div class="team">
            <div class="row">
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="team-name">Jaspher Dingal</h4>
                        <p class="category text-primary">Programmer</p>
                        <p class="description"> 
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores quibusdam quae doloribus dicta dolorum accusamus officia harum impedit est mollitia, adipisci sequi illo facere! 
                        </p>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="team-name">Richard Evaristo</h4>
                        <p class="category text-primary">Programmer</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia harum quaerat alias beatae ullam suscipit sapiente. Itaque hic, recusandae quaerat sit nulla quasi! Corrupti, facilis?
                        </p>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="team-name">Kennet Mallari</h4>
                        <p class="category text-primary">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo explicabo beatae, perspiciatis nesciunt deleniti, voluptatem repudiandae maiores sit inventore, nemo quasi corrupti laudantium eum sapiente.
                        </p>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="team-name">Luc Johannes Racca</h4>
                        <p class="category text-primary">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, corrupti? Sapiente suscipit quae modi facere ducimus nobis asperiores earum fugit cupiditate rem unde, nemo vitae!
                        </p>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="{{ asset('img/default.png') }}" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="team-name">Renz Tolentino</h4>
                        <p class="category text-primary">Researcher</p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Id enim eaque laboriosam voluptatem aliquid, quam molestiae fuga voluptatibus porro quasi ex et magnam quod quia.
                        </p>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="separator separator-primary"></div>
    </div>
</section>
<hr class="my-4">
<section id="contact" class="animated fadeInUp">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">Contact Us</h2>
                    <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <form action="#" method="post" role="form" class="form-signin">
                        <div class="form-label-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                            <label for="name"><i class="fa fa-user"></i> Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        </div>

                        <div class="form-label-group">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                        </div>
                        <div class="form-label-group">
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
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script>
        window.sr = ScrollReveal();
        sr.reveal('#home', { duration: 2000 }, 50);
        sr.reveal('#about', { duration: 2000 }, 50);
        sr.reveal('#services', { duration: 2000 }, 50);
        sr.reveal('#team', { duration: 2000 }, 50);
        sr.reveal('#contact', { duration: 2000 }, 50);
    </script>
@endsection