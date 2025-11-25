@extends('admin.layouts.master')

@section('content')
@section('title', 'Edit product')

<div class="page-body">
    <!-- Edit Product Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Editar Producto</h5>
                                </div>

                                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">

                                            {{-- Nombre del Producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class=" col-sm-3 mb-0">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control border border-secondary" type="text" id="name" name="name" placeholder="Agregar Nombre del producto" value="{{ old('name', $product->name) }}">
                                                    @error('name')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Categorias --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Category</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single w-100 form-select border border-secondary" name="category_id" id="category_id">
                                                        <option value="">Seleccione una Categoria</option>
                                                        @foreach ($categories as $category)
                                                         <option value="{{$category->id}}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Marca del producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Marca</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single w-100 form-select border border-secondary" name="brand_id" id="brand_id">
                                                        <option value="">Selecciona un Marca</option>
                                                        @foreach ($brands as $brand)
                                                           <option value="{{$brand->id}}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Nombre de la Unidad --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Unidad </label>
                                                <div class="col-sm-9">
                                                    <select name="unit" id="unit" class="form-select border border-secondary">
                                                        <option value="">Seleccione una unidad</option>
                                                        <option value="UND" {{ old('unit', $product->unit) == 'UND' ? 'selected' : '' }}>UNIDAD</option>
                                                        <option value="CAJA" {{ old('unit', $product->unit) == 'CAJA' ? 'selected' : '' }}>CAJA</option>
                                                        <option value="PAR" {{ old('unit', $product->unit) == 'PAR' ? 'selected' : '' }}>PAR</option>
                                                        <option value="KIT" {{ old('unit', $product->unit) == 'KIT' ? 'selected' : '' }}>KIT</option>
                                                        <option value="SET" {{ old('unit', $product->unit) == 'SET' ? 'selected' : '' }}>SET</option>
                                                        <option value="JUEGO" {{ old('unit', $product->unit) == 'JUEGO' ? 'selected' : '' }}>JUEGO</option>
                                                        <option value="PIEZA" {{ old('unit', $product->unit) == 'PIEZA' ? 'selected' : '' }}>PIEZA</option>
                                                        <option value="MTS" {{ old('unit', $product->unit) == 'MTS' ? 'selected' : '' }}>METRO</option>
                                                        <option value="RECARGA" {{ old('unit', $product->unit) == 'RECARGA' ? 'selected' : '' }}>RECARGA</option>
                                                        <option value="KG" {{ old('unit', $product->unit) == 'KG' ? 'selected' : '' }}>KILOS</option>
                                                        <option value="LTS" {{ old('unit', $product->unit) == 'LTS' ? 'selected' : '' }}>LITROS</option>
                                                    </select>
                                                    @error('unit')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Slug del producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Slug</label>
                                                <div class="col-sm-9">
                                                    <div class="bs-example">
                                                        <input type="text" class="form-control border border-secondary" placeholder="Type tag & hit enter" id="slug" name="slug" data-role="tagsinput" value="{{ old('slug', $product->slug) }}">
                                                    </div>
                                                    @error('slug')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Es intercambiable --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label">Intercambiable</label>
                                                <div class="col-sm-9">
                                                    <label class="switch sm-switch">
                                                        <input type="checkbox" name="interchangeable" id="interchangeable" value="1" 
                                                            {{ old('interchangeable', $product->interchangeable) ? 'checked' : '' }}>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            {{-- Es reembolsable --}}
                                            <div class="row align-items-center">
                                                <label class="col-sm-3 col-form-label">Reembolso</label>
                                                <div class="col-sm-9">
                                                    <label class="switch sm-switch">
                                                        <input type="checkbox" name="refundable" id="refundable" value="1" 
                                                            {{ old('refundable', $product->refundable) ? 'checked' : '' }}>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            {{-- Status --}}
                                            <div class="row align-items-center mt-4">
                                                <label class="col-sm-3 col-form-label">Estado</label>
                                                <div class="col-sm-9">
                                                    <label class="switch sm-switch">
                                                        <input type="checkbox" name="status" id="status" value="1" 
                                                            {{ old('status', $product->status) ? 'checked' : '' }}>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="col-md-6" style="margin-top: -80px">

                                            {{-- descripcion --}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Descripción</h5>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control w-100 form-control border border-secondary" name="description" id="description" cols="40" rows="4">{{ old('description', $product->description) }}</textarea>
                                                                    @error('description')
                                                                        <div class="text-danger small">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Imagenes --}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Imagenes del Producto</h5>
                                                    </div>

                                                    {{-- Imagen Principal Actual --}}
                                                    @if($product->main_image)
                                                    <div class="row align-items-center mb-3">
                                                        <label class="col-sm-3 col-form-label">Imagen Actual</label>
                                                        <div class="col-sm-9">
                                                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="Imagen principal" class="img-thumbnail" style="max-height: 100px;">
                                                            <small class="form-text text-muted d-block">Imagen principal actual</small>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="row align-items-center mb-2">
                                                        <label class="col-sm-3 col-form-label">Nueva Imagen Portada</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-choose" type="file" id="main_image" name="main_image">
                                                            <small class="form-text text-muted">Dejar vacío para mantener la imagen actual</small>
                                                            @error('main_image')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div> 

                                                    {{-- Imágenes Adicionales Actuales --}}
                                                    @if($product->images->count() > 0)
                                                    <div class="row align-items-center mb-3">
                                                        <label class="col-sm-3 col-form-label">Imágenes Actuales</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                @foreach($product->images as $image)
                                                                <div class="col-3 mb-2">
                                                                    <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail" style="max-height: 60px;">
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <small class="form-text text-muted">{{ $product->images->count() }} imagen(es) adicional(es)</small>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label">+ Imágenes</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-choose" type="file" id="additional_images" name="additional_images[]" multiple="">
                                                            <small class="form-text text-muted">Agregar más imágenes al producto</small>
                                                            @error('additional_images.*')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- Codigo de Barra --}}
                                                    <div class="mt-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label ">Codigo de Barra</label>
                                                        <div class="col-sm-9">
                                                            <div class="bs-example">
                                                                <input type="text" class="form-control border border-secondary" placeholder="Ingrese Codigo de Barra" id="codebar" name="codebar" data-role="tagsinput" value="{{ old('codebar', $product->codebar) }}">
                                                            </div>
                                                            @error('codebar')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                             {{-- Link de Video --}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Video de Producto</h5>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 col-form-label ">Video Provider</label>
                                                        <div class="col-sm-9">
                                                            <select class="js-example-basic-single w-100 form-select border border-secondary" name="video_provider" id="video_provider">
                                                                <option value="vimeo" {{ old('video_provider', $product->video_provider) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                                                <option value="youtube" {{ old('video_provider', $product->video_provider) == 'youtube' ? 'selected' : '' }}>Youtube</option>
                                                                <option value="tiktok" {{ old('video_provider', $product->video_provider) == 'tiktok' ? 'selected' : '' }}>Tiktok</option>
                                                                <option value="custom" {{ old('video_provider', $product->video_provider) == 'custom' ? 'selected' : '' }}>Custom</option>
                                                                <option value="none" {{ old('video_provider', $product->video_provider) == 'none' ? 'selected' : '' }}>Ninguno</option>
                                                            </select>
                                                            @error('video_provider')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class=" col-sm-3">Video Link</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control border border-secondary" id="video_link" name="video_link" type="text" placeholder="Video Link" value="{{ old('video_link', $product->video_link) }}">
                                                            @error('video_link')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class=" col-sm-3">Existencia</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control border border-secondary" id="stock" name="stock" type="number" placeholder="Ingresar Existencia" value="{{ old('stock', $product->stock) }}">
                                                            @error('stock')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- Costos - precios - %Utiludad - $Ganancia--}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Costos y Precios</h5>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-3 ">Costo</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control border border-secondary" type="number" step="0.01" name="cost" placeholder="0" value="{{ old('cost', $product->cost) }}">
                                                            @error('cost')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-4 row align-items-center">
                                                        <div class="row pb-3">
                                                            <label class="col-sm-3 mt-4">Precio 1</label>
                                                            
                                                            <div class="col-sm-2 mx-1">
                                                                <label>Utilidad</label>
                                                                <span><input class="form-control border border-secondary" type="number" step="0.01" id="utility_percentage" name="utility_percentage" value="{{ old('utility_percentage', $product->utility_percentage) }}"></span>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <label>Ganancia</label>
                                                                <span><input class="form-control border border-secondary" type="number" step="0.01" id="profit" name="profit" value="{{ old('profit', $product->profit) }}"></span>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="">Precio 1</label>
                                                                <input class="form-control border border-secondary" type="number" step="0.01" name="price" id="price" placeholder="0" value="{{ old('price', $product->price) }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <label class="col-sm-3 mt-4">Precio 2</label>
                                                            
                                                            <div class="col-sm-2 mx-1">
                                                                <label style="padding-bottom: -10px">Utilidad</label>
                                                                <span><input class="form-control border border-secondary" type="text" step="0.01" id="utility_percentage2" name="utility_percentage2" value="{{ old('utility_percentage2', $product->utility_percentage2) }}"></span>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <label>Ganancia</label>
                                                                <span><input class="form-control border border-secondary" type="text" step="0.01" id="profit2" name="profit2" value="{{ old('profit2', $product->profit2) }}"></span>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <label for="">Precio2</label>
                                                                <input class="form-control border border-secondary" type="text" step="0.01" name="price2" id="price2" placeholder="0" value="{{ old('price2', $product->price2) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Botones con el layout que necesitas -->
                                    <div class="row mt-4">

                                        {{-- Cancelar->lista de productos --}}
                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">
                                                <i class="ri-close-line"></i> Cancelar
                                            </a>
                                        </div>

                                        {{-- Actualizar Producto --}}
                                        <div class="col-md-6 col-sm-12 mb-2">
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="ri-edit-line px-1"></i> Actualizar Producto
                                            </button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Product End -->

    <style>
        /* Switch pequeño (versión SM) */
        .switch.sm-switch {
            position: relative;
            display: inline-block;
            width: 42px;  /* Ancho reducido */
            height: 22px; /* Altura reducida */
        }

        .switch.sm-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch.sm-switch .switch-state {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 22px; /* Ajustado a la nueva altura */
        }

        .switch.sm-switch .switch-state:before {
            position: absolute;
            content: "";
            height: 18px;  /* Tamaño reducido */
            width: 18px;   /* Tamaño reducido */
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        .switch.sm-switch input:checked + .switch-state {
            background-color: #2ebe93; /* Color de Bootstrap para elementos activos */
        }

        .switch.sm-switch input:focus + .switch-state {
            box-shadow: 0 0 1px #2ebe93;
        }

        .switch.sm-switch input:checked + .switch-state:before {
            transform: translateX(20px); /* Ajustado al nuevo ancho */
        }
    </style>
</div>

@section('scripts')
<script>
    // Cálculos automáticos de precios
    document.addEventListener('DOMContentLoaded', function() {
        const costInput = document.querySelector('input[name="cost"]');
        const utilityInput = document.querySelector('input[name="utility_percentage"]');
        const profitInput = document.querySelector('input[name="profit"]');
        const priceInput = document.querySelector('input[name="price"]');

        function calculatePrice() {
            const cost = parseFloat(costInput.value) || 0;
            const utility = parseFloat(utilityInput.value) || 0;
            
            const profit = (cost * utility) / 100;
            const price = cost + profit;
            
            profitInput.value = profit.toFixed(2);
            priceInput.value = price.toFixed(2);
        }

        if (costInput && utilityInput) {
            costInput.addEventListener('input', calculatePrice);
            utilityInput.addEventListener('input', calculatePrice);
        }
    });
</script>
@endsection

@endsection