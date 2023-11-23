<li class="nav-item nav-item-submenu @if ($page == config('app.nav.category') || $page == config('app.nav.sub_category')) nav-item-open @endif">

    <a href="#" class="nav-link"><i class="ph-identification-card"></i><span>Product</span></a>

    <ul class="nav-group-sub collapse  @if($page == config('app.nav.category') || $page == config('app.nav.sub_category')) show @endif">

        <a href="{{ url('admin/products/category') }}"
           class="nav-link @if($page == config('app.nav.category')) active @endif">
            <i class="ph-user-list"></i> <span>Category</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/products/sub_category') }}"
           class="nav-link @if($page == config('app.nav.sub_category')) active @endif">
            <i class="ph-user-list"></i> <span>Sub Category</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
    </ul>
<li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
</li>
