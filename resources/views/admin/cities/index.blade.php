@extends('admin.layouts.master')

@section('title', 'Ciudades')

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
                                    <h5>Listado de Ciudades</h5>
                                    {{-- CAMBIO: El botón ahora abre el modal en lugar de redirigir --}}
                                    <button type="button" class="align-items-center btn btn-theme d-flex" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#createCityModal">
                                        <i data-feather="plus-square"></i>+ Nueva Ciudad
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

                                {{-- Tabla Listado de Ciudades y Zonas --}}
                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Zonas</th>
                                                    <th>Creado</th>
                                                    <th>Status</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($cities as $city )
                                                <tr>
                                                    <td>{{ $city->name }}</td>
                                                    <td>
                                                        <span class="badge {{ $city->zones_count > 0 ? 'bg-warning' : 'bg-danger' }}">
                                                            {{ $city->zones_count }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $city->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($city->status == 1)
                                                            <span class="badge bg-success">Activa</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactiva</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <!-- Ver detalles -->
                                                            <li>
                                                                <a href="javascript:void(0)" class="view-city" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#viewCityModal"
                                                                   data-city-id="{{ $city->id }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>
                                                            
                                                            <!-- Editar -->
                                                            <li>
                                                                <a href="javascript:void(0)" class="edit-city" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editCityModal"
                                                                   data-city-id="{{ $city->id }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>
                                                
                                                <!-- Modal de Desactivación -->
                                                <div class="modal fade" id="deactivateModal{{ $city->id }}" tabindex="-1" aria-labelledby="deactivateModalLabel{{ $city->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="deactivateModalLabel{{ $city->id }}">
                                                                    <i class="ri-shield-cross-line me-2"></i>Desactivar Ciudad
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <i class="ri-building-line fs-1 text-danger"></i>
                                                                </div>
                                                                <p class="text-center fs-5">
                                                                    ¿Estás seguro de que deseas <strong class="text-danger">DESACTIVAR</strong> la ciudad?
                                                                </p>
                                                                
                                                                <div class="card bg-light mb-3">
                                                                    <div class="card-body">
                                                                        <div class="row mb-2">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-building-line me-1"></i> Ciudad:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                {{ $city->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-map-pin-line me-1"></i> Zonas asociadas:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <span class="badge {{ $city->zones_count > 0 ? 'bg-warning' : 'bg-secondary' }}">
                                                                                    {{ $city->zones_count }} zonas
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-checkbox-circle-line me-1"></i> Estado actual:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                @if($city->status == 1)
                                                                                    <span class="badge bg-success">Activa</span>
                                                                                @else
                                                                                    <span class="badge bg-danger">Inactiva</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if($city->zones_count > 0)
                                                                    <div class="alert alert-warning">
                                                                        <i class="ri-alert-line me-2"></i>
                                                                        <strong>¡Atención!</strong> Esta ciudad tiene {{ $city->zones_count }} zona(s) asociada(s). 
                                                                        Al desactivar la ciudad, también se desactivarán todas sus zonas.
                                                                    </div>
                                                                @else
                                                                    <div class="alert alert-info">
                                                                        <i class="ri-information-line me-2"></i>
                                                                        Esta ciudad no tiene zonas asociadas.
                                                                    </div>
                                                                @endif
                                                                
                                                                <p class="text-muted small text-center mt-3 mb-0">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    La ciudad no se eliminará permanentemente, solo se desactivará del sistema.
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="ri-close-line me-1"></i>Cancelar
                                                                </button>
                                                                <button type="button" class="btn btn-danger" onclick="deactivateCity({{ $city->id }})">
                                                                    <i class="ri-delete-bin-line me-1"></i>Desactivar Ciudad
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal de Activación -->
                                                <div class="modal fade" id="activateModal{{ $city->id }}" tabindex="-1" aria-labelledby="activateModalLabel{{ $city->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="activateModalLabel{{ $city->id }}">
                                                                    <i class="ri-shield-check-line me-2"></i>Activar Ciudad
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <i class="ri-building-line fs-1 text-success"></i>
                                                                </div>
                                                                <p class="text-center fs-5">
                                                                    ¿Estás seguro de que deseas <strong class="text-success">ACTIVAR</strong> la ciudad?
                                                                </p>
                                                                
                                                                <div class="card bg-light mb-3">
                                                                    <div class="card-body">
                                                                        <div class="row mb-2">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-building-line me-1"></i> Ciudad:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                {{ $city->name }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-map-pin-line me-1"></i> Zonas asociadas:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <span class="badge {{ $city->zones_count > 0 ? 'bg-warning' : 'bg-secondary' }}">
                                                                                    {{ $city->zones_count }} zonas
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <strong><i class="ri-checkbox-circle-line me-1"></i> Estado actual:</strong>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                @if($city->status == 1)
                                                                                    <span class="badge bg-success">Activa</span>
                                                                                @else
                                                                                    <span class="badge bg-danger">Inactiva</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if($city->zones_count > 0)
                                                                    <div class="alert alert-info">
                                                                        <i class="ri-information-line me-2"></i>
                                                                        <strong>Nota:</strong> Al activar esta ciudad, también se activarán todas sus zonas asociadas.
                                                                    </div>
                                                                @endif
                                                                
                                                                <p class="text-muted small text-center mt-3 mb-0">
                                                                    <i class="ri-information-line me-1"></i>
                                                                    La ciudad estará disponible nuevamente en el sistema.
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="ri-close-line me-1"></i>Cancelar
                                                                </button>
                                                                <button type="button" class="btn btn-success" onclick="activateCity({{ $city->id }})">
                                                                    <i class="ri-check-line me-1"></i>Activar Ciudad
                                                                </button>
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
                                                    <li class="page-item {{ $cities->onFirstPage() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $cities->previousPageUrl() }}" aria-label="Previous">
                                                            <span class="text-black" aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    {{-- Enlaces de páginas --}}
                                                    @foreach ($cities->getUrlRange(1, $cities->lastPage()) as $page => $url)
                                                        <li class="page-item {{ $cities->currentPage() == $page ? 'active' : '' }}">
                                                            <a class="page-link text-black" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endforeach
                                                    {{-- Enlace Siguiente --}}
                                                    <li class="page-item {{ !$cities->hasMorePages() ? 'disabled' : '' }}">
                                                        <a class="page-link text-black" href="{{ $cities->nextPageUrl() }}" aria-label="Next">
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

<!-- ============================================ -->
<!-- MODAL PARA CREAR NUEVA CIUDAD (AGREGADO) -->
<!-- ============================================ -->
<div class="modal fade" id="createCityModal" tabindex="-1" aria-labelledby="createCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createCityModalLabel">
                    <i class="ri-add-circle-line me-2"></i>Nueva Ciudad
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createCityForm" action="{{ route('cities.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="city_name" class="form-label">
                            <i class="ri-building-line me-1"></i>Nombre de la Ciudad
                        </label>
                        <input type="text" 
                               class="form-control @error('city_name') is-invalid @enderror" 
                               id="city_name" 
                               name="city_name" 
                               placeholder="Ej: San Fernando de Apure, Caracas, Maracaibo"
                               required>
                        <div class="form-text text-muted">
                            Ingresa el nombre completo de la ciudad.
                        </div>
                        <div id="city_name_error" class="invalid-feedback d-none"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-success" id="submitCityBtn">
                        <i class="ri-save-line me-1"></i>Guardar Ciudad
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- MODAL PARA VER DETALLES DE CIUDAD (EXISTENTE) -->
<!-- ============================================ -->
<div class="modal fade" id="viewCityModal" tabindex="-1" aria-labelledby="viewCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewCityModalLabel">
                    <i class="ri-information-line me-2"></i>Detalles de la Ciudad
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Nombre:</strong>
                            <div id="modalCityName" class="text-muted">Cargando...</div>
                        </div>
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            <div id="modalCityStatus">Cargando...</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Número de Zonas:</strong>
                            <div id="modalCityZones" class="text-muted">Cargando...</div>
                        </div>
                        <div class="mb-3">
                            <strong>Fecha de Creación:</strong>
                            <div id="modalCityCreated" class="text-muted">Cargando...</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Zonas -->
                <div class="mt-4">
                    <h6 class="border-bottom pb-2">
                        <i class="ri-map-pin-line me-2"></i>Zonas de la Ciudad
                    </h6>
                    <div id="zonesList">
                        <div class="text-center text-muted py-3">
                            <i class="ri-loader-4-line ri-spin fs-4"></i>
                            <p class="mt-2">Cargando zonas...</p>
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
<!-- MODAL PARA EDITAR CIUDAD -->
<!-- ============================================ -->
<div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editCityModalLabel">
                    <i class="ri-edit-line me-2"></i>Editar Ciudad
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCityForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_city_id" name="city_id">
                    <div class="mb-3">
                        <label for="edit_city_name" class="form-label">
                            <i class="ri-building-line me-1"></i>Nombre de la Ciudad
                        </label>
                        <input type="text" 
                               class="form-control" 
                               id="edit_city_name" 
                               name="name" 
                               required>
                        <div class="form-text text-muted">
                            Ingresa el nombre completo de la ciudad.
                        </div>
                        <div id="edit_city_name_error" class="invalid-feedback d-none"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_city_status" class="form-label">
                            <i class="ri-checkbox-circle-line me-1"></i>Estado
                        </label>
                        <select class="form-select" id="edit_city_status" name="status">
                            <option value="1">Activa</option>
                            <option value="0">Inactiva</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning" id="updateCityBtn">
                        <i class="ri-save-line me-1"></i>Actualizar Ciudad
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
        // 1. MANEJAR ENVÍO DEL FORMULARIO VÍA AJAX
        // ============================================
        const createCityForm = document.getElementById('createCityForm');
        
        if (createCityForm) {
            createCityForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                clearErrors();
                
                const submitBtn = document.getElementById('submitCityBtn');
                const originalBtnText = submitBtn.innerHTML;
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
                        showNotification('success', data.message || 'Ciudad creada exitosamente');
                        
                        const modal = bootstrap.Modal.getInstance(document.getElementById('createCityModal'));
                        if (modal) modal.hide();
                        
                        createCityForm.reset();
                        
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        if (data.errors) {
                            displayValidationErrors(data.errors);
                        } else {
                            showNotification('error', data.message || 'Error al crear la ciudad');
                        }
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('error', 'Error de conexión al servidor');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
            });
        }
        
        function clearErrors() {
            const errorElements = document.querySelectorAll('.is-invalid');
            errorElements.forEach(el => el.classList.remove('is-invalid'));
            
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach(el => el.classList.add('d-none'));
        }
        
        function displayValidationErrors(errors) {
            if (errors.city_name) {
                const cityNameInput = document.getElementById('city_name');
                cityNameInput.classList.add('is-invalid');
                
                const errorDiv = document.getElementById('city_name_error');
                errorDiv.textContent = errors.city_name[0];
                errorDiv.classList.remove('d-none');
            }
        }
        
        function showNotification(type, message) {
            if (typeof $.notify === 'function') {
                $.notify({
                    message: message
                }, {
                    type: type,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 3000,
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    }
                });
            } else {
                alert(message);
            }
        }
        
        // ============================================
        // 2. MANEJAR VISUALIZACIÓN DE DETALLES
        // ============================================
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-city')) {
                const button = e.target.closest('.view-city');
                const cityId = button.getAttribute('data-city-id');
                
                if (cityId) {
                    loadCityDetails(cityId);
                }
            }
        });
        
        function loadCityDetails(cityId) {
            showLoadingState();
            
            const url = `/admin/cities/${cityId}/details`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateModalWithData(data.data);
                    } else {
                        showError(data.message || 'Error al cargar los datos');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    showError('Error al conectar con el servidor');
                });
        }
        
        function showLoadingState() {
            document.getElementById('modalCityName').textContent = 'Cargando...';
            document.getElementById('modalCityStatus').innerHTML = '<span class="badge bg-secondary">Cargando...</span>';
            document.getElementById('modalCityZones').textContent = 'Cargando...';
            document.getElementById('modalCityCreated').textContent = 'Cargando...';
            document.getElementById('zonesList').innerHTML = `
                <div class="text-center text-muted py-3">
                    <i class="ri-loader-4-line ri-spin fs-4"></i>
                    <p class="mt-2">Cargando zonas...</p>
                </div>
            `;
        }
        
        function updateModalWithData(city) {
            document.getElementById('modalCityName').textContent = city.name || 'No disponible';
            document.getElementById('modalCityZones').textContent = city.zones_count || '0';
            document.getElementById('modalCityCreated').textContent = city.created_at || 'No disponible';
            
            const statusBadge = city.status == 1 
                ? '<span class="badge bg-success">Activa</span>' 
                : '<span class="badge bg-danger">Inactiva</span>';
            document.getElementById('modalCityStatus').innerHTML = statusBadge;
            
            updateZonesList(city.zones || []);
        }
        
        function updateZonesList(zones) {
            const zonesList = document.getElementById('zonesList');
            
            if (!zones || zones.length === 0) {
                zonesList.innerHTML = `
                    <div class="alert alert-info">
                        <i class="ri-information-line me-2"></i>No hay zonas registradas para esta ciudad
                    </div>
                `;
                return;
            }
            
            let zonesHtml = '<div class="table-responsive"><table class="table table-sm table-striped">';
            zonesHtml += `<thead><tr><th>Nombre</th><th>Precio</th><th>Estado</th></tr></thead><tbody>`;
            
            zones.forEach(zone => {
                zonesHtml += `
                    <tr>
                        <td>${zone.name || 'N/A'}</td>
                        <td>$${zone.price || '0.00'}</td>
                        <td>${zone.status_badge || '<span class="badge bg-secondary">N/A</span>'}</td>
                    </tr>
                `;
            });
            
            zonesHtml += '</tbody>}</table></div>';
            zonesList.innerHTML = zonesHtml;
        }
        
        function showError(message) {
            document.getElementById('modalCityName').textContent = 'Error';
            document.getElementById('modalCityStatus').innerHTML = '<span class="badge bg-danger">Error</span>';
            document.getElementById('modalCityZones').textContent = 'N/A';
            document.getElementById('modalCityCreated').textContent = 'N/A';
            document.getElementById('zonesList').innerHTML = `
                <div class="alert alert-danger">
                    <i class="ri-error-warning-line me-2"></i>${message}
                </div>
            `;
        }
    });
</script>

<script>
    // ============================================
    // SCRIPT PARA DESACTIVAR Y ACTIVAR CIUDADES
    // ============================================

    // Función para DESACTIVAR ciudad
    function deactivateCity(cityId) {
        console.log('🔴 Desactivando ciudad ID:', cityId);
        
        if (!confirm('¿Estás seguro de que deseas DESACTIVAR esta ciudad?')) {
            return;
        }
        
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!token) {
            alert('Error de seguridad: No se encontró el token CSRF');
            return;
        }
        
        // Mostrar estado de carga en el botón
        const btn = event?.target;
        const originalText = btn ? btn.innerHTML : 'Desactivar';
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line ri-spin me-1"></i>Desactivando...';
        }
        
        fetch(`/admin/cities/${cityId}/deactivate`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ ' + data.message);
                location.reload();
            } else {
                alert('❌ ' + (data.message || 'Error al desactivar la ciudad'));
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Error de conexión: ' + error.message);
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    }

    // Función para ACTIVAR ciudad
    function activateCity(cityId) {
        console.log('🟢 Activando ciudad ID:', cityId);
        
        if (!confirm('¿Estás seguro de que deseas ACTIVAR esta ciudad?')) {
            return;
        }
        
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!token) {
            alert('Error de seguridad: No se encontró el token CSRF');
            return;
        }
        
        // Mostrar estado de carga en el botón
        const btn = event?.target;
        const originalText = btn ? btn.innerHTML : 'Activar';
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line ri-spin me-1"></i>Activando...';
        }
        
        fetch(`/admin/cities/${cityId}/activate`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ ' + data.message);
                location.reload();
            } else {
                alert('❌ ' + (data.message || 'Error al activar la ciudad'));
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Error de conexión: ' + error.message);
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    }

    console.log('✅ Scripts de activación/desactivación cargados correctamente');
</script>

    {{-- // ============================================
        // SCRIPT PARA EDITAR CIUDAD
       // ============================================ --}}
    
<script>
    
    // Función para cargar datos de la ciudad en el modal de edición
    function loadCityForEdit(cityId) {
        console.log('📝 Cargando ciudad para editar ID:', cityId);
        
        // Mostrar loading en el modal
        document.getElementById('edit_city_name').value = 'Cargando...';
        document.getElementById('edit_city_name').disabled = true;
        document.getElementById('edit_city_status').disabled = true;
        
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/admin/cities/${cityId}/edit-data`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Llenar el formulario con los datos de la ciudad
                document.getElementById('edit_city_id').value = data.data.id;
                document.getElementById('edit_city_name').value = data.data.name;
                document.getElementById('edit_city_status').value = data.data.status;
                
                // Actualizar la acción del formulario
                document.getElementById('editCityForm').action = `/admin/cities/${data.data.id}`;
                
                // Habilitar campos
                document.getElementById('edit_city_name').disabled = false;
                document.getElementById('edit_city_status').disabled = false;
            } else {
                alert('Error: ' + (data.message || 'No se pudieron cargar los datos'));
                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('editCityModal'));
                if (modal) modal.hide();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión al cargar los datos');
            const modal = bootstrap.Modal.getInstance(document.getElementById('editCityModal'));
            if (modal) modal.hide();
        });
    }
    
    // Manejador para el botón de edición
    document.addEventListener('DOMContentLoaded', function() {
        // Delegación de eventos para los botones de edición
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-city')) {
                const button = e.target.closest('.edit-city');
                const cityId = button.getAttribute('data-city-id');
                
                if (cityId) {
                    // Resetear el formulario antes de cargar
                    const form = document.getElementById('editCityForm');
                    form.reset();
                    document.getElementById('edit_city_name').disabled = true;
                    document.getElementById('edit_city_status').disabled = true;
                    document.getElementById('edit_city_name').value = 'Cargando...';
                    
                    // Cargar los datos de la ciudad
                    loadCityForEdit(cityId);
                }
            }
        });
        
        // Manejador para el envío del formulario de edición
        const editCityForm = document.getElementById('editCityForm');
        if (editCityForm) {
            editCityForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const updateBtn = document.getElementById('updateCityBtn');
                const originalText = updateBtn.innerHTML;
                updateBtn.disabled = true;
                updateBtn.innerHTML = '<i class="ri-loader-4-line ri-spin me-1"></i>Actualizando...';
                
                const cityId = document.getElementById('edit_city_id').value;
                const formData = new FormData(this);
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                fetch(`/admin/cities/${cityId}`, {
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
                        // Mostrar mensaje de éxito
                        if (typeof showNotification === 'function') {
                            showNotification('success', data.message || 'Ciudad actualizada exitosamente');
                        } else {
                            alert('✅ ' + (data.message || 'Ciudad actualizada exitosamente'));
                        }
                        
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editCityModal'));
                        if (modal) modal.hide();
                        
                        // Recargar la página después de 1 segundo
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        if (data.errors && data.errors.name) {
                            const nameInput = document.getElementById('edit_city_name');
                            nameInput.classList.add('is-invalid');
                            const errorDiv = document.getElementById('edit_city_name_error');
                            errorDiv.textContent = data.errors.name[0];
                            errorDiv.classList.remove('d-none');
                        } else {
                            if (typeof showNotification === 'function') {
                                showNotification('error', data.message || 'Error al actualizar la ciudad');
                            } else {
                                alert('❌ ' + (data.message || 'Error al actualizar la ciudad'));
                            }
                        }
                        updateBtn.disabled = false;
                        updateBtn.innerHTML = originalText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (typeof showNotification === 'function') {
                        showNotification('error', 'Error de conexión al servidor');
                    } else {
                        alert('❌ Error de conexión al servidor');
                    }
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = originalText;
                });
            });
        }
    });
</script>
@endpush

