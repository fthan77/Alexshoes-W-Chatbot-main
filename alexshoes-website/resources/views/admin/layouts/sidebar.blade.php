<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('images/AlexShoes New Logo (1).png') }}" alt="Logo"
            style="width:60px; height:60px; object-fit:contain; margin-top:10px;">
        <span class="brand-text font-weight-light d-block mt-2">AlexShoes Admin</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about.index') }}"
                        class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>About Us</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('testimonials.index') }}"
                        class="nav-link {{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Testimonials</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>