@extends('layouts.app')

@section('title','Inicio')

@section('content')
<!-- Value Section Start -->
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Categorias</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="categories-slider-wrapper">
                    <div class="categories-scroll-container">
                        @foreach ($categories as $category)
                            <div class="category-card">
                                <a href="{{ route('category.products', ['id' => $category->id]) }}" class="category-link">
                                    <div class="offer-banner hover-effect">
                                        <img src="{{ asset('storage/' . $category->photo) }}" class="img-fluid" alt="{{ $category->name }}">
                                        <div class="offer-box">
                                            <span class="btn-category btn theme-bg-color text-white">
                                                {{ $category->name }}
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
    /* Tus estilos CSS aquí */
    .categories-slider-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }
    
    .categories-scroll-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        padding: 10px 5px;
    }
    
    .category-card {
        flex: 0 0 auto;
        width: calc(25% - 15px);
        min-width: 200px;
    }
    
    @media (max-width: 767px) {
        .category-card {
            width: calc(33.333% - 14px);
            min-width: 150px;
        }
    }
    
    .offer-banner {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        height: 200px;
    }
    
    .offer-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .offer-box {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
    }
    
    .btn-category {
        display: inline-block;
        padding: 8px 15px;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 5px;
        color: white;
        text-decoration: none;
    }
    
    .category-link {
        text-decoration: none;
        display: block;
    }
</style>

<!-- Product Section Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Productos Destacados</h2>
        </div>

        <div class="row">
            @foreach ($topSellingProducts as $product)
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="product-box-4">
                        <div class="product-image">
                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                <img src="{{ $product->main_image_url }}" class="img-fluid" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="product-detail">
                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                <h5 class="name">{{ $product->name }}</h5>
                            </a>
                            <h5 class="price theme-color">
                                $ {{ number_format($product->price, 2) }}
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section Start -->
@include('partials.news')
<!-- Newsletter Section End -->

@endsection