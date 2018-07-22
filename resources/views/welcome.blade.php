@extends('layouts.app')

@section('content')
{{-- Home --}}
<section class="page-header clear-filter" filter-color="orange" id="home">
    <div class="container">
        <div class="content-center">
            <div class="content-center">
                <h1 class="title">{{ config('app.name')}}</h1>
                <h4 class="title">Some Caption Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, quod!</h4>
                <a href="#" class="btn btn-primary btn-round btn-lg">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</section>
{{-- About --}}
<section class="section section-about-us" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">About Rota</h2>
                <h5 class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque ut autem iste nobis, aliquam blanditiis? Provident veniam quis fugit velit, quos quibusdam molestiae in sed?</h5>
            </div>
        </div>
        <div class="separator separator-primary"></div>
    </div>
</section>
{{-- Services --}}
<section class="services section-services" id="services">
    <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">Services</h2>
                </div>
            </div>
        <div class="separator separator-primary"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h2 class="title">Staff Scheduling</h2>
                <h5 class="description">
                    Now UI Kit comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit Make sure you check all of them and use those that you like the most.
                </h5>
            </div>
            <div class="col-lg-6 col-md-12">
               <p>some image or icon or anything</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h2 class="title">Attendance Monitoring</h2>
                <h5 class="description">
                    Now UI Kit comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit Make sure you check all of them and use those that you like the most.
                </h5>
            </div>
            <div class="col-lg-6 col-md-12">
                <p>some image or icon or anything</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h2 class="title">Performance Evaluation</h2>
                <h5 class="description">
                    Now UI Kit comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit Make sure you check all of them and use those that you like the most.
                </h5>
            </div>
            <div class="col-lg-6 col-md-12">
                <p>some image or icon or anything</p>
            </div>
        </div>
    </div>
</section>
{{-- Teams --}}
<section class="section section-team text-center" id="team">
    <div class="container">
        <h2 class="title">Here is our team</h2>
        <div class="team">
            <div class="row">
                <div class="col-md-4">
                    <div class="team-player">
                        <img src="" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">Jaspher Dingal</h4>
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
                        <img src="" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">Richard Evaristo</h4>
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
                        <img src="" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">Kennet Mallari</h4>
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
                        <img src="" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">Luc Johannes Racca</h4>
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
                        <img src="" alt="profile picture" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">Renz Tolentino</h4>
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
{{-- Contact --}}
<section class="section section-contact-us text-center" id="contact">
    <div class="container">
        <div class="col-lg-12">
            <div class="card card-contact">
                <h2 class="title">Contact Us</h2>
                <p class="description"></p>
                <div class="row">
                    <div class="text-center">
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Name...">
                        </div>
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons ui-1_email-85"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Email...">
                        </div>
                        <div class="textarea-container">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                        </div>
                        <div class="send-button">
                            <a href="#" class="btn btn-primary btn-round btn-block btn-lg">Send Message</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-primary"></div>
        </div>
    </div>
</section>
@endsection

{{-- Scripts appended at the bottom of the page --}}
@section('js')
    <script>
        $(function() {
            // Smooth Scrolling
            $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                scrollTop: target.offset().top
                }, 1000);
                return false;
            }
            }
            });
        });
    </script>
@endsection