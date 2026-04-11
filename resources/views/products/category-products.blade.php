@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Productos' : 'Todos los Productos')

@section('content')
<!-- Categorías Slider Section -->
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Categorías</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="categories-slider-wrapper">
                    <div class="categories-scroll-container">
                        @foreach ($categories as $cat)
                            <div class="category-card {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                                <a href="{{ route('category.products', ['id' => $cat->id, 'slug' => $cat->slug]) }}" class="category-link">
                                    <div class="offer-banner hover-effect">
                                        <img src="{{ asset('storage/' . $cat->photo) }}" class="img-fluid bg-img blur-up lazyload" alt="{{ $cat->name }}">
                                        <div class="offer-box">
                                            <span class="btn-category btn theme-bg-color text-white bg-opacity-30">
                                                {{ $cat->name }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .categories-slider-wrapper {
        position: relative;
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        cursor: grab;
    }
    
    .categories-slider-wrapper:active {
        cursor: grabbing;
    }
    
    @media (min-width: 992px) {
        .categories-slider-wrapper::-webkit-scrollbar {
            height: 0;
            display: none;
        }
        .categories-slider-wrapper {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
    }
    
    @media (max-width: 991px) {
        .categories-slider-wrapper::-webkit-scrollbar {
            height: 4px;
        }
    }
    
    .categories-scroll-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        padding: 10px 5px;
    }
    
    .category-card {
        flex: 0 0 auto;
        cursor: pointer;
    }
    
    .category-link {
        text-decoration: none;
        display: block;
    }
    
    @media (max-width: 767px) {
        .category-card {
            width: calc(33.333% - 14px);
            min-width: 150px;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991px) {
        .category-card {
            width: calc(33.333% - 14px);
            min-width: 180px;
        }
    }
    
    @media (min-width: 992px) and (max-width: 1199px) {
        .category-card {
            width: calc(25% - 15px);
            min-width: 200px;
        }
    }
    
    @media (min-width: 1200px) {
        .category-card {
            width: calc(25% - 15px);
            min-width: 220px;
        }
    }
    
    .offer-banner {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        height: 200px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .offer-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .offer-banner:hover img {
        transform: scale(1.05);
    }
    
    .offer-box {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
        padding: 0 10px;
    }
    
    .btn-category {
        display: inline-block;
        padding: 8px 15px;
        font-size: 14px;
        white-space: nowrap;
        background-color: rgba(0, 0, 0, 0.7);
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        color: white;
    }
    
    .btn-category:hover {
        background-color: rgba(0, 0, 0, 0.9);
        transform: translateY(-2px);
    }
    
    .category-card.active .offer-banner {
        border: 3px solid #ff6b6b;
        box-shadow: 0 0 15px rgba(255, 107, 107, 0.3);
    }
    
    .category-card.active .btn-category {
        background-color: #ff6b6b;
    }
    
    @media (max-width: 576px) {
        .offer-banner {
            height: 160px;
        }
        .btn-category {
            font-size: 12px;
            padding: 6px 12px;
        }
        .category-card {
            min-width: 130px;
        }
    }
    
    .loading-products {
        text-align: center;
        padding: 50px;
    }
    
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #ff6b6b;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- Product Section Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>
                @if(isset($category))
                    {{ $category->name }}
                @else
                    Todos los Productos
                @endif
            </h2>
            @if(isset($category))
                <p class="text-muted">{{ $category->description }}</p>
            @endif
        </div>

        <div id="products-container">
            @if($products->count() > 0)
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="product-box-4 wow fadeInUp">
                                <div class="product-image">
                                    <div class="label-flex">
                                        {{-- Botón wishlist comentado --}}
                                    </div>

                                    <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                        <img src="{{ $product->main_image_url }}" class="img-fluid" alt="{{ $product->name }}">
                                    </a>

                                    <ul class="option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Vista Rápida">
                                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                                <i class="iconly-Show icli"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-detail">
                                    <ul class="rating">
                                        @php 
                                            $rating = round($product->reviews()->avg('rating') ?? 0); 
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li>
                                                <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                        <h5 class="name">{{ $product->name }}</h5>
                                    </a>
                                    <h5 class="price theme-color">
                                        $ {{ number_format($product->price, 2) }}
                                        @if($product->price2)
                                            <del>$ {{ number_format($product->price2, 2) }}</del>
                                        @endif
                                    </h5>
                                    <div class="price-qty">
                                        {{-- Botones de cantidad y carrito comentados --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Paginación -->
                <div class="row">
                    <div class="col-12">
                        {{ $products->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fa fa-info-circle"></i> No hay productos disponibles en esta categoría.
                </div>
            @endif
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Newsletter Section Start -->
@include('partials.news')
<!-- Newsletter Section End -->

@endsection