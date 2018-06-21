<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#">@if(Auth::user()->isOnline())<i class="fa fa-circle text-success"> Online</i> </a>@endif
        </div>
      </div>
      <!-- search form -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(Auth::user()->hasPermission("show-user"))
       <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> 
        <span>Dashboard</span></a></li>
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
            <li><a href="{{route('emp.index')}}"><i class="fa fa-circle-o"></i> Employee Info </a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Salary</a></li>
            <li class="active"><a href="{{route('des.index')}}"><i class="fa fa-circle-o"></i> Designation </a></li>
            <li><a href="{{route('dep.index')}}"><i class="fa fa-circle-o"></i> Department </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-comments"></i>
            <span>Chat Room</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/chat"><i class="fa fa-circle-o"></i> Chat </a></li>
          </ul>
        </li>
        @if(Auth::user()->hasPermission("show-user"))
        <li><a href="{{route('expense.index')}}"><i class="fa fa-dollar"></i><span>Expense</span></a></li>    
        @endif

        @if(Auth::user()->hasPermission("show-user"))
        <li><a href="{{route('client.index')}}"><i class="fa fa-handshake-o"></i><span> Clients </span></a></li>    
        @endif
      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Payroll</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('payroll.index')}}"><i class="fa fa-circle-o"></i> Payroll </a></li>
            <li><a href="{{url('/payslip')}}"><i class="fa fa-circle-o"></i> Payslip </a></li>
          </ul>
        </li>
        
        <li>
          <a href="{{url('calendar')}}">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
          </a>
        </li>
        
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>       
      </ul>
      @if(Auth::user()->hasPermission("show-user")) 
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Setting</li>  
          <!-- @if(Auth::user()->hasPermission("create-user"))
        <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> 
        <span>User Register</span></a></li>
          @endif -->
        <li><a href="{{ route('user.index') }}"><i class="fa fa-user-circle"></i> 
        <span>User profile</span></a></li>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>

