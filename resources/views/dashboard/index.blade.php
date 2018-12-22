<!DOCTYPE html>
<html>
<head>
    @include('layouts.head')
    <style>
        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            z-index: 1000;
        }


        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            color: #003580;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
            letter-spacing: 1px;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: #fff;
            background: #003580;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: #003580;
            position: absolute !important;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before, #progressbar li.active:after {
            background: green;
            color: white;
        }

    </style>

</head>

<body>
<div class="wrapper b_img">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <!--                    <h3>Bootstrap Sidebar</h3>-->
            <a href="{{route('home')}}"><img class="p-3" src="/img/Mouthpiece%20Logo.png"/></a>
        </div>

        <ul class="list-unstyled components ml-4">
            <div class="row my-4">
                <div class="col-md-2">
                    @if(auth()->user()->image == null)
                        <img class=" avatar" src="/img/user.png" alt="Profile Pic">
                    @else
                        <img class=" avatar" src="{{auth()->user()->image}}" alt="Profile Pic">
                    @endif

                </div>

                <div class="col-md-8">
                    <p class="text-white acc_name px-md-3 py-0 my-0">Welcome,</p>
                    <p class="acc_mail pl-md-3 py-0 mb-md-0 text-primary"><small class="align-top">{{auth()->user()->name}}</small></p>
                </div>
            </div>
            <li>
                <a href="{{route('dashboard')}}" class="text-white active"><span><img class="pr-4 pb-1" src="/img/home.png" alt="home" ></span> Home</a>
            </li>
            <li>
                <a href="{{route('add-video')}}" class="text-white"><span><img class="pr-4 pb-1" src="/img/verified.png" alt="home" ></span> Upload Video</a>
            </li>
            <li>
                <a href="{{route('pending-video')}}" class="text-white"><span><img class="pr-4 pb-1" src="/img/time-left.png" alt="pending" ></span> Pending</a>
            </li>
            <li>
                <a href="#" class="text-white"><span><img class="pr-4 pb-1" src="/img/analytics.png" alt="analytics" ></span> Analytics</a>
            </li>
            <li>
                <a href="#" class=" text-white"><span><img class="pr-4 pb-1" src="/img/promote.png" alt="promote" ></span> Promote</a>
            </li>

        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>


                <a class="navbar-brand none"><img class="mylogo" src="IMG/Mouthpiece Logo.png"></a>
                <button class="btn btn-light d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="nav-def fa fa-align-right"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#"><img src="/img/notification.png" alt="notification" width="20px" /></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#"><img src="/img/email.png" alt="email" width="20px" /></a>
                        </li>
                        <li class="nav-item mr-5 ml-3">
                            <a class="nav-link" href="#"><img src="/img/controls.png" alt="controls" width="20px" /></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!--    Main form Body starts or goes here-->



        <div class="container-fluid">
            <div class="row">

                <div class="container bg_2">


                    <div class="col-md-12 property_info">
                        @if(session('success'))
                            <div class="col-md-10">
                                <div class="alert alert-success">
                                    <p>{{session('success')}}</p>
                                </div>
                            </div>

                            <br><br>

                        @elseif(session('error'))
                            <div class="col-md-10">
                                <div class="alert alert-danger">
                                    <p>Profile wasn't updated. Try again later</p>
                                </div>
                            </div>

                            <br>
                        @endif
                        <p style="float: right; color: white"><a href="#" data-toggle="modal" data-target="#EditModal">Edit?</a></p>
                        <div class="row">
                            <div class="row col-md-6 text-white">
                                <div class="col-md-12">
                                    <h3 class="text-white">User Information</h3>
                                    <hr>
                                </div>
                                <div class="col-md-7">
                                    <h4>Name:</h4>
                                    <p style="color: black">{{auth()->user()->name}}</p>

                                    <h4>Email:</h4>
                                    <p style="color: black">{{auth()->user()->email}}</p>

                                    <h4>Phone:</h4>
                                    <p style="color: black">{{auth()->user()->phone}}</p>

                                    <h4>Username:</h4>
                                    @if(auth()->user()->username == null)
                                        <p style="color: black">No username has been set</p>
                                    @else
                                        <p style="color: black">{{auth()->user()->username}}</p>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <h6>Profile Image</h6>
                                    @if(auth()->user()->image == null)
                                        <img class="profile-img" src="/img/user.png" alt="Profile Pic">
                                        <p style="color: black">No image has been set</p>
                                    @else
                                        <img class="profile-img" src="{{auth()->user()->image}}" alt="Profile Pic">
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 text-white" style="border-left: 1px solid">
                                <h3 class="text-white">User Statistics</h3>
                                <hr>

                                <h4>No of Videos:</h4>
                                <p style="color: black">{{$data['videoCount']}}</p>

                                <h4>No of Views:</h4>
                                <p style="color: black">{{$data['viewCount']}}</p>

                                <h4>Status:</h4>
                                <p style="color: black">Active User</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--    main form ends here-->
    </div>
</div>


{{--modal--}}
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <img class="" src="/img/Mouthpiece%20Logo.png" width="90">
                </div>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center text-primary">Edit Information</p>
                <form action="{{route('edit-profile')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="" class="label">Username</label>
                        @if(auth()->user()->username)
                            <input type="text" class="form-control fontAwesome" name="username" value="{{auth()->user()->username}}">
                        @else
                            <input type="text" class="form-control fontAwesome" name="username" placeholder="Enter a username">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="" class="label">Email</label>
                        <input type="email" class="form-control fontAwesome" name="email" value="{{auth()->user()->email}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="label">Phone</label>
                        <input type="text" class="form-control fontAwesome" name="phone" value="{{auth()->user()->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="label">Profile Image</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <br><br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default rounded-0 px-5 mt-0">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--footer area-->

@include('layouts.footer')

</body>

@include('layouts.scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
</html>
