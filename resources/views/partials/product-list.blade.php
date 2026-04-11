@if($products->count() > 0)
    @foreach ($products->chunk(6) as $chunk)
        <div class="row">
            @foreach ($chunk as $product)
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
    @endforeach
@else
    <div class="alert alert-info text-center">
        <i class="fa fa-info-circle"></i> No hay productos disponibles en esta categoría.
    </div>
@endif