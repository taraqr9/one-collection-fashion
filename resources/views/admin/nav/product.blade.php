<li class="nav-item nav-item-submenu @if ($page == config('app.nav.product') || $page == config('app.nav.division') || $page == config('app.nav.area') || $page == config('app.nav.counter')) nav-item-open @endif">

    <a href="#" class="nav-link"><i class="ph-identification-card"></i><span>Product</span></a>

    <ul class="nav-group-sub collapse  @if($page == config('app.nav.product') || $page == config('app.nav.division') || $page == config('app.nav.area') || $page == config('app.nav.counter')) show @endif">

            <a href="{{ url('/cards/help_request') }}"
               class="nav-link @if($page == config('app.nav.help_request')) active @endif">
                <i class="ph-user-list"></i> <span>Help Request</span>
            </a>
            <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
    </ul>
<li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
</li>
