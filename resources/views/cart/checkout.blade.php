@extends('layouts.app')

@section('title','Seleccionar Mesa')

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Seleccionar Mesa</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Seleccionar Mesa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout-section-2 section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="left-sidebar-checkout">
                    
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        
                        @csrf
                        
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="../../ggihhudh.json" trigger="loop-on-hover" colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>

                                    <div class="checkout-box">
                                        
                                        <!-- Título de selección de mesa -->
                                        <div class="select_table_header text-center mb-4">
                                            <h3>Seleccione una Mesa</h3>
                                            <p class="text-muted">Elija la mesa donde desea recibir su pedido</p>
                                        </div>

                                        <!-- SELECT para elegir mesa -->
                                        <div class="form-group mb-4">
                                            <label for="table_id" class="form-label fw-bold fs-5">
                                                <i class="fa-solid fa-table me-2"></i>Mesas Disponibles:
                                            </label>
                                            <select name="table_id" id="table_id" class="form-select form-select-lg" required>
                                                <option value="">-- Seleccione una mesa --</option>
                                                @isset($tables)
                                                    @foreach($tables as $table)
                                                        @if($table->status == 'disponible' || $table->status == 'available')
                                                            <option value="{{ $table->id }}" 
                                                                {{ (old('table_id', $selectedTableId ?? '') == $table->id) ? 'selected' : '' }}>
                                                                {{ $table->name }} - Capacidad: {{ $table->capacity }} personas 
                                                                @if(isset($table->description))
                                                                    - {{ $table->description }}
                                                                @endif
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <small class="text-muted">
                                                <i class="fa-solid fa-info-circle"></i> Solo se muestran mesas con estado "disponible"
                                            </small>
                                        </div>

                                        <!-- Mostrar mesa seleccionada actualmente -->
                                        <div id="selectedTableDisplay" class="mt-3">
                                            @if(isset($selectedTable) && $selectedTable)
                                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                                    <i class="fa-solid fa-check-circle"></i> 
                                                    Mesa seleccionada: <strong>{{ $selectedTable->name }}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </li>

                                <li class="mt-4">
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="../../qmcsqnle.json" trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-detail">
                                            <button type="submit" class="btn theme-bg-color text-white btn-lg w-100 fw-bold" id="submitOrderBtn">
                                                <i class="fa-solid fa-clipboard-list me-2"></i> Procesar Pedido
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Resumen del pedido -->
<section class="summery-section mt-4">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="right-side-summery-box">
                    @php
                        $subTotal = $cartItems->sum('sub_total');
                        $total = $subTotal; // Sin costo de envío
                    @endphp

                    <div class="summery-box-2">
                        <div class="summery-header">
                            <h3>Detalle del Pedido</h3>
                        </div>

                        <ul class="summery-contain">
                            @foreach ($cartItems as $item)
                                <li>
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid blur-up lazyloaded checkout-image" alt="{{ $item->product->name }}">
                                    @endif
                                    <h4><span>{{ $item->quantity }} x </span> {{ $item->product->name }} </h4>
                                    <h4 class="price">$ {{ number_format($item->sub_total, 2) }}</h4>
                                </li>
                            @endforeach
                        </ul>

                        <ul class="summery-total">
                            <li>
                                <h4>Subtotal</h4>
                                <h4 class="price">$ {{ number_format($subTotal, 2) }}</h4>
                            </li>
                            
                            <li class="list-total mt-2 pt-2 border-top">
                                <h4>Total (USD)</h4>
                                <h4 class="price">$ {{ number_format($total, 2) }}</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Actualizar la visualización cuando se selecciona una mesa
    document.getElementById('table_id')?.addEventListener('change', function() {
        const select = this;
        const selectedOption = select.options[select.selectedIndex];
        const tableName = selectedOption.text;
        const tableId = select.value;
        
        const displayDiv = document.getElementById('selectedTableDisplay');
        
        if (tableId) {
            displayDiv.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <i class="fa-solid fa-check-circle"></i> 
                    Mesa seleccionada: <strong>${tableName}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        } else {
            displayDiv.innerHTML = '';
        }
    });
    
    // Validar el formulario antes de enviar
    document.getElementById('orderForm')?.addEventListener('submit', function(e) {
        const tableId = document.getElementById('table_id').value;
        
        if (!tableId) {
            e.preventDefault();
            alert('⚠️ Por favor, seleccione una mesa antes de continuar');
            document.getElementById('table_id').focus();
            return false;
        }
        
        if (confirm('¿Está seguro de procesar el pedido para esta mesa?')) {
            const submitBtn = document.getElementById('submitOrderBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Procesando...';
            return true;
        }
        
        e.preventDefault();
        return false;
    });
    
    // Mostrar mensajes de sesión
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('error'))
            alert('❌ {{ session('error') }}');
        @endif
        
        @if(session('success'))
            alert('✅ {{ session('success') }}');
        @endif
    });
</script>

<style>
    .theme-bg-color {
        background: linear-gradient(135deg, #0baf9a 0%, #0d9488 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .theme-bg-color:hover {
        background: linear-gradient(135deg, #0d9488 0%, #0baf9a 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(11, 175, 154, 0.3);
    }
    
    .form-select, .form-select-lg {
        padding: 12px 16px;
        font-size: 1.1rem;
        border-radius: 12px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .form-select:focus {
        border-color: #0baf9a;
        box-shadow: 0 0 0 0.2rem rgba(11, 175, 154, 0.25);
    }
    
    .checkout-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .alert-success {
        background-color: #e6f7f5;
        border-color: #0baf9a;
        color: #0d5c54;
    }
    
    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>
@endsection