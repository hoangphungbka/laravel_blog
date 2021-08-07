@extends('layouts.app')

@section('content')
    @include('shared.organic-breadcrumb', ['name' => 'Shop Category Page', 'breadcrumb' => 'Fashion Category'])

    <div class="container mb-5">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                    @foreach($categories as $category)
                        <li class="main-nav-list">
                            <a href="#fruitsVegetable">{{ $category->name }}
                                <span class="number">{{ $category->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form action="#">
                            <ul>
                            @foreach($brands as $brand)
                                <li class="filter-list">
                                    <input class="pixel-radio" type="radio" id="apple" name="brand">
                                    <label for="apple">{{ $brand->name }}<span>({{ $brand->products_count }})</span></label>
                                </li>
                            @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
                                        Leather<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
                                        with red<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select onchange="window.location.href = window.location.href.includes('sort')
                            ? window.location.href.replace('sort={{ $sortField }}', 'sort=' + this.value)
                            : window.location.href.includes('?') ? window.location.href + '&sort=' + this.value
                            : window.location.href + '?sort=' + this.value">
                            <option value="id" {{ $sortField == 'id' ? 'selected' : '' }}>Default sorting Id</option>
                            <option value="calc_price" {{ $sortField == 'calc_price' ? 'selected' : '' }}>Default sorting Price</option>
                            <option value="name" {{ $sortField == 'name' ? 'selected' : '' }}>Default sorting Name</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select onchange="window.location.href = window.location.href.includes('per_page')
                            ? window.location.href.replace('per_page={{ $perPage }}', 'per_page=' + this.value)
                            : window.location.href.includes('?') ? window.location.href + '&per_page=' + this.value
                            : window.location.href + '?per_page=' + this.value">
                            <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>Show 6</option>
                            <option value="9" {{ $perPage == 9 ? 'selected' : '' }}>Show 9</option>
                            <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>Show 12</option>
                        </select>
                    </div>
                    @if($products->hasPages())
                    <div class="pagination">
                        <a href="{{ $products->previousPageUrl() }}" class="prev-arrow {{ $products->previousPageUrl() ? '' : 'disabled' }}">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </a>

                        @if($products->currentPage() > 3)
                            <a href="{{ $products->url(1) }}">1</a>
                        @endif
                        @if($products->currentPage() > 4)
                            <a href="" class="dot-dot disabled"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        @endif

                        @foreach(range(1, $products->lastPage()) as $index)
                            @if($index >= $products->currentPage() - 2 && $index <= $products->currentPage() + 2)
                                @if ($index == $products->currentPage())
                                    <a href="" class="active disabled">{{ $index }}</a>
                                @else
                                    <a href="{{ $products->url($index) }}">{{ $index }}</a>
                                @endif
                            @endif
                        @endforeach

                        @if($products->currentPage() < $products->lastPage() - 3)
                            <a href="" class="dot-dot disabled"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        @endif
                        @if($products->currentPage() < $products->lastPage() - 2)
                            <a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                        @endif

                        <a href="{{ $products->nextPageUrl() }}" class="next-arrow {{ $products->nextPageUrl() ? '' : 'disabled' }}">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    @endif
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="{{ $product->image }}" alt="Shoes">
                                <div class="product-details">
                                    <h6>{{ $product->name }}</h6>
                                    <div class="price">
                                        <h6>${{ number_format($product->price * $product->discount / 100, 2) }}</h6>
                                        <h6 class="l-through">${{ number_format($product->price, 2) }}</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select onchange="window.location.href = window.location.href.replace('per_page={{ $perPage }}', 'per_page=' + this.value)">
                            <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>Show 6</option>
                            <option value="9" {{ $perPage == 9 ? 'selected' : '' }}>Show 9</option>
                            <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>Show 12</option>
                        </select>
                    </div>
                    @if($products->hasPages())
                    <div class="pagination">
                        <a href="{{ $products->previousPageUrl() }}" class="prev-arrow {{ $products->previousPageUrl() ? '' : 'disabled' }}">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </a>

                        @if($products->currentPage() > 3)
                            <a href="{{ $products->url(1) }}">1</a>
                        @endif
                        @if($products->currentPage() > 4)
                            <a href="" class="dot-dot disabled"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        @endif

                        @foreach(range(1, $products->lastPage()) as $index)
                            @if($index >= $products->currentPage() - 2 && $index <= $products->currentPage() + 2)
                                @if ($index == $products->currentPage())
                                    <a href="" class="active disabled">{{ $index }}</a>
                                @else
                                    <a href="{{ $products->url($index) }}">{{ $index }}</a>
                                @endif
                            @endif
                        @endforeach

                        @if($products->currentPage() < $products->lastPage() - 3)
                            <a href="" class="dot-dot disabled"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        @endif
                        @if($products->currentPage() < $products->lastPage() - 2)
                            <a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                        @endif

                        <a href="{{ $products->nextPageUrl() }}" class="next-arrow {{ $products->nextPageUrl() ? '' : 'disabled' }}">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    @endif
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>

    @include('shared.related-product')
@endsection
