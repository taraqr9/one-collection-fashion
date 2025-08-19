@php
    use App\Enums\DefaultSortingEnum;
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('user.master')

@section('title')
    {{ config('app.name') }}
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
                    <select id="category_select" class="nice_select" name="parent_id">
                        <option value="">Select Category</option>
                        @foreach ($categories->where('parent_id', null)->sortBy('name') as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sorting_filter m-2" id="subcategory_filter_wrap" style="display:none;">
                    <select id="subcategory_select" class="nice_select" name="child_id" disabled>
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <div class="sorting_filter d-none d-sm-block m-2">
                    <select class="nice_select" name="sort">
                        @foreach (DefaultSortingEnum::options() as $key => $sort)
                            <option value="{{ $key }}">{{ $sort }}</option>
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
                            <div class="single_new_arrive">
                                <div class="sna_img">
                                    <img loading="lazy" class="prd_img"
                                         src="{{ $product->thumbnail_url }}"
                                         alt="product"/>

                                </div>
                                <div class="sna_content">
                                    <a href="product-view.html">
                                        <h4>{{ $product->name }}</h4>
                                    </a>
                                    <div class="ratprice">
                                        <div class="price">
                                            <span class="org_price"> TK {{ $product->price }}</span>
                                            @if($product->offer_price > 0)
                                                <span class="prev_price"> TK {{ $product->offer_price }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="product_adcart">
                                        <button class="default_btn">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination_wrp d-flex align-items-center justify-content-center mt-4">
                    <div class="single_paginat active">1</div>
                    <div class="single_paginat">2</div>
                    <div class="single_paginat">3</div>
                    <div class="single_paginat">4</div>
                    <div class="single_paginat"><i class="las la-long-arrow-alt-right"></i></div>
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

                hideSub();

                let ctrl = null;

                // delegated change handler (no addEventListener)
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
                        console.table(list.map(({id, name}) => ({id, name})));

                        if (!Array.isArray(list) || list.length === 0) {
                            hideSub();
                            return;
                        }

                        const opts = [opt('', 'Select Sub Category'), ...list.map(s => opt(String(s.id), s.name))];
                        setOptions(opts);

                        // ✅ enable native select
                        subSel.disabled = false;
                        subSel.removeAttribute('disabled');
                        subWrap.style.display = 'block';

                        // ✅ sync Nice Select UI (works if plugin loaded)
                        if (window.jQuery && jQuery.fn.niceSelect) {
                            jQuery(subSel).niceSelect('update');
                        } else {
                            // Fallback: at least remove disabled appearance from wrapper
                            const ns = subSel.nextElementSibling;
                            if (ns && ns.classList.contains('nice-select')) {
                                ns.classList.remove('disabled');
                                const current = ns.querySelector('.current');
                                if (current) current.textContent = subSel.options[0]?.textContent || 'Select Sub Category';
                            }
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
                    // keep Nice Select wrapper in sync when clearing
                    const ns = subSel.nextElementSibling;
                    if (ns && ns.classList.contains('nice-select')) {
                        ns.classList.add('disabled');
                    }
                }

                function hideSub() {
                    clearSub();
                    subWrap.style.display = 'none';
                }

                function showSub({loading = false} = {}) {
                    subWrap.style.display = 'block';
                    subSel.disabled = true;
                    setOptions([opt('', loading ? 'Loading…' : 'Select Sub Category')]);
                    const ns = subSel.nextElementSibling;
                    if (ns && ns.classList.contains('nice-select')) {
                        ns.classList.add('disabled');
                    }
                }
            })();
        });
    </script>

@endsection






