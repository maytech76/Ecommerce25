@extends('admin.layouts.master')

@section('title', 'Zonas')

@section('content')

<div class="compact-wrapper">
    <div class="page-body-wrapper">
        <div class="page-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Listado de Zonas x Ciudad</h5>
                                    <button type="button" class="align-items-center btn btn-theme d-flex" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#createZoneModal">
                                        <i data-feather="plus-square"></i>+ Nueva Zona
                                    </button>
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Filtros -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <select class="form-select" id="filter_city">
                                            <option value="">Todas las ciudades</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" id="filter_status">
                                            <option value="">Todos los estados</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Activas</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactivas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="filter_search" placeholder="Buscar zona..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-secondary w-100" id="btn_filter">
                                            <i class="ri-filter-line me-1"></i>Filtrar
                                        </button>
                                    </div>
                                </div>

                                {{-- Tabla Listado de Zonas --}}
                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre de la Zona</th>
                                                    <th>Ciudad</th>
                                                    <th>Precio de Envío</th>
                                                    <th>Estado</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($zones as $zone)
                                                <tr>
                                                    <td>{{ $zone->id }}</td>
                                                    <td class="text-start">
                                                        <strong>{{ $zone->name }}</strong>
                                                    </td>
                                                    <td>
                                                        <span class="text-info">
                                                            {{ $zone->city->name ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <strong class="text-success">$ {{ number_format($zone->price, 2) }}</strong>
                                                    </td>
                                                    <td>
                                                        @if($zone->status == 1)
                                                            <span class="badge bg-success">Activa</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactiva</span>
                                                        @endif
                                                    </td>
                                                   
                                                    <td>
                                                        <ul>
                                                            <!-- Ver detalles -->
                                                            <li>
                                                                <a href="javascript:void(0)" class="view-zone" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#viewZoneModal"
                                                                   data-zone-id="{{ $zone->id }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>
                                                            
                                                            <!-- Editar -->
                                                            <li>
                                                                <a href="javascript:void(0)" class="edit-zone" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editZoneModal"
                                                                   data-zone-id="{{ $zone->id }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>
                                                            
                                                            <!-- Desactivar/Activar -->
                                                            @if($zone->status == 1)
                                                            <li>
                                                                <a href="javascript:void(0)" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#deactivateZoneModal{{ $zone->id }}">
                                                                    <i class="ri-delete-bin-line" style="color: #dc3545;"></i>
                                                                </a>
                                                            </li>
                                                            @else
                                                            <li>
                                                                <a href="javascript:void(0)" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#activateZoneModal{{ $zone->id }}">
                                                                    <i class="ri-checkbox-circle-line" style="color: #28a745;"></i>
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <!-- Modal de Desactivación -->
                                                <div class="modal fade" id="deactivateZoneModal{{ $zone->id }}" tabindex="-1" aria-labelledby="deactivateZoneModalLabel{{ $zone->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="deactivateZoneModalLabel{{ $zone->id }}">
                                                                    <i class="ri-shield-cross-line me-2"></i>Desactivar Zona
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <i class="ri-map-pin-line fs-1 text-danger"></i>
                                                                </div>
                                                                <p class="text-center fs-5">
                                                                    ¿Estás seguro de que deseas <strong class="text-danger">DESACTIVAR</strong> la zona?
                                                                </p>
                                                                <div class="card bg-light mb-3">
                                                                    <div class="card-body">
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Zona:</strong></div>
                                                                            <div class="col-7">{{ $zone->name }}</div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Ciudad:</strong></div>
                                                                            <div class="col-7">{{ $zone->city->name ?? 'N/A' }}</div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Precio:</strong></div>
                                                                            <div class="col-7">$ {{ number_format($zone->price, 2) }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><strong>Estado actual:</strong></div>
                                                                            <div class="col-7">
                                                                                <span class="badge bg-success">Activa</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-muted small text-center mt-3 mb-0">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    La zona no se eliminará permanentemente, solo se desactivará del sistema.
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="ri-close-line me-1"></i>Cancelar
                                                                </button>
                                                                <button type="button" class="btn btn-danger" onclick="deactivateZone({{ $zone->id }})">
                                                                    <i class="ri-delete-bin-line me-1"></i>Desactivar Zona
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal de Activación -->
                                                <div class="modal fade" id="activateZoneModal{{ $zone->id }}" tabindex="-1" aria-labelledby="activateZoneModalLabel{{ $zone->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="activateZoneModalLabel{{ $zone->id }}">
                                                                    <i class="ri-shield-check-line me-2"></i>Activar Zona
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <i class="ri-map-pin-line fs-1 text-success"></i>
                                                                </div>
                                                                <p class="text-center fs-5">
                                                                    ¿Estás seguro de que deseas <strong class="text-success">ACTIVAR</strong> la zona?
                                                                </p>
                                                                <div class="card bg-light mb-3">
                                                                    <div class="card-body">
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Zona:</strong></div>
                                                                            <div class="col-7">{{ $zone->name }}</div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Ciudad:</strong></div>
                                                                            <div class="col-7">{{ $zone->city->name ?? 'N/A' }}</div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5"><strong>Precio:</strong></div>
                                                                            <div class="col-7">$ {{ number_format($zone->price, 2) }}</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><strong>Estado actual:</strong></div>
                                                                            <div class="col-7">
                                                                                <span class="badge bg-danger">Inactiva</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-muted small text-center mt-3 mb-0">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    La zona estará disponible nuevamente en el sistema.
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="ri-close-line me-1"></i>Cancelar
                                                                </button>
                                                                <button type="button" class="btn btn-success" onclick="activateZone({{ $zone->id }})">
                                                                    <i class="ri-check-line me-1"></i>Activar Zona
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <div class="alert alert-info mb-0">
                                                            <i class="ri-information-line me-2"></i>No hay zonas registradas
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        {{-- Paginacion --}}
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                            {{ $zones->appends(request()->query())->links() }}
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

<!-- ============================================ -->
<!-- MODAL PARA CREAR NUEVA ZONA -->
<!-- ============================================ -->
<div class="modal fade" id="createZoneModal" tabindex="-1" aria-labelledby="createZoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createZoneModalLabel">
                    <i class="ri-add-circle-line me-2"></i>Nueva Zona de Envío
                </h5>
               
            </div>
            <form id="createZoneForm" action="{{ route('zones.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="zone_name" class="form-label">
                            <i class="ri-map-pin-line me-1"></i>Nombre de la Zona
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="zone_name" 
                               name="name" 
                               placeholder="Ej: Centro, La Parroquia, Zona Industrial"
                               required>
                        <div class="form-text text-muted">
                            Ingresa el nombre de la zona de envío.
                        </div>
                        <div id="zone_name_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="zone_city_id" class="form-label">
                            <i class="ri-building-line me-1"></i>Ciudad
                        </label>
                        <select class="form-select" id="zone_city_id" name="city_id" required>
                            <option value="">Seleccione una ciudad</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <div id="zone_city_id_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="zone_price" class="form-label">
                            <i class="ri-money-dollar-circle-line me-1"></i>Precio de Envío
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" 
                                   class="form-control" 
                                   id="zone_price" 
                                   name="price" 
                                   step="0.01" 
                                   min="0" 
                                   placeholder="0.00"
                                   required>
                        </div>
                        <div class="form-text text-muted">
                            Precio del envío para esta zona.
                        </div>
                        <div id="zone_price_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="zone_status" name="status" value="1" checked>
                        <label class="form-check-label" for="zone_status">
                            <i class="ri-checkbox-circle-line me-1"></i>Zona Activa
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-success" id="submitZoneBtn">
                        <i class="ri-save-line me-1"></i>Guardar Zona
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- MODAL PARA VER DETALLES DE ZONA -->
<!-- ============================================ -->
<div class="modal fade" id="viewZoneModal" tabindex="-1" aria-labelledby="viewZoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewZoneModalLabel">
                    <i class="ri-information-line me-2"></i>Detalles de la Zona
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong><i class="ri-map-pin-line me-1"></i> Nombre:</strong>
                            <div id="modalZoneName" class="text-muted mt-1">Cargando...</div>
                        </div>
                        <div class="mb-3">
                            <strong><i class="ri-building-line me-1"></i> Ciudad:</strong>
                            <div id="modalZoneCity" class="text-muted mt-1">Cargando...</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong><i class="ri-money-dollar-circle-line me-1"></i> Precio de Envío:</strong>
                            <div id="modalZonePrice" class="text-muted mt-1">Cargando...</div>
                        </div>
                        <div class="mb-3">
                            <strong><i class="ri-checkbox-circle-line me-1"></i> Estado:</strong>
                            <div id="modalZoneStatus" class="mt-1">Cargando...</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong><i class="ri-calendar-line me-1"></i> Fecha Creación:</strong>
                            <div id="modalZoneCreated" class="text-muted mt-1">Cargando...</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong><i class="ri-calendar-line me-1"></i> Última Actualización:</strong>
                            <div id="modalZoneUpdated" class="text-muted mt-1">Cargando...</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- MODAL PARA EDITAR ZONA -->
<!-- ============================================ -->
<div class="modal fade" id="editZoneModal" tabindex="-1" aria-labelledby="editZoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #be9012;">
                
                <h5 class="modal-title" id="editZoneModalLabel">
                    <i class="ri-edit-line me-2"></i>Editar Zona de Envío
                </h5>
                
            </div>
            <form id="editZoneForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_zone_id" name="zone_id">
                    
                    <div class="mb-3">
                        <label for="edit_zone_name" class="form-label">
                            <i class="ri-map-pin-line me-1"></i>Nombre de la Zona
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="edit_zone_name" 
                               name="name" 
                               required>
                        <div id="edit_zone_name_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_zone_city_id" class="form-label">
                            <i class="ri-building-line me-1"></i>Ciudad
                        </label>
                        <select class="form-select" id="edit_zone_city_id" name="city_id" required>
                            <option value="">Seleccione una ciudad</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <div id="edit_zone_city_id_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_zone_price" class="form-label">
                            <i class="ri-money-dollar-circle-line me-1"></i>Precio de Envío
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" 
                                   class="form-control" 
                                   id="edit_zone_price" 
                                   name="price" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                        </div>
                        <div id="edit_zone_price_error" class="invalid-feedback d-none"></div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="edit_zone_status" name="status" value="1">
                        <label class="form-check-label" for="edit_zone_status">
                            <i class="ri-checkbox-circle-line me-1"></i>Zona Activa
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning" id="updateZoneBtn">
                        <i class="ri-save-line me-1"></i>Actualizar Zona
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // 1. FILTROS
    // ============================================
    document.getElementById('btn_filter').addEventListener('click', function() {
        const city = document.getElementById('filter_city').value;
        const status = document.getElementById('filter_status').value;
        const search = document.getElementById('filter_search').value;
        
        let url = new URL(window.location.href);
        if (city) url.searchParams.set('city_id', city);
        else url.searchParams.delete('city_id');
        
        if (status !== '') url.searchParams.set('status', status);
        else url.searchParams.delete('status');
        
        if (search) url.searchParams.set('search', search);
        else url.searchParams.delete('search');
        
        window.location.href = url.toString();
    });
    
    // ============================================
    // 2. CREAR ZONA (AJAX)
    // ============================================
    const createZoneForm = document.getElementById('createZoneForm');
    
    if (createZoneForm) {
        createZoneForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            clearZoneErrors();
            
            const submitBtn = document.getElementById('submitZoneBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ri-loader-4-line ri-spin me-1"></i>Guardando...';
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', data.message || 'Zona creada exitosamente');
                    
                    const modal = bootstrap.Modal.getInstance(document.getElementById('createZoneModal'));
                    if (modal) modal.hide();
                    
                    createZoneForm.reset();
                    document.getElementById('zone_status').checked = true;
                    
                    setTimeout(() => location.reload(), 1000);
                } else {
                    if (data.errors) {
                        displayZoneErrors(data.errors);
                    } else {
                        showNotification('error', data.message || 'Error al crear la zona');
                    }
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Error de conexión al servidor');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    function clearZoneErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.classList.add('d-none'));
    }
    
    function displayZoneErrors(errors) {
        if (errors.name) {
            const input = document.getElementById('zone_name');
            input.classList.add('is-invalid');
            document.getElementById('zone_name_error').textContent = errors.name[0];
            document.getElementById('zone_name_error').classList.remove('d-none');
        }
        if (errors.city_id) {
            const input = document.getElementById('zone_city_id');
            input.classList.add('is-invalid');
            document.getElementById('zone_city_id_error').textContent = errors.city_id[0];
            document.getElementById('zone_city_id_error').classList.remove('d-none');
        }
        if (errors.price) {
            const input = document.getElementById('zone_price');
            input.classList.add('is-invalid');
            document.getElementById('zone_price_error').textContent = errors.price[0];
            document.getElementById('zone_price_error').classList.remove('d-none');
        }
    }
    
    // ============================================
    // 3. VER DETALLES DE ZONA
    // ============================================
    document.addEventListener('click', function(e) {
        if (e.target.closest('.view-zone')) {
            const button = e.target.closest('.view-zone');
            const zoneId = button.getAttribute('data-zone-id');
            if (zoneId) loadZoneDetails(zoneId);
        }
    });
    
    function loadZoneDetails(zoneId) {
        showZoneLoadingState();
        
        fetch(`/admin/zones/${zoneId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateZoneModalWithData(data.data);
                } else {
                    showZoneError(data.message || 'Error al cargar los datos');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showZoneError('Error al conectar con el servidor');
            });
    }
    
    function showZoneLoadingState() {
        document.getElementById('modalZoneName').textContent = 'Cargando...';
        document.getElementById('modalZoneCity').textContent = 'Cargando...';
        document.getElementById('modalZonePrice').textContent = 'Cargando...';
        document.getElementById('modalZoneStatus').innerHTML = '<span class="badge bg-secondary">Cargando...</span>';
        document.getElementById('modalZoneCreated').textContent = 'Cargando...';
        document.getElementById('modalZoneUpdated').textContent = 'Cargando...';
    }
    
    function updateZoneModalWithData(zone) {
        document.getElementById('modalZoneName').textContent = zone.name || 'No disponible';
        document.getElementById('modalZoneCity').textContent = zone.city_name || 'No disponible';
        document.getElementById('modalZonePrice').textContent = `$ ${parseFloat(zone.price).toFixed(2)}`;
        document.getElementById('modalZoneCreated').textContent = zone.created_at || 'No disponible';
        document.getElementById('modalZoneUpdated').textContent = zone.updated_at || 'No disponible';
        
        const statusBadge = zone.status == 1 
            ? '<span class="badge bg-success">Activa</span>' 
            : '<span class="badge bg-danger">Inactiva</span>';
        document.getElementById('modalZoneStatus').innerHTML = statusBadge;
    }
    
    function showZoneError(message) {
        document.getElementById('modalZoneName').textContent = 'Error';
        document.getElementById('modalZoneCity').textContent = 'N/A';
        document.getElementById('modalZonePrice').textContent = 'N/A';
        document.getElementById('modalZoneStatus').innerHTML = '<span class="badge bg-danger">Error</span>';
        document.getElementById('modalZoneCreated').textContent = 'N/A';
        document.getElementById('modalZoneUpdated').textContent = 'N/A';
    }
    
    // ============================================
    // 4. EDITAR ZONA
    // ============================================
    document.addEventListener('click', function(e) {
        if (e.target.closest('.edit-zone')) {
            const button = e.target.closest('.edit-zone');
            const zoneId = button.getAttribute('data-zone-id');
            if (zoneId) loadZoneForEdit(zoneId);
        }
    });
    
    function loadZoneForEdit(zoneId) {
        document.getElementById('edit_zone_name').disabled = true;
        document.getElementById('edit_zone_city_id').disabled = true;
        document.getElementById('edit_zone_price').disabled = true;
        document.getElementById('edit_zone_name').value = 'Cargando...';
        
        fetch(`/admin/zones/${zoneId}/edit-data`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('edit_zone_id').value = data.data.id;
                    document.getElementById('edit_zone_name').value = data.data.name;
                    document.getElementById('edit_zone_city_id').value = data.data.city_id;
                    document.getElementById('edit_zone_price').value = data.data.price;
                    document.getElementById('edit_zone_status').checked = data.data.status == 1;
                    document.getElementById('editZoneForm').action = `/admin/zones/${data.data.id}`;
                    
                    document.getElementById('edit_zone_name').disabled = false;
                    document.getElementById('edit_zone_city_id').disabled = false;
                    document.getElementById('edit_zone_price').disabled = false;
                } else {
                    alert('Error: ' + (data.message || 'No se pudieron cargar los datos'));
                    bootstrap.Modal.getInstance(document.getElementById('editZoneModal')).hide();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión al cargar los datos');
                bootstrap.Modal.getInstance(document.getElementById('editZoneModal')).hide();
            });
    }
    
    const editZoneForm = document.getElementById('editZoneForm');
    if (editZoneForm) {
        editZoneForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const updateBtn = document.getElementById('updateZoneBtn');
            const originalText = updateBtn.innerHTML;
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<i class="ri-loader-4-line ri-spin me-1"></i>Actualizando...';
            
            const zoneId = document.getElementById('edit_zone_id').value;
            const formData = new FormData(this);
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            fetch(`/admin/zones/${zoneId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', data.message || 'Zona actualizada exitosamente');
                    bootstrap.Modal.getInstance(document.getElementById('editZoneModal')).hide();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    if (data.errors) {
                        if (data.errors.name) {
                            document.getElementById('edit_zone_name').classList.add('is-invalid');
                            document.getElementById('edit_zone_name_error').textContent = data.errors.name[0];
                            document.getElementById('edit_zone_name_error').classList.remove('d-none');
                        }
                        if (data.errors.city_id) {
                            document.getElementById('edit_zone_city_id').classList.add('is-invalid');
                            document.getElementById('edit_zone_city_id_error').textContent = data.errors.city_id[0];
                            document.getElementById('edit_zone_city_id_error').classList.remove('d-none');
                        }
                        if (data.errors.price) {
                            document.getElementById('edit_zone_price').classList.add('is-invalid');
                            document.getElementById('edit_zone_price_error').textContent = data.errors.price[0];
                            document.getElementById('edit_zone_price_error').classList.remove('d-none');
                        }
                    } else {
                        showNotification('error', data.message || 'Error al actualizar la zona');
                    }
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Error de conexión al servidor');
                updateBtn.disabled = false;
                updateBtn.innerHTML = originalText;
            });
        });
    }
    
    // ============================================
    // 5. NOTIFICACIONES
    // ============================================
    function showNotification(type, message) {
        if (typeof $.notify === 'function') {
            $.notify({ message: message }, { type: type, placement: { from: "top", align: "right" }, delay: 3000 });
        } else {
            alert(message);
        }
    }
});

// ============================================
// FUNCIONES GLOBALES PARA ACTIVAR/DESACTIVAR
// ============================================

function deactivateZone(zoneId) {
    if (!confirm('¿Estás seguro de que deseas DESACTIVAR esta zona?')) return;
    
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch(`/admin/zones/${zoneId}/deactivate`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) { alert('✅ ' + data.message); location.reload(); }
        else { alert('❌ ' + (data.message || 'Error al desactivar')); }
    })
    .catch(error => { console.error('Error:', error); alert('❌ Error de conexión'); });
}

function activateZone(zoneId) {
    if (!confirm('¿Estás seguro de que deseas ACTIVAR esta zona?')) return;
    
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch(`/admin/zones/${zoneId}/activate`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) { alert('✅ ' + data.message); location.reload(); }
        else { alert('❌ ' + (data.message || 'Error al activar')); }
    })
    .catch(error => { console.error('Error:', error); alert('❌ Error de conexión'); });
}

console.log('✅ Scripts de zonas cargados correctamente');
</script>
@endpush