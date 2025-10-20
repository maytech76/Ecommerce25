@extends('admin.layouts.master')


@section('content')

@section('title', 'product')


<div class="page-body">

    <!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Registro de Productos</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">

                                    <div class="row">
                                        <div class="col-md-6">

                                            {{-- Nombre del Producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class=" col-sm-3 mb-0">Nombre </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Product Name">
                                                </div>
                                            </div>

                                            {{-- Categorias --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Category</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single w-100 form-select border border-secondary" name="state">

                                                        <option disabled="">Category Menu</option>
                                                        <option>Electronics</option>
                                                    
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Marca del producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Marca</label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single w-100 form-select border border-secondary">
                                                        <option disabled="">Brand Menu</option>
                                                        <option value="puma">Puma</option>
                                                        <option value="hrx">HRX</option>
                                                        <option value="roadster">Roadster</option>
                                                        <option value="zara">Zara</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Nombre de la Unidad ****--}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Unidad </label>
                                                <div class="col-sm-9">
                                                    <select class="js-example-basic-single w-100 form-select border border-secondary">
                                                        <option disabled="">Unit Menu</option>
                                                        <option>Kilogram</option>
                                                        <option>Pieces</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Slug del producto --}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label ">Slug</label>
                                                <div class="col-sm-9">
                                                    <div class="bs-example">
                                                        <input type="text" class="form-control border border-secondary" placeholder="Type tag & hit enter" id="#inputTag" data-role="tagsinput">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Es intercambiable ***--}}
                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label">Intercambiable</label>
                                                <div class="col-sm-9">
                                                    <label class="switch sm-switch">
                                                        <input type="checkbox"><span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            {{-- Es reembolsable --}}
                                            <div class="row align-items-center">
                                                <label class="col-sm-3 col-form-label">Reembolso</label>
                                                <div class="col-sm-9">
                                                    <label class="switch sm-switch">
                                                        <input type="checkbox" checked><span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="col-md-6">

                                            {{-- descripcion --}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Descripción</h5>
                                                    </div>

                                                    <form class="theme-form theme-form-2 mega-form">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    
                                                                    <div class="col-sm-12">
                                                                        <textarea class="form-control w-100 form-control border border-secondary" name="" id="" cols="40" rows="4"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- Imagenes ***--}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Imagenes del Producto</h5>
                                                    </div>

                                                    <form class="theme-form theme-form-2 mega-form">
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-sm-3 col-form-label">Imagenes</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control form-choose" type="file" id="formFile" multiple="">
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center">
                                                            <label class="col-sm-3 col-form-label">Imagen Portada</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control form-choose" type="file" id="formFileMultiple1" multiple="">
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    
                                    <div class="row">

                                        <div class="col-md-6">
                                             {{-- Link de Video ***--}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Video de Producto</h5>
                                                    </div>

                                                    <form class="theme-form theme-form-2 mega-form">
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-sm-3 col-form-label ">Video
                                                                Provider</label>
                                                            <div class="col-sm-9">
                                                                <select class="js-example-basic-single w-100 form-select border border-secondary" name="state">
                                                                    <option>Vimeo</option>
                                                                    <option>Youtube</option>
                                                                    <option>Dailymotion</option>
                                                                    <option>Vimeo</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center">
                                                            <label class=" col-sm-3 mb-0">Video Link</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control border border-secondary" type="text" placeholder="Video Link">
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            {{-- Costos*** - precios - %Utiludad*** - $Ganancia***--}}
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-header-2">
                                                        <h5>Costos y Precios</h5>
                                                    </div>

                                                    <form class="theme-form theme-form-2 mega-form">
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-sm-3 ">Costo </label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control border border-secondary" type="text" placeholder="0">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-4 row align-items-center">

                                                            <div class="row pb-3">
                                                                <label class="col-sm-3 ">Precio 1</label>
                                                                <div class="col-sm-4">
                                                                    <input class="form-control border border-secondary" type="text" placeholder="0">
                                                                </div>

                                                                <div class="col-sm-2 mx-1">
                                                                    <label><strong>Utilidad-</strong></label>
                                                                    <span>25%</span>
                                                                </div>
    
                                                                <div class="col-sm-2">
                                                                    <label><strong>Ganancia</strong></label>
                                                                    <span>$5</span>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-sm-3">Precio 2</label>
                                                                <div class="col-sm-4">

                                                                    <input class="form-control border border-secondary" type="text" placeholder="0">

                                                                </div>
                                                                <div class="col-sm-2 mx-1">
                                                                    <label style="padding-bottom: -10px"><strong>Utilidad-</strong></label>
                                                                    <span>25%</span>
                                                                </div>
    
                                                                <div class="col-sm-2">
                                                                    <label><strong>Ganancia</strong></label>
                                                                    <span>$5</span>
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

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
    <!-- New Product Add End -->

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

@endsection