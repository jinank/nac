<style>
    .os-scrollbar-horizontal{display: none}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
{{-- <a href="index3.html" class="brand-link">
   <img src="{{asset('/images/Logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  
   </a> --}}
    <div class="sidebar">

        <a href="{{url('admin/dashboard')}}" class="brand-link">
            {{-- <img src="http://15.206.87.117/suvarnakar-new/public/Theme2/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">NAC-Admin</span>
        </a>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item  ">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/users/') }}"
                        class="nav-link {{ Request::is('admin/users')||Request::is('admin/users/view')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manage Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/business') }}"
                        class="nav-link {{ Request::is('admin/business')||Request::is('admin/business/view')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Manage Businesses
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/videos/') }}"
                        class="nav-link {{ Request::is('admin/videos')||Request::is('admin/videos/view')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-play-circle"></i>
                        <p>
                            Manage Videos
                        </p>
                    </a>
                </li>





            </ul>







        </nav>
    </div>
</aside>
