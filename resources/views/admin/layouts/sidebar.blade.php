<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Start Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.home') ? 'active' : 'collapsed' }}"
               href="{{ route('admin.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <!-- Start Products Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.products.*') ? 'active' : 'collapsed' }}"
               data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Products</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content collapse {{ Request::routeIs('admin.products.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Request::routeIs('admin.products.list') || Request::routeIs('admin.products.detail') ? 'active' : '' }}"
                       href="{{ route('admin.products.list') }}">
                        <i class="bi bi-circle"></i><span>List Product</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('admin.products.create') ? 'active' : '' }}"
                       href="{{ route('admin.products.create') }}">
                        <i class="bi bi-circle"></i><span>Create Product</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Products Nav -->

        <li class="nav-heading">Pages</li>

        <!--Start Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.profile.show') ? 'active' : 'collapsed' }}"
               href="{{ route('admin.profile.show') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->
    </ul>

</aside>
