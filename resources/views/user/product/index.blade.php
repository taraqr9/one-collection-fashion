@php
    use App\Enums\DefaultSortingEnum;
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('user.master')

@section('title')
    All Products
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="#" class="active">Shop</a>
        </div>
    </div>

    <div class="shop_wrap section_padding_b">
        <div class="container">

            <form action="{{ route('products.index') }}" method="get">
                <div class="d-flex align-items-center">
                    <div class="d-block d-lg-none">
                        <button class="default_btn py-2 me-3 rounded" id="mobile_filter_btn">Filter</button>
                    </div>

                    <div class="sorting_filter d-none d-sm-block m-2">
                        <select id="category_select" class="nice_select" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories->where('parent_id', null)->sortBy('name') as $category)
                                <option
                                    value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sorting_filter m-2" id="subcategory_filter_wrap" style="display:none;">
                        <select id="subcategory_select" class="nice_select" name="sub_category_id" disabled>
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>

                    <div class="sorting_filter d-none d-sm-block m-2">
                        <select class="nice_select" name="sort">
                            @foreach (DefaultSortingEnum::options() as $key => $sort)
                                <option value="{{ $key }}" @selected(request('sort') == $key)>{{ $sort }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="view_filter d-flex align-items-center ms-auto">
                        <button class="default_btn small rounded me-sm-3 me-2">Filter</button>
                    </div>
                </div>
            </form>
            <div class="shop_products">
                <div class="row gy-4">
                    @foreach($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('products.show', $product) }}">
                                <div class="single_new_arrive">
                                    <div class="sna_img">
                                        <img loading="lazy" class="prd_img"
                                             src="{{ $product->thumbnail?->url ? Storage::url($product->thumbnail->url) : asset('assets/images/no-image.png') }}"
                                             alt="product"/>

                                    </div>
                                    <div class="topariv_cont">
                                        <h4 class="text-truncate text-black text-sm">{{ $product->name }}</h4>
                                        <div class="price mb-1 mt-2">
                                            @if(($product->offer_price ?? 0) > 0)
                                                <span class="org_price">TK {{ $product->offer_price }}</span>
                                                <span class="org_price text-black text-sm"><del>{{ $product->price }}</del></span>
                                            @else
                                                <span class="org_price">TK {{ $product->price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="full_atc_btn">
                                        <button>
                                            <span class="me-1"><i class="icon-cart"></i></span>
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="pagination_wrp d-flex align-items-center justify-content-center mt-4">
                    @if ($products->onFirstPage())
                        <div class="single_paginat disabled"><i class="las la-long-arrow-alt-left"></i></div>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="single_paginat"><i
                                class="las la-long-arrow-alt-left"></i></a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <div class="single_paginat active">{{ $page }}</div>
                        @else
                            <a href="{{ $url }}" class="single_paginat">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="single_paginat"><i
                                class="las la-long-arrow-alt-right"></i></a>
                    @else
                        <div class="single_paginat disabled"><i class="las la-long-arrow-alt-right"></i></div>
                    @endif
                </div>

            </div>

        </div>
    </div>

@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            (() => {
                const subWrap = document.getElementById('subcategory_filter_wrap');
                const subSel = document.getElementById('subcategory_select');

                // inject the old request value from Laravel
                const preselectedSubId = "{{ request('sub_category_id') }}";

                hideSub();

                let ctrl = null;

                document.onchange = async function (e) {
                    const target = e.target || e.srcElement;
                    if (!target || target.id !== 'category_select') return;

                    const categoryId = target.value;

                    if (ctrl) ctrl.abort();
                    ctrl = new AbortController();

                    clearSub();

                    if (!categoryId) {
                        hideSub();
                        return;
                    }

                    showSub({loading: true});

                    try {
                        const res = await fetch(`/subcategories/${encodeURIComponent(categoryId)}`, {
                            method: 'GET',
                            headers: {'Accept': 'application/json'},
                            signal: ctrl.signal
                        });
                        if (!res.ok) throw new Error(`HTTP ${res.status}`);

                        const list = await res.json();

                        if (!Array.isArray(list) || list.length === 0) {
                            hideSub();
                            return;
                        }

                        // build options
                        const opts = [opt('', 'Select Sub Category')];
                        list.forEach(s => {
                            const o = opt(String(s.id), s.name);
                            if (preselectedSubId && preselectedSubId == s.id) {
                                o.selected = true; // mark selected if matches request
                            }
                            opts.push(o);
                        });

                        setOptions(opts);

                        subSel.disabled = false;
                        subSel.removeAttribute('disabled');
                        subWrap.style.display = 'block';

                        if (window.jQuery && jQuery.fn.niceSelect) {
                            jQuery(subSel).niceSelect('update');
                        }
                    } catch (err) {
                        if (err.name === 'AbortError') return;
                        console.error('Error fetching subcategories:', err);
                        hideSub();
                    }
                };

                // helpers
                function opt(value, label) {
                    const o = document.createElement('option');
                    o.value = value;
                    o.textContent = label;
                    return o;
                }

                function setOptions(options) {
                    subSel.replaceChildren(...options);
                }

                function clearSub() {
                    setOptions([opt('', 'Select Sub Category')]);
                    subSel.disabled = true;
                }

                function hideSub() {
                    clearSub();
                    subWrap.style.display = 'none';
                }

                function showSub({loading = false} = {}) {
                    subWrap.style.display = 'block';
                    subSel.disabled = true;
                    setOptions([opt('', loading ? 'Loading…' : 'Select Sub Category')]);
                }

                // auto-trigger on page load if category is preselected
                const catSel = document.getElementById('category_select');
                if (catSel.value) {
                    const event = new Event('change', {bubbles: true});
                    catSel.dispatchEvent(event);
                }
            })();
        });
    </script>

@endsection






