<li class="nav-item nav-item-submenu @if ($page == config('app.nav.category') || $page == config('app.nav.sub_category') || $page == config('app.nav.product')) nav-item-open @endif">

    <a href="#" class="nav-link"><i class="ph-identification-card"></i><span>Product</span></a>

    <ul class="nav-group-sub collapse  @if($page == config('app.nav.category') || $page == config('app.nav.sub_category') || $page == config('app.nav.product')) show @endif">

        <a href="{{ url('admin/products/category') }}"
           class="nav-link @if($page == config('app.nav.category')) active @endif">
            <i class="icon-database2"></i> <span>Category</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/products/sub_category') }}"
           class="nav-link @if($page == config('app.nav.sub_category')) active @endif">
            <i class="icon-database-menu"></i> <span>Sub Category</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/products/product') }}"
           class="nav-link @if($page == config('app.nav.product')) active @endif">
            <i class="icon-cube4"></i> <span>Product</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
    </ul>
<li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
</li>
