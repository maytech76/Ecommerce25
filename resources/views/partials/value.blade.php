<section>
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Categorias</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="three-slider arrow-slider ratio_65">

                    <!-- Oferta 1 -->
                    <div>
                        <div class="offer-banner hover-effect">
                            <img src="{{ asset('assets/images/veg-3/value/1.png') }}" class="img-fluid bg-img blur-up lazyload" alt="Frutas y Verduras">
                            {{-- <div class="banner-detail">
                                <h5 class="theme-color">Compra más, ahorra más</h5>
                                <h6>Verduras frescas</h6>
                            </div> --}}
                            <div class="offer-box">
                                <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white bg-opacity-30">
                                    Nombre de Cat
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Oferta 2 -->
                    <div>
                        <div class="offer-banner hover-effect">
                            <img src="{{ asset('assets/images/veg-3/value/2.png') }}" class="img-fluid bg-img blur-up lazyload" alt="Verduras Orgánicas">
                            {{-- <div class="banner-detail">
                                <h5 class="theme-color">¡Ahorra más!</h5>
                                <h6>Verduras orgánicas</h6>
                            </div> --}}
                            <div class="offer-box">
                                <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white">
                                    Nombre de Cat 2
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Oferta 3 -->
                    <div>
                        <div class="offer-banner hover-effect">
                            <img src="{{ asset('assets/images/veg-3/value/3.png') }}" class="img-fluid bg-img blur-up lazyload" alt="Frutas y Verduras en oferta">
                            {{-- <div class="banner-detail">
                                <h5 class="theme-color">¡Ofertas Especiales!</h5>
                                <h6>Frutas y Verduras</h6>
                            </div> --}}
                            <div class="offer-box">
                                <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white">
                                    Nombre de Cat 3
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Oferta 4  -->
                    <div>
                        <div class="offer-banner hover-effect">
                            <img src="{{ asset('assets/images/veg-3/value/1.png') }}" class="img-fluid bg-img blur-up lazyload" alt="Frutas y Verduras en descuento">
                            {{-- <div class="banner-detail">
                                <h5 class="theme-color">Compra más, ahorra más</h5>
                                <h6>Frutas y Verduras</h6>
                            </div> --}}
                            <div class="offer-box">
                                <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white">
                                    Nombre de Cat 4
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Oferta 5 (Repetida de la 1) -->
                    <div>
                        <div class="offer-banner hover-effect">
                            <img src="{{ asset('assets/images/veg-3/value/1.png') }}" class="img-fluid bg-img blur-up lazyload" alt="Frutas y Verduras en descuento">
                            {{-- <div class="banner-detail">
                                <h5 class="theme-color">Compra más, ahorra más</h5>
                                <h6>Frutas y Verduras</h6>
                            </div> --}}
                            <div class="offer-box">
                                <button onclick="location.href = '{{ route('shop.index') }}';" class="btn-category btn theme-bg-color text-white">
                                    Nombre de Cat 4
                                </button>
                            </div>
                        </div>
                    </div>

                </div> <!-- Fin del slider -->
            </div>
        </div>
    </div>
    <style>
        /* Agrega esto en tu archivo CSS */
    .bg-opacity-30 {
        --bs-bg-opacity: 0.1;
    }
    </style>
</section>


