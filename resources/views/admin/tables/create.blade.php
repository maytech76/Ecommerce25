@extends('admin.layouts.master')

@section('title', 'New Table')

@section('content')


<div class="compact-wrapper">
    <div class="page-body-wrapper">
        <div class="page-body">
            <!-- New Product Add Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-8 m-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header-2 w-100 mb-4 p-3" style="background-color: #f7f3f3 !important; border-radius:15px;">
                                            <h5 class="mb-0">Registro de Mesas</h5>
                                        </div>

                                        <form action="{{ route('tables.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="theme-form theme-form-2 mega-form">

                                                {{-- Nombre de la categoria --}}
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Nombre</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" id="name" name="name" type="text"  value="{{ old('name') }}" required placeholder="Ingresar Nombre">
                                                    </div>
                                                </div>

                                               
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Capacidad</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="capacity" id="capacity">{{ old('capacity') }}</input>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Descripción</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="description" id="description" cols="30" rows="2">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Status</label>
                                                    <div class="col-sm-9">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="disponible" {{ old('status') == 'diponible' ? 'selected' : '' }}>Disponible</option>
                                                            <option value="reservada" {{ old('status') == 'reservada' ? 'selected' : '' }}>Reservada</option>
                                                            <option value="inactiva" {{ old('status') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Botones con el layout que necesitas -->
                                                <div class="row mt-4">
                                                    
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <a href="{{ route('tables.index') }}" class="btn btn-secondary w-100">
                                                            <i class="ri-close-line"></i> Cancelar
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <button type="submit" class="btn btn-theme w-100">
                                                            <i class="ri-add-circle-line px-1"></i> Crear Mesa
                                                        </button>
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
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    // Vista previa de la imagen
    document.getElementById('photo').addEventListener('change', function(e) {
        const preview = document.getElementById('photoPreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
    </script>
    
@endpush