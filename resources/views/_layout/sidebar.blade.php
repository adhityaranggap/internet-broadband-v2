<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">{{ $appName }}</a>
          </div>
          @if(Auth::check() && auth()->user()->role_id != App\Role::ROLE_CUSTOMER)

          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown">
                <a href="{{route ('dashboard-index')}}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <!-- <ul class="dropdown-menu">
                  <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                  <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul> -->
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Transactions</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route ('unpaid-index') }}">Unpaid</a></li>
                  <li><a class="nav-link" href="{{route ('all-transaction-index')}}">All Transaction</a></li>
                  <li><a class="nav-link" href="#">Payments</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown {{ Str::startsWith(Request::path(),'users') === true  ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                  <li class="{{ Str::startsWith(Request::path(),'users/customers') ? 'active' : ''}}"><a class="nav-link" href="{{ route('customer-index') }}">Customers</a></li>
                  <li><a class="nav-link" href="{{ route('billing-index') }}">Billing</a></li>
                  <li><a class="nav-link" href="{{ route('active-user-index') }}">Active User</a></li>

                </ul>
              </li>
             
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Packages</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('customer-package-index') }}">Customer package</a></li>
                  <li><a href="{{ route('list-package-index') }}">List package</a></li>
                  <li><a href="#">Package Track</a></li>
 
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice"></i> <span>Ticket</span></a>
               
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('all-ticket-index') }}">All Ticket</a></li>
               
                  <li><a class="nav-link" href="#">Create Ticket</a></li>
                  <li><a class="nav-link" href=" ml">Unsolved Ticket</a></li>
                </ul>
                
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i> <span>Servers</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('all-router-index') }}">All Router</a></li>
                
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Review</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('review-index') }}">All Review</a></li>
                
                </ul>
              </li>
             
            </ul>

            <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div> -->
            @endif
        </aside>
      </div>