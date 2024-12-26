<!DOCTYPE html>
<html>
  <head>
    @include('layouts.head')
  </head>
  <body>
    <header class="header">
      @include('layouts.header')
    </header>
    <div class="d-flex align-items-stretch">
      @include('layouts.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">@stack('breadcumb')</h2>
          </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            @yield('content')
          </div>
        </section>
        <footer class="footer">
          @include('layouts.footer')
        </footer>
      </div>
    </div>
    @include('layouts/script')
  </body>
</html>
