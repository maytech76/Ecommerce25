@extends('admin.layouts.master')

@section('title', 'Gestión de Mesas')

@section('content')

<div class="compact-wrapper">
    <div class="page-body-wrapper">
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-6">
                            <h3>Gestión de Mesas</h3>
                        </div>
                        <div class="col-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visualización de Mesas en Cuadros -->
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tables-grid">
                                    @forelse($tables as $table)
                                    <div class="table-card 
                                        @if($table->status == 'disponible' || $table->status == 1)
                                            table-disponible
                                        @elseif($table->status == 'ocupada' || $table->status == 2)
                                            table-ocupada
                                        @elseif($table->status == 'reservada' || $table->status == 3)
                                            table-reservada
                                        @else
                                            table-inactiva
                                        @endif" 
                                        data-table-id="{{ $table->id }}"
                                        onclick="selectTable({{ $table->id }})">
                                        
                                        <div class="table-number">
                                            @if($table->status == 'disponible' || $table->status == 1)
                                                <h3 class="text-white"> {{ $table->name }}</h3>
                                            @elseif($table->status == 'reservada' || $table->status == 3)
                                                <h3 class="text-dark"> {{ $table->name }}</h3>
                                            @else
                                                <h3 class="text-white"> {{ $table->name }}</h3>
                                            @endif

                                        </div>
                                        
                                        <div class="table-capacity">
                                            @if($table->status == 'disponible' || $table->status == 1)
                                               <i class="fa fa-users text-white"></i><p class="text-white"> {{ $table->capacity }} personas</p>
                                              @elseif($table->status == 'reservada' || $table->status == 3)
                                               <i class="fa fa-users text-dark"></i><p class="text-dark"> {{ $table->capacity }} personas</p>
                                             @else
                                               <i class="fa fa-users text-white"></i><p class="text-white"> {{ $table->capacity }} personas</p>
                                            @endif
                                        </div>
                                        
                                        <div class="table-status">
                                            @if($table->status == 'disponible' || $table->status == 1)
                                                <span class="text-white">Disponible</span>
                                            @elseif($table->status == 'ocupada' || $table->status == 2)
                                                <span class="text-white">Ocupada</span>
                                            @elseif($table->status == 'reservada' || $table->status == 3)
                                                <span class="text-dark">Reservada</span>
                                            @else
                                                <span class="text-white">Inactiva</span>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No hay mesas registradas</p>
                                            <a href="{{ route('admin.tables.create') }}" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Crear primera mesa
                                            </a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tables-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    
    /* Estilos base de la card */
    .table-card {
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .table-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    
    /* ✅ Mesa Disponible - Verde */
    .table-card.table-disponible {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    /* ✅ Mesa Ocupada - Amarillo/Naranja */
    .table-card.table-ocupada {
        background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
    }
    
    /* ✅ Mesa Reservada - Azul */
    .table-card.table-reservada {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    /* ✅ Mesa Inactiva - Rojo */
    .table-card.table-inactiva {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }
    
    .table-number {
        font-size: 24px;
        font-weight: bold;
        color: white;
        margin-bottom: 10px;
    }
    
    .table-capacity {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 10px;
    }
    
    .table-status {
        margin-bottom: 15px;
    }
    
    .table-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }
    
    .table-actions .btn {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    /* Icono decorativo */
    .table-card::before {
        content: '🍽️';
        position: absolute;
        font-size: 50px;
        opacity: 0.1;
        bottom: -10px;
        right: -10px;
        transform: rotate(-15deg);
    }
    
    @media (max-width: 768px) {
        .tables-grid {
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 15px;
        }
        
        .table-number {
            font-size: 18px;
        }
        
        .table-capacity {
            font-size: 12px;
        }
        
        .table-card {
            padding: 15px;
        }
    }
</style>

<script>
    function selectTable(tableId) {
        alert('Mesa #' + tableId + ' seleccionada');
    }
    
    function editTable(tableId) {
        window.location.href = '/admin/tables/' + tableId + '/edit';
    }
    
    function deleteTable(tableId) {
        if (confirm('¿Estás seguro de que deseas eliminar esta mesa?')) {
            fetch('/admin/tables/' + tableId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al eliminar la mesa');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la mesa');
            });
        }
    }
    
    function toggleStatus(tableId) {
        fetch('/admin/tables/' + tableId + '/activate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al cambiar el estado');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cambiar el estado');
        });
    }
</script>

@endsection