<!DOCTYPE html>
<html>
  <head>
    @push('title')
    Register
    @endpush
    @include('layouts.head')
  </head>
  <body>
    <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                    <div class="logo">
                      <h1>Registration</h1>
                    </div>
                    <p>Create your account to access exclusive features, manage your tasks, and stay organized effortlessly.</p>
                  </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form action="{{ route('register') }}" method="post" class="text-left form-validate">
                    @csrf
                    <div class="form-group-material">
                      <input id="register-name" type="text" name="name" value="{{ old('name') }}" class="input-material" >
                      <label for="register-name" class="label-material">Full Name</label>
                      @if ($errors->has('name'))<span class="text-danger"> {{ $errors->first('name') }}</span>@endif
                    </div>
                    <div class="form-group-material">
                      <input id="register-email" type="email" name="email" value="{{ old('email') }}"  class="input-material" >
                      <label for="register-email" class="label-material">Email Address</label>
                      @if ($errors->has('email'))<span class="text-danger"> {{ $errors->first('email') }}</span>@endif
                    </div>
                    <div class="form-group-material">
                      <input id="register-password" type="password" name="password" value=""  class="input-material" >
                      <label for="register-password" class="label-material">Password        </label>
                      @if ($errors->has('password'))<span class="text-danger"> {{ $errors->first('password') }}</span>@endif
                    </div>
                    <div class="form-group-material">
                        <input id="register-password-confirm" type="password" name="password_confirmation"  class="input-material" >
                        <label for="register-password-confirm" class="label-material">Confirm Password</label>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger"> {{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input id="register" type="submit" value="Register" class="btn btn-primary">
                    </div>
                  </form><small>Already have an account? </small><a href="{{ route('login') }}" class="signup">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.script')
  </body>
</html>
