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
                <span data-feather="grid"></span>
                Products
            </a>
            </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/transaksi*') ? 'active' : '' }}" href="/dashboard/transaksi">
            <span data-feather="shopping-cart"></span>
            Transaksi
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
            <span data-feather="check-square"></span>
            Orders
        </a>
        </li>
        <!-- </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
            <span data-feather="users"></span>
            Orders History
        </a>
        </li> -->
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/reports*') ? 'active': '' }}" href="/dashboard/reports">
            <span data-feather="bar-chart-2"></span>
            Reports
        </a>
        </li>
            <!-- <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/tables*') ? 'active' : '' }}" href="/dashboard/tables">
            <span data-feather="archive"></span>
                Tables
            </a>
            </li> -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active': '' }}" href="/dashboard/categories">
            <span data-feather="list"></span>
            Product Categories
            </a>
        </li>
    </ul>

    </div>
</nav>