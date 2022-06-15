<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                <span data-feather="layers"></span>
                My Posts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
                <span data-feather="shopping-cart"></span>
                Products
            </a>
            </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/cart*') ? 'active' : '' }}" href="/dashboard/cart">
            <span data-feather="file"></span>
            Carts
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">
            <span data-feather="users"></span>
            Customers
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Reports
        </a>
        <li class="nav-item">
        <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Payment
        </a>
        </li>
        </li>
    </ul>

    @can('admin')
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrator</span>
    </h6>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active': '' }}" href="/dashboard/categories">
            <span data-feather="grid"></span>
            Product Categories
            </a>
        </li>
    </ul>
    @endcan

    </div>
</nav>