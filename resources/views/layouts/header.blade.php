<header class="main-header">
    <!-- Logo -->
<div class="logo">

      <span class="logo-mini" ><i class="fa fa-group" style="margin-top: 15px;"></i></span>
      <span class="logo-lg" ><i class="fa fa-group" style="margin-top: 15px;"> HRM </i></span>
    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
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
              <li><a href="{{url('/changePassword')}}"><i class="fa fa-lock">&nbsp; &nbsp; Change Password </i></a></li>
              <li>
                <a href="/profile" ><i class="fa fa-user">&nbsp; &nbsp; Profile </i></a>
              </li>

                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-power-off">&nbsp;&nbsp; Sign out </i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                    </form>
                    @endguest
                
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

