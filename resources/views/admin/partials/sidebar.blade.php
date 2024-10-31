<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-tooth"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Aygun Dentist</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>



    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pages Components</h6>

                <a class="collapse-item" href="{{ route('admin.blogs.index') }}">Blogs</a>
                <a class="collapse-item" href="{{ route('admin.comments.index') }}">Şərhlər</a>

                <a class="collapse-item" href="{{ route('admin.gallery.index') }}">Gallery</a>
                <a class="collapse-item" href="{{ route('admin.services.index') }}">Our services</a>
                <a class="collapse-item" href="{{ route('pricing.index') }}">Prices</a>
                <a class="collapse-item" href="{{ route('header_images.index') }}">Header Image</a>
                <a class="collapse-item" href="{{ route('about_images.index') }}">About Image</a>
                <a class="collapse-item" href="{{ route('sliders.index') }}">Slider</a>
                <a class="collapse-item" href="{{ route('admin.contact-details.index') }}">Contact Details</a>
                <a class="collapse-item" href="{{ route('admin.contact.show') }}">Complaints-Suggestions</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reservation') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Reservation Data</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
