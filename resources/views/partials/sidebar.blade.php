<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Projects
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{request()->is('admin/category')?'active':''}}">
        <a class="nav-link" href="{{route('admin.category')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Project Category</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{request()->is('admin/project')?'active':''}}">
        <a class="nav-link" href="{{route('admin.project')}}">
            <i class="fas fa-fw fa-wrench"></i>
            <span>New Projects</span>
        </a>
    </li>
    <li class="nav-item {{request()->is('admin/project/all/view')?'active':''}}">
        <a class="nav-link" href="{{route('admin.list')}}">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Existing Projects</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>



    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.career')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Jobs</span></a>
    </li>

    <!-- Nav Item - Tables
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-table"></i>
            <span></span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->