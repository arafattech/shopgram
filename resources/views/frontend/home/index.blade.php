@extends('layouts.app')
@section('title', 'ShopGram - Online Shopping Bangladesh')
@section('content')

{{-- Hero Slider --}}
@if($banners->count())
<div id="heroSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($banners as $i => $banner)
        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/'.$banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}" style="max-height:480px;object-fit:cover">
            @if($banner->title)
            <div class="carousel-caption d-none d-md-block">
                <h2 class="fw-bold">{{ $banner->title }}</h2>
                @if($banner->subtitle)<p>{{ $banner->subtitle }}</p>@endif
                @if($banner->button_text && $banner->button_url)
                    <a href="{{ $banner->button_url }}" class="btn btn-primary">{{ $banner->button_text }}</a>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @if($banners->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    @endif
</div>
@endif

<div class="container py-5">

    {{-- Categories --}}
    @if($categories->count())
    <section class="mb-5">
        <h3 class="section-title">Shop by Category</h3>
        <div class="row g-3">
            @foreach($categories as $cat)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('category.show', $cat->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm text-center py-3 h-100">
                        @if($cat->image)
                            <img src="{{ asset('storage/'.$cat->image) }}" class="mx-auto mb-2 rounded-circle" style="width:60px;height:60px;object-fit:cover" alt="{{ $cat->name }}">
                        @else
                            <div class="mx-auto mb-2 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:60px;height:60px;font-size:1.5rem">
                                <i class="bi bi-grid {{ $cat->icon ?? '' }}"></i>
                            </div>
                        @endif
                        <span class="small fw-semibold text-dark">{{ $cat->name }}</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Featured Products --}}
    @if($featured->count())
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title mb-0">Featured Products</h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="row g-3">
            @foreach($featured as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- New Arrivals --}}
    @if($newArrivals->count())
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title mb-0">New Arrivals</h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="row g-3">
            @foreach($newArrivals as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Best Selling --}}
    @if($bestSelling->count())
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title mb-0">Best Sellers</h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="row g-3">
            @foreach($bestSelling as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Discount Products --}}
    @if($discounts->count())
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title mb-0">Special Offers</h3>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="row g-3">
            @foreach($discounts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <x-product-card :product="$product" />
            </div>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection
