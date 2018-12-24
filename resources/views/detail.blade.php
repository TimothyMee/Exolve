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
<div class="bbimg" >
    <div class="container-fluid navbar-dark">
        <nav class="navbar navbar-expand-lg container-fluid">
            <a class="navbar-brand " href="{{route('home')}}"><img class="mylogo" src="/img/Mouthpiece Logo.png"></a>
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

    <div class="container-fluid" id="app">
        <video-details video-id="{{$id}}"></video-details>
    </div>



{{--
    <div class="container-fluid bg-black">
        <div class="row pt-3">
            <h6 class="font-weight-bold text-primary pl-3">Recommended</h6>
        </div>

        <div class="row py-3">
            <div class="col-md-4">
                <video width="320" height="240" controls poster="img/poster2.png">
                    <source src="vid/Blurry%20Video%20Of%20People%20Working.mp4" type="video/mp4">
                </video>
                <div>
                    <p class="text-white font-five mb-1">World's 5 Greatest Magic Tricks Finally... </p>
                    <ul class="list-inline">
                        <li class="list-inline-item text-white">@Facto  <i><img class="" src="img/verified.png" alt="verified" ></i> </li>
                        <li class="list-inline-item text-primary ml-md-3">100 views</li>
                        <li class="list-inline-item text-primary">2 months ago</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <video width="320" height="240" controls poster="img/poster.png">
                    <source src="vid/Blurry%20Video%20Of%20People%20Working.mp4" type="video/mp4">
                </video>
                <div>
                    <p class="text-white font-five mb-1">World's 5 Greatest Magic Tricks Finally... </p>
                    <ul class="list-inline">
                        <li class="list-inline-item text-white">@Facto  <i><img class="" src="img/verified.png" alt="verified" ></i> </li>
                        <li class="list-inline-item text-primary ml-md-3">100 views</li>
                        <li class="list-inline-item text-primary">2 months ago</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <video width="320" height="240" controls poster="img/poster2.png">
                    <source src="vid/Blurry%20Video%20Of%20People%20Working.mp4" type="video/mp4">
                </video>
                <div>
                    <p class="text-white font-five mb-1">World's 5 Greatest Magic Tricks Finally... </p>
                    <ul class="list-inline">
                        <li class="list-inline-item text-white">@Facto  <i><img class="" src="img/verified.png" alt="verified" ></i> </li>
                        <li class="list-inline-item text-primary ml-md-3">100 views</li>
                        <li class="list-inline-item text-primary">2 months ago</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
--}}

</div>

@include('layouts.modals')

<!--footer area-->
@include('layouts.footer')

{{--importing Scripts--}}
@include('layouts.scripts')
</body>
</html>
