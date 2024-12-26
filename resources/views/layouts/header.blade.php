<nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <a href="index.html" class="navbar-brand">
          <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">{{ Str::ucfirst(Auth::user()->name ?? 'User') }}</strong></div>
          <div class="brand-text brand-sm"><strong class="text-primary">{{ Str::upper(substr(Auth::user()->name ?? 'User', 0, 1)) }}
        </strong></div></a>
        <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
      </div>
      <div class="right-menu list-inline no-margin-bottom">
        <div class="list-inline-item logout">
            <a id="logout" href="{{ route('logout') }}" onclick="confirmLogout(event)" class="nav-link">Logout <i class="icon-logout"></i></a>
        </div>
      </div>
    </div>
  </nav>
