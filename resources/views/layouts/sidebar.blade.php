<nav id="sidebar">

    <ul class="list-unstyled">
            <li class="{{ request()->is('tasks*') ? 'active' : '' }}"><a href="{{ route('tasks.index') }}"> <i class="icon-home"></i>Tasks </a></li>
            <li><a href="{{ route('logout') }}" onclick="confirmLogout(event)"> <i class="icon-logout"></i>Logout</a></li>
    </ul>
  </nav>
