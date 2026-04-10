@extends('layouts.app')

@section('title','Inicio')

@section('content')
<!-- home section start -->
{{-- @include('partials.home') --}}
<!-- Home Section End -->

<!-- Value Section Start -->
{{-- @include('partials.value')  --}}
<!-- Value Section Start -->
<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Categorias</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Slider con scroll horizontal en todos los dispositivos -->
                <div class="categories-slider-wrapper">
                    <div class="categories-scroll-container">
                        @foreach ($categories as $category)
                            <div class="category-card">
                                <div class="offer-banner hover-effect">
                                    <img src="{{ asset('storage/' . $category->photo) }}" class="img-fluid bg-img blur-up lazyload" alt="{{ $category->name }}">
                                    <div class="offer-box">
                                        <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white bg-opacity-30">
                                            {{ $category->name }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Contenedor del slider - Scroll horizontal siempre visible */
    .categories-slider-wrapper {
        position: relative;
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch; /* Scroll suave en iOS */
        scroll-behavior: smooth;
        cursor: grab;
    }
    
    .categories-slider-wrapper:active {
        cursor: grabbing;
    }
    
    /* Estilo del scrollbar (opcional pero mejora UX) */
    .categories-slider-wrapper::-webkit-scrollbar {
        height: 8px;
    }
    
    .categories-slider-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .categories-slider-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .categories-slider-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    /* Contenedor flex para las cards */
    .categories-scroll-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        padding: 10px 5px;
    }
    
    /* Cards de categoría - Mismo ancho para todos los dispositivos */
    .category-card {
        flex: 0 0 auto;
    }
    
    /* RESPONSIVE: Cards visibles según dispositivo */
    
    /* Mobile (menos de 768px) - Mostrar 3 cards */
    @media (max-width: 767px) {
        .category-card {
            width: calc(33.333% - 14px); /* 3 cards visibles */
            min-width: 150px;
        }
        
        .categories-scroll-container {
            gap: 15px;
        }
    }
    
    /* Tablet (768px a 991px) - Mostrar 3 cards */
    @media (min-width: 768px) and (max-width: 991px) {
        .category-card {
            width: calc(33.333% - 14px); /* 3 cards visibles */
            min-width: 180px;
        }
        
        .categories-scroll-container {
            gap: 18px;
        }
    }
    
    /* Desktop (992px a 1199px) - Mostrar 4 cards */
    @media (min-width: 992px) and (max-width: 1199px) {
        .category-card {
            width: calc(25% - 15px); /* 4 cards visibles */
            min-width: 200px;
        }
        
        .categories-scroll-container {
            gap: 20px;
        }
    }
    
    /* Desktop Grande (1200px o más) - Mostrar 4 cards */
    @media (min-width: 1200px) {
        .category-card {
            width: calc(25% - 15px); /* 4 cards visibles */
            min-width: 220px;
        }
        
        .categories-scroll-container {
            gap: 20px;
        }
    }
    
    /* Estilos para las cards */
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
        width: auto;
        padding: 8px 15px;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background-color: rgba(0, 0, 0, 0.7);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-category:hover {
        background-color: rgba(0, 0, 0, 0.9);
        transform: translateY(-2px);
    }
    
    /* Ajuste para cards muy pequeñas */
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
    
    /* Flechas de navegación opcionales (para mejor UX en desktop) */
    .categories-slider-wrapper {
        position: relative;
    }
    
    /* Flechas con JavaScript opcional */
    .scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
    }
    
    .scroll-arrow:hover {
        background: rgba(0,0,0,0.8);
    }
    
    .scroll-arrow-left {
        left: 10px;
    }
    
    .scroll-arrow-right {
        right: 10px;
    }
    
    @media (max-width: 768px) {
        .scroll-arrow {
            display: none; /* Ocultar flechas en mobile */
        }
    }
</style>

<!-- Script opcional para flechas de navegación (mejora UX en desktop) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderWrapper = document.querySelector('.categories-slider-wrapper');
        
        // Crear botones de navegación (opcional)
        if (window.innerWidth >= 992) {
            const leftArrow = document.createElement('button');
            const rightArrow = document.createElement('button');
            
            leftArrow.innerHTML = '‹';
            rightArrow.innerHTML = '›';
            leftArrow.className = 'scroll-arrow scroll-arrow-left';
            rightArrow.className = 'scroll-arrow scroll-arrow-right';
            
            sliderWrapper.parentElement.style.position = 'relative';
            sliderWrapper.parentElement.appendChild(leftArrow);
            sliderWrapper.parentElement.appendChild(rightArrow);
            
            leftArrow.addEventListener('click', () => {
                sliderWrapper.scrollBy({ left: -300, behavior: 'smooth' });
            });
            
            rightArrow.addEventListener('click', () => {
                sliderWrapper.scrollBy({ left: 300, behavior: 'smooth' });
            });
            
            // Ocultar/mostrar flechas según el scroll
            const updateArrows = () => {
                const maxScroll = sliderWrapper.scrollWidth - sliderWrapper.clientWidth;
                leftArrow.style.opacity = sliderWrapper.scrollLeft <= 0 ? '0.3' : '1';
                rightArrow.style.opacity = sliderWrapper.scrollLeft >= maxScroll - 5 ? '0.3' : '1';
            };
            
            sliderWrapper.addEventListener('scroll', updateArrows);
            updateArrows();
        }
    });
</script>
<!-- Value Section End -->



<!-- Product Section Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Productos</h2>
        </div>

        @foreach ($topSellingProducts->chunk(6) as $chunk)
            <div class="row">
                @foreach ($chunk as $product)
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="product-box-4 wow fadeInUp">
                            <div class="product-image">
                                <div class="label-flex">
                                    {{-- <button class="btn p-0 wishlist btn-wishlist notifi-wishlist"
                                        onclick="addToWishlist({{ $product->id }}, '{{ asset('storage/' . $product->image) }}', '{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}', '{{ $product->price }}' , '{{ $product->name }}')">
                                        <i class="iconly-Heart icli"></i>
                                    </button> --}}
                                </div>

                                <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                    <img src="{{ asset('storage/' . $product->main_image) }}" class="img-fluid" alt="{{ $product->name }}">
                                    
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
                                    @php $rating = round($product->reviews()->avg('rating')) @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                    <h5 class="name">{{ $product->name }}</h6>
                                </a>
                                <h5 class="price theme-color">
                                    $ {{ number_format($product->price, 2) }}
                                    <del>$ {{ number_format($product->price2, 2) }}</del>
                                </h5>
                                <div class="price-qty">

                                    {{-- <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" onclick="updateQuantity({{ $product->id }}, 'minus')">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text" id="qty-{{ $product->id }}" value="1">
                                            <div class="qty-right-plus" onclick="updateQuantity({{ $product->id }}, 'plus')">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <button class="buy-button buy-button-2 btn btn-cart"
                                        onclick="addToCart({{ $product->id }}, '{{ asset('storage/' . $product->image) }}', '{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug]) }}', '{{ $product->price }}', '{{ $product->name }}')">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> <!-- Cierra el grupo de 6 productos -->
        @endforeach

    </div>
</section>
<!-- Product Section End -->

<!-- Newsletter Section Start -->
@include('partials.news')
<!-- Newsletter Section End -->


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Inicializar slider responsive
            $('.categories-mobile-slider').owlCarousel({
                loop: false,
                margin: 15,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 2.5,  // En mobile muestra 2.5 cards
                        nav: false,
                        margin: 10
                    },
                    576: {
                        items: 3,    // 3 cards en tablets pequeñas
                        margin: 15
                    },
                    768: {
                        items: 4,
                        margin: 15
                    },
                    992: {
                        items: 5,
                        margin: 20,
                        nav: true
                    }
                }
            });
        });
    </script>   
@endpush


