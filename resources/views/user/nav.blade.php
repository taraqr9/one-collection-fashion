@php use App\Models\Category; @endphp
<nav class="header axil-header header-style-5 home-2 ">

    <!-- Start Main Menu Area  -->
    <div class="axil-mainmenu aside-category-menu home-2">
        <div class="container">
            <div class="header-navbar">
                <div class="header-nav-department">
                    <aside class="header-department">
                        <a class="bars text-white header-department-text department-title"
                            href="{{ route('products.index') }}">
                            <span class="icon"> <i class="fal fa-bars" style="color: white;"></i></span>
                            <span class="icon_text">All categories</span>
                        </a>

                        <nav class="department-nav-menu sub-menu">

                            <div class="">
                                <i class="fas fa-times sidebar-close" style=""></i>
                            </div>

                            <ul class="nav-menu-list">
                                @foreach (Category::whereNull('parent_id')->with('children')->get() as $category)
                                    <li>
                                        <a href="{{ route('products.index', ['category_id' => $category->id]) }}"
                                           class="nav-link {{ $category->children->count() > 0 ? 'has-megamenu' : ''}}">
                                            <span class="menu-text">{{ $category->name }}</span>
                                        </a>
                                        @if ($category->children->count() > 0)
                                            <div class="department-megamenu">
                                                <div class="department-megamenu-wrap">
                                                    <div class="department-submenu-wrap">
                                                        <div class="department-submenu">
                                                            <h3 class="submenu-heading">{{ $category->name }}</h3>
                                                            <ul>
                                                                @foreach ($category->children as $child)
                                                                    <li>
                                                                        <a href="{{ route('products.index', ['category_id' => $child->parent_id, 'sub_category_id' => $child->id]) }}">
                                                                            {{ $child->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        </nav>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Menu Area  -->
</nav>
