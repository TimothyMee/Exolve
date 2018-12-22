<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mouthpiece Nigeria</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="" >
    <meta name="description" content="Mouthpiece Nigeria is the go-to brand for creation of super high quality brand assets for individuals and small and medium enterprises. We specialize in creation of Logos, Banners, Promotional flyers, Magazines and all other types of print jobs. We also create video content for events, companies and brands.">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="/css/mouthpiece.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<!--  Banner starts here-->
<div class="bbimg" id="app">
    <div class="container-fluid navbar-dark">
        <nav class="navbar navbar-expand-lg container-fluid">
            <a class="navbar-brand "><img class="mylogo" src="./img/Mouthpiece Logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">How it works </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Our Services</a>
                    </li>
                    @if (!auth()->id())
                        <li class="nav-item active">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#LoginModal">Log In </a>
                        </li>
                        <li class="nav-item">
                            <button type="submit" class="btn btn-default rounded-0 btnsii" data-toggle="modal" data-target="#SignupModal">Create new account</button>
                        </li>

                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('logout')}}"><button type="submit" class="btn btn-default rounded-0 btnsii">Logout</button></a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div class="text-center">
        <h2 class="h1y">Are you ready to go viral?</h2>
        <p class="p1w">We provide visibility to your business irrespective of scale,optimized search<br>
            for registered business on the platform with rating based on customer<br>
            satisfaction</p>

        @if (!auth()->id())
        <button type="sign up"  class="btn btn-default rounded-0 btnsi" data-toggle="modal" data-target="#SignupModal">sign up</button>
        <button type="log in"  class="btn btn-default rounded-0 btnse" data-toggle="modal" data-target="#LoginModal">login to your account</button>
        @else
            <button class="btn btn-default rounded-0 btnse">explore our services</button>
        @endif
    </div>

    <div class="container-fluid bg_2">


        <div class="row pb-5">
            <div class="col-md-12">
                <video-component></video-component>
            </div>
        </div>

    </div>

</div>
<!--  Banner ends here-->

<!-- Modal -->
<div class="modal fade" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>

                <div class="text-center">
                    <img class="" src="/img/Mouthpiece%20Logo.png" width="90">
                </div>
            </div>

            <div class="modal-body">
                <p class="text-center text-primary">Create a free account with us to explore
                    <br> our services</p>
                <form action="{{route('sign-up')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control fontAwesome" autocomplete="name" name="name" placeholder="   Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control fontAwesome" autocomplete="email" name="email" placeholder="&#xf0e0   Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control fontAwesome" autocomplete="" name="phone" placeholder="&#xF095    Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control fontAwesome" name="password" placeholder="&#xF084   Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control fontAwesome" name="password_confirmation" placeholder="&#xF084   Confirm Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-white rounded-0 px-5" @click.prevent="createNewUser()">Sign Up</button>
                        <p class="text-center mt-3"><small class="text-white">Already have an account?</small></p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default rounded-0 px-5 mt-0">Log In</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--Login Modal-->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>

                <div class="text-center">
                    <img class="" src="/img/Mouthpiece%20Logo.png" width="90">
                </div>
            </div>

            <div class="modal-body">
                <p class="text-center text-primary">Login and explore
                    <br> our services</p>
                <form action="{{route('login')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" class="form-control fontAwesome" autocomplete="email" name="email" placeholder="&#xf0e0   Email">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control fontAwesome" name="password" placeholder="&#xF084   Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-white rounded-0 px-5" @click.prevent="login()">Login</button>
                        <p class="text-center mt-3"><small class="text-white">Don't have an account?</small></p>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default rounded-0 px-5 mt-0">Sign Up</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!--footer area-->
@include('layouts.footer')

{{--importing Scripts--}}
@include('layouts.scripts')
</body>
</html>
