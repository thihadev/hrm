<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/avatars/default.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{Auth::user()->name}} </p>
          <a href="#">@if(Auth::user()->isOnline())<i class="fa fa-circle text-success"> Online</i> </a>@endif
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::user()->hasPermission("show-user"))
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> 
        <span>Dashboard</span></a></li>
        @else
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> 
        <span>Home</span></a></li>
        @endif
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Employee</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="{{route('emp.index')}}"><i class="fa fa-circle-o"></i> Employee </a></li>
            <li class="active"><a href="{{route('des.index')}}"><i class="fa fa-circle-o"></i> Designation </a></li>
            <li><a href="{{route('dep.index')}}"><i class="fa fa-circle-o"></i> Department </a></li>
          </ul>
        </li>

        <li><a href="{{route('attendance.index')}}"><i class="fa fa-pencil-square-o"></i><span>Attendance</span></a></li>  

        <li><a href="{{route('project.index')}}"><i class="fa fa-bar-chart"></i><span>Project</span></a></li>    

        @if(Auth::user()->hasPermission("show-user"))
        <li><a href="{{route('expense.index')}}"><i class="fa fa-dollar"></i><span>Expense</span></a></li>    
        @endif

        @if(Auth::user()->hasPermission("show-user"))
        <li><a href="{{route('client.index')}}"><i class="fa fa-handshake-o"></i><span> Clients </span></a></li>    
        @endif

        @if(Auth::user()->hasPermission("show-user"))
          <li><a href="{{route('payroll.index')}}"><i class="fa fa-money"></i><span>Payroll</span></a></li>
        @endif

        <li>
          <a href="{{url('events')}}">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
          </a>
        </li>
        @if(Auth::user()->hasPermission("show-user"))
        <li>
          <a href="{{route('noticeboard.index')}}">
            <i class="fa fa-thumb-tack"></i> <span>Notice Board</span>
          </a>
        </li> 
        @endif  
      </ul>
      
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Setting</li>
      @if(Auth::user()->hasPermission("show-user"))   
          <!-- @if(Auth::user()->hasPermission("create-user"))
        <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> 
        <span>User Register</span></a></li>
          @endif -->
        <li><a href="{{ route('user.index') }}"><i class="fa fa-user-circle"></i> 
        <span>User profile</span></a></li>
        <li><a href="{{ route('setting.index') }}"><i class="fa fa-gears"></i> 
        <span>Setting</span></a></li>

      @endif
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open-o"></i>
            <span> Extra Page </span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="/chat"><i class="fa fa-circle-o"></i> Chat </a></li>
            <li><a href="/payslip"><i class="fa fa-circle-o"></i> Payslip Template </a></li>
          </ul>
        </li>
        <li><a href="{{url('about')}}"><i class="fa fa-user"></i> 
        <span>About Us</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

