<!DOCTYPE html>
<html>
  <head>
    @push('title')
    Login
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
                    <h1>Login</h1>
                  </div>
                  <p>Login your account to access exclusive features, manage your tasks, and stay organized effortlessly.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form action="{{ route('login') }}" method="post" class="form-validate">
                    @csrf
                    <div class="form-group">
                      <input id="login-email" type="text" name="email" value="{{ old('email') }}" class="input-material">
                      <label for="login-email" class="label-material">Email</label>
                      @if ($errors->has('email'))<span class="text-danger"> {{ $errors->first('email') }}</span>@endif
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                      @if ($errors->has('password'))<span class="text-danger"> {{ $errors->first('password') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <input id="login" type="submit" value="Login" class="btn btn-primary">
                      </div>
                  </form><small>Do not have an account? </small><a href="{{ route('register') }}" class="signup">Signup</a>
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
