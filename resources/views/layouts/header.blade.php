<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">

      <span><b>Employee </span><sub style="color:#7f7777;"><i >Management</sub>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>

            @else
                <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">             
              <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
              
              <span class="hidden-xs">{{ Auth::user()->name }} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
              
                <p>
                  {{ Auth::user()->name}} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
            
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                                            Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                    </form>
                    @endguest
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

