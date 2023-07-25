<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
        <div class="user-image">
            <img src="{{ asset('admin/template/images/faces/face28.png') }}">
        </div>
        <div class="user-name">
          {{auth()->user()->name}}
        </div>
        <div class="user-designation">
            Developer
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dash') }}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @hasrole('super-admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="icon-shuffle menu-icon"></i>
                    <span class="menu-title">Role</span>
                </a>
            </li>
        @endhasrole
        @can('show-use')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">User</span>
                </a>
            </li>
        @endcan
        @can('show-product')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Product</span>
                </a>
            </li>
        @endcan
        @can('show-category')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="icon-file-add menu-icon"></i>
                    <span class="menu-title">Category</span>
                </a>
            </li>
        @endcan
        @can('show-coupon')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('coupons.index') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Coupon</span>
                </a>
            </li>
        @endcan
        @can('list-order')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="icon-bag menu-icon"></i>
                    <span class="menu-title">Order</span>
                </a>
            </li>
        @endcan
    </ul>
</nav>
