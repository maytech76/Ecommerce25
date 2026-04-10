@extends('admin.layouts.master')

@section('title', 'Mesas')

@section('content')

<div class="compact-wrapper">
    <div class="page-body-wrapper">
        <div class="page-body">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- card-Principal -->
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Listado de Mesas</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{route('tables.create')}}" class="align-items-center btn btn-theme d-flex">
                                            <i data-feather="plus-square"></i>+ Nueva
                                        </a>
                                    </form>
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="table-responsive table-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Nombre</th>
                                                    <th>Capacidad</th>
                                                    <th class="text-left">Descripción</th>
                                                    <th>Status</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($tables as $table )
                                                <tr>
                                                

                                                    <td>{{ $table->name }}</td>

                                                    <td>{{ $table->capacity }}</td>
                                                    
                                                    <td class="text-start">{{ $table->description }}</td>

                                                    <td>{{ $table->status }}</td>
                                                
                                                    <td>
                                                        <ul>
                                                            {{-- <li>
                                                                <a href="javascript:void(0)" class="view-table" data-table-id="{{ $table->id }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li> --}}

                                                            <li>
                                                                <a href="{{ route('tables.edit', $table->id) }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $table->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>   

                                                <!-- Modal de Eliminación -->
                                                <div class="modal fade" id="deleteModal{{ $table->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmar Suspensión</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que quieres suspender esta Mesa"{{ $table->name }}"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Suspender</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{-- Paginacion --}}
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-end mb-0">
                                                    {{-- Enlace Anterior --}}
                                                    <li class="page-item {{ $tables->onFirstPage() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $tables->previousPageUrl() }}" aria-label="Previous">
                                                            <span class="text-black" aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    
                                                    {{-- Enlaces de páginas --}}
                                                    @foreach ($tables->getUrlRange(1, $tables->lastPage()) as $page => $url)
                                                        <li class="page-item {{ $tables->currentPage() == $page ? 'active' : '' }}">
                                                            <a class="page-link text-black" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endforeach
                                                    
                                                    {{-- Enlace Siguiente --}}
                                                    <li class="page-item {{ !$tables->hasMorePages() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $tables->nextPageUrl() }}" aria-label="Next">
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

        </div>
    </div>
</div>

<!-- Modal para Visualizar Categoría -->
<div class="modal fade" id="viewTableModal" tabindex="-1" aria-labelledby="viewTableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTableModalLabel">Detalles de la Mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-md-4 text-center">
                        @if($table->photo ?? false)
                            <img id="tablePhoto" src="" class="img-fluid rounded-circle shadow-lg" alt="Table Photo" style="max-height: 200px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        @else
                            <img id="tablePhoto" src="{{ asset('assets/images/default-table.png') }}" class="img-fluid rounded-circle shadow-lg" style="max-height: 200px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        @endif
                    </div> --}}
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nombre:</th>
                                <td id="tableName"></td>
                            </tr>
                            <tr>
                                <th>Slug:</th>
                                <td id="tableSlug"></td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td id="tableDescription"></td>
                            </tr>
                            <tr>
                                <th>Creado:</th>
                                <td id="tableCreated"></td>
                            </tr>
                            <tr>
                                <th>Actualizado:</th>
                                <td id="tableUpdated"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.view-table').on('click', function() {
            const tableId = $(this).data('table-id');
            
            $.ajax({
                url: '/tables/' + tableId,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const table = response.table;
                        
                        // Actualizar la imagen en el modal
                        if (table.photo_url) {
                            $('#tablePhoto').attr('src', table.photo_url);
                        } else {
                            $('#tablePhoto').attr('src', '{{ asset('assets/images/default-table.png') }}');
                        }
                        
                        $('#tableName').text(table.name);
                        $('#tableSlug').text(table.slug);
                        $('#tableDescription').text(table.description || 'Sin descripción');
                        $('#tableCreated').text(table.created_at);
                        $('#tableUpdated').text(table.updated_at);
                        
                        $('#viewTableModal').modal('show');
                    }
                },
                error: function(xhr) {
                    alert('Error al cargar los datos de la categoría');
                }
            });
        });
    });
</script>
@endpush