@extends('layouts.app')
@section('custom_styles')
    <style>
        #message {
            display: none;
        }
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
@endsection
@section('content')
<section id="register">
    <div class="container d-flex justify-content-center h-100 align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white"><strong>Register as <span>Administrator</span></strong></div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" id="firstname" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ old('firstname') }}" required placeholder="First Name...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ old('lastname') }}" required placeholder="Last Name...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                </div>
                                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required placeholder="Email...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user-secret"></i></div>
                                </div>
                                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required placeholder="Password...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user-secret"></i></div>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password...">
                            </div>
                        </div>
                        
                        <div class="form-group" id="message">
                            <small>
                            <p>Password must contain the following:</p>
                            <ul style="list-style:none">
                                <li id="letter" class="invalid">A <b>lowercase</b> letter</li>
                                <li id="capital" class="invalid">A <b>capital (uppercase)</b> letter</li>
                                <li id="number" class="invalid">A <b>number</b></li>
                                <li id="length" class="invalid">Minimum <b>8 characters</b></li>
                                <li id="confirm" class="invalid"><b>Confirm </b>Password</li>
                            </ul>
                            </small>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-round btn-md form-control">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var confirm = document.getElementById("confirm-password");
var conf = document.getElementById('confirm');

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}

confirm.onkeyup = function(){
    if(confirm.value == myInput.value){
        conf.classList.remove("invalid");
        conf.classList.add("valid");
    } else {
        conf.classList.remove("valid");
        conf.classList.add("invalid");
    }
}
</script>
@endsection