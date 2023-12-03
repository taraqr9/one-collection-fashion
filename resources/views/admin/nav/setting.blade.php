<li class="nav-item nav-item-submenu @if ($page == config('app.nav.top_banner') || $page == config('app.nav.mini_top_banner') || $page == config('app.nav.mini_bottom_banner') || $page == config('app.nav.mid_banner') || $page == config('app.nav.footer')) nav-item-open @endif">

    <a href="#" class="nav-link"><i class="ph-gear "></i><span>Setting</span></a>

    <ul class="nav-group-sub collapse  @if($page == config('app.nav.top_banner') || $page == config('app.nav.mini_top_banner') || $page == config('app.nav.mini_bottom_banner') || $page == config('app.nav.mid_banner') || $page == config('app.nav.footer')) show @endif">

        <a href="{{ url('admin/settings/top_banner') }}"
           class="nav-link @if($page == config('app.nav.top_banner')) active @endif">
            <i class="ph-file-image"></i> <span>Top Banner</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/settings/mini_top_banner') }}"
           class="nav-link @if($page == config('app.nav.mini_top_banner')) active @endif">
            <i class="ph-image"></i> <span>Mini Top Banner</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/settings/mini_bottom_banner') }}"
           class="nav-link @if($page == config('app.nav.mini_bottom_banner')) active @endif">
            <i class="ph-image"></i> <span>Mini Bottom Banner</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/settings/mid_banner') }}"
           class="nav-link @if($page == config('app.nav.mid_banner')) active @endif">
            <i class="ph-image"></i> <span>Mid Banner</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>

        <a href="{{ url('admin/settings/footer') }}"
           class="nav-link @if($page == config('app.nav.footer')) active @endif">
            <i class="ph-square-half-bottom"></i> <span>Footer</span>
        </a>
        <li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
    </ul>
<li style="border-bottom: 1px solid var(--nav-link-active-bg);"></li>
</li>
