@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name','SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">USUARIOS</a></li>
                    <li class="breadcrumb-item active">EDITAR</li>
                </ol>
            </div>
            <h4 class="page-title">Editar usuario {{ $user->name }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12 col-xl-8">
        <div class="card-box">
            <ul class="nav nav-pills navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        Configuración
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="settings">
                    <form method="POST" action="{{ route('usuarios.update', $user->id) }}" class="form-group">
                        @csrf
                        @method('PUT')
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Informacion Personal</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre completo</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NoEmpleado">No. Empleado</label>
                                    <input type="text" class="form-control" id="NoEmpleado" name="NoEmpleado" value="{{ $user->NoEmpleado }}">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no_seg_soc">No. Seguro Social</label>
                                    <input type="text" class="form-control" id="no_seg_soc" name="no_seg_soc" value="{{ $user->no_seg_soc }}">
                                </div>
                            </div> <!-- end col -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="userbio">Categoria</label>
                                    <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $user->categoria }}">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no_seg_soc">Coordinacion</label>
                                    <select id="coordinacion" name="coordinacion" class="form-control">
                                        @foreach ($coordinations as $i => $coordination )
                                        <option value="{{  old('coordinacion') ?? $coordination->id}}"
                                            @if($coordination->id === $user->coordinacion )
                                              selected
                                            @endif
                                            >{{$coordination->name}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="userbio">Departamento</label>
                                    <select  id="departamento" name="departamento" class="form-control">
                                        <option value="{{  old('coordinacion') ?? $coordination->id}}" disabled="true" selected="true"
                                        @if($user->depto === $user->depto)
                                        selected
                                        @endif
                                        >{{ $user->depto}}</option>
                                        </option>
                                    </select>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nivel">Nivel</label>
                                    <input type="text" class="form-control" id="nivel" name="nivel" value="{{ $user->nivel }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rfc">RFC</label>
                                    <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $user->rfc }}">
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="curp">CURP</label>
                                    <input type="text" class="form-control" id="curp" name="curp" value="{{ $user->curp }}">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fe_nacimiento">Fecha Nacimiento</label>
                                    <input type="text" class="form-control" id="fe_nacimiento" name="fe_nacimiento" value="{{ $user->fe_nacimiento }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fe_ingreso">Fecha Ingreso</label>
                                    <input type="text" class="form-control" id="fe_ingreso" name="fe_ingreso" value="{{ $user->fe_ingreso }}">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Confirmar contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="text-muted mt-3 mb-2">Lista de roles</p>
                                    @foreach ($roles as $id => $rol)
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="roles" name="roles[]" value="{{ $id }}" {{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }} >
                                            <label for="roles">{{$rol }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Registrar<span class="btn-label-right"><i class="mdi mdi-check-all"></i></span>
                                </button>
                                <a  href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">
                                    Cancelar<span class="btn-label-right"><i class="mdi mdi-close-outline"></i></span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end settings content-->

            </div> <!-- end tab-content -->
        </div> <!-- end card-box-->

    </div> <!-- end col -->
</div>
<!-- end row-->
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
    $('#coordinacion').on('change',function(e) {
        var coordinacion = e.target.value;
        $.ajax({
        url:"{{ route('coordinaciones.getDepartments') }}",
        type:"POST",
        data: {
                '_token': '{{csrf_token()}}',
                'coordinacion': coordinacion
            },
            success:function (data) {
                $('#departamento').empty();
                $.each(data.departments,function(i, val){
                $('#departamento').append('<option value="'+data.departments[i].departments['id']+'">'+data.departments[i].departments['name']+'</option>');
                })
            },
                error: function( error )
                {
                    alert( error );
                }
            })
        });
        });
</script>
@endpush
@endsection
