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
            <span>Ana Səhifə</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        İnterfeys
    </div>



    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Səhifələr</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bütün səhifələr</h6>

                <a class="collapse-item" href="{{ route('admin.blogs.index') }}">Bloqlar</a>
                <a class="collapse-item" href="{{ route('admin.comments.index') }}">Şərhlər</a>

                <a class="collapse-item" href="{{ route('admin.gallery.index') }}">Qaleriya</a>
                <a class="collapse-item" href="{{ route('admin.services.index') }}">Xidmətlər</a>
                <a class="collapse-item" href="{{ route('pricing.index') }}">Qiymət Paketləri</a>
                <a class="collapse-item" href="{{ route('header_images.index') }}">Başlıq Rəsmi</a>
                <a class="collapse-item" href="{{ route('about_images.index') }}">Haqqında Rəsmi</a>
                <a class="collapse-item" href="{{ route('sliders.index') }}">Slider</a>
                <a class="collapse-item" href="{{ route('admin.contact-details.index') }}">Əlaqə Məlumatları</a>
                <a class="collapse-item" href="{{ route('admin.contact.show') }}">Təkliflər&Şikayətlər</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reservation') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Rezervasiya</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
