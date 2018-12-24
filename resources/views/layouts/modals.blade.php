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
