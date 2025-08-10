@extends('admin.layouts.master')


@section('content')

@section('title', 'Dashboard')

<div class="compact-wrapper">
    <div class="page-body-wrapper">
        <div class="page-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title d-sm-flex d-block">
                                    <h5>Products List</h5>
                                    <div class="right-options">
                                        <ul>
                                            {{-- <li>
                                                <a href="javascript:void(0)">import</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Export</a>
                                            </li> --}}
                                            <li>
                                                <a class="btn btn-solid" href="{{route('products.create')}} "> + Producto</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="table-responsive compact-table">
                                        <table class="table all-package theme-table table-product" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th class="col-photo">Photo</th>
                                                    <th class="col-name">Name</th>
                                                    <th class="col-category">Category</th>
                                                    {{-- <th class="col-qty">Qty</th> --}}
                                                    <th class="col-price">Price</th>
                                                    {{-- <th class="col-status">Status</th> --}}
                                                    <th class="col-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">{{$product->name}}</td>
                                                    <td class="text-nowrap">{{$product->category->name}}</td>
                                                   {{--  <td class="text-center">{{$product->stock}}</td> --}}
                                                    <td class="td-price">${{number_format($product->price, 2)}}</td>
                                                    {{-- <td class="status-danger"> --}}
                                                        {{-- <span>{{$product->status}}</span> --}}
                                                    {{-- </td> --}}
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="order-detail.html" class="text-primary">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" class="text-warning">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" class="text-danger">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- Enlace Siguiente --}}
                                        <!-- Mostrar la paginación -->
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-end mb-0">
                                                    {{-- Enlace Anterior --}}
                                                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                                            <span class="text-black" aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    
                                                    {{-- Enlaces de páginas --}}
                                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                                        <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                                                            <a class="page-link text-black" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endforeach
                                                    
                                                    {{-- Enlace Siguiente --}}
                                                    <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                                            <span class="text-black" aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            
        </div>
    </div>
</div>

<style>
    /* Estilos para compactar la tabla */
    .table-product {
        width: 90%;
        table-layout: auto;
        border-collapse: separate;
        border-spacing: 0 6px; /* Solo espaciado vertical entre filas */
    }

    .table-product thead th {
        white-space: nowrap;
        padding: 4px 2px; /* Reducir padding horizontal */
        font-size: 0.7rem;
        font-weight: 600;
    }


    .table-product tbody td {
        padding: 4px 2px; /* Reducir padding horizontal */
        vertical-align: middle;
        font-size: 0.79rem;
    }


    /* Columnas específicas con ajustes */
    .table-product td:first-child, 
    .table-product th:first-child {
        padding-left: 8px; /* Menor padding en primera columna */
    }

    .table-product td:last-child, 
    .table-product th:last-child {
        padding-right: 8px; /* Menor padding en última columna */
    }

    /* Ajustes para la columna de imagen */
    .table-image img {
        width: 15px; /* Tamaño fijo para imágenes */
        height: 15px;
        object-fit: cover;
        border-radius: 10px;
    }

    /* Ajustes para la columna de opciones */
    .table-product ul {
        display: flex;
        gap: 4px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .table-product ul li a {
        display: inline-flex;
        padding: 4px;
        color: #6c757d;
        transition: color 0.2s;
    }

    .table-product ul li a:hover {
        color: #0d6efd;
    }

    /* Estado compacto */
    .status-danger span {
        padding: 4px 4px;
        font-size: 0.8rem;
        border-radius: 4px;
    }

    /* Precio con formato compacto */
    .td-price {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        white-space: nowrap;
    }
    /* Estilos para la paginación en negro */
    .page-link.text-black {
        color: #469e85 !important;
    }

    .page-link.text-black:hover {
        color: #469e85  !important;
    }

    .page-item.active .page-link.text-black {
        color: #fff !important; /* Texto blanco cuando está activo */
        background-color: #469e85  !important; /* Fondo negro cuando está activo */
        border-color: #469e85  !important;
    }

    .page-item.disabled .page-link.text-black {
        color: #6c757d !important; /* Color gris para enlaces deshabilitados */
    }
</style>

@endsection