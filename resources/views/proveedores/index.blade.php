@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name', 'SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">PROVEEDORES</a></li>
                    <li class="breadcrumb-item active">LISTA</li>
                </ol>
            </div>
            <h4 class="page-title">PROVEEDORES</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-8">
<!-- <form class="form-inline">
                        <div class="form-group">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                        </div>
                        <div class="form-group mx-sm-3">
                            <label for="status-select" class="mr-2">Sort By</label>
                            <select class="custom-select" id="status-select">
                                <option>Select</option>
                                <option>Date</option>
                                <option selected>Name</option>
                                <option>Revenue</option>
                                <option>Employees</option>
                            </select>
                        </div>
                    </form> -->
                </div>
                <div class="col-lg-4">
                    <div class="text-lg-right mt-3 mt-lg-0">
                        @can('create_proveedores')
                        <button type="button" class="btn btn-danger waves-effect waves-light mb-2" data-toggle="modal" data-target="#custom-modal"><i class="mdi mdi-plus mr-1"></i>Nuevo Proveedor</button>
                        @endcan
                    </div>
                </div><!-- end col-->
            </div> <!-- end row -->
        </div> <!-- end card-box -->
    </div><!-- end col-->
</div>
<!-- end row -->

<div class="row">
    @foreach($providers as $key => $u)
    <div class="col-lg-4">
        <div class="card-box bg-pattern">
            <div class="text-center">
                <img src="{{ asset('assets/images/companies/'.$u->provider_file) }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                <h4 class="mb-1 font-20">{{ $u->name }}</h4>
                <p class="text-muted  font-14">{{ $u->rfc }}</p>
            </div>

            <p class="font-14 text-center text-muted">
               Direccion: {{ $u->address }}
            </p>
            <p class="font-14 text-center text-muted">
               Telefono: {{ $u->phone }}
            </p>
            <p class="font-24 text-center text-muted">
             <a href="{{ $u->website }}" target="_blank" rel="noopener noreferrer"><i class="mdi mdi-web"></i></a>
            </p>
            @can('update_proveedores')
            <div class="text-center">
                <a href="{{route('proveedores.edit',$u->id)}}" class="btn btn-sm btn-info">Detalles</a>
            </div>
            <div class="row mt-4 text-center">
                <div class="col-6">
                    <h5 class="font-weight-normal text-muted">No.Cotizaciones</h5>
                    <h4>{{ $counts_cot['0']}}</h4>
                </div>
                <div class="col-6">
                    <h5 class="font-weight-normal text-muted">No.Compras</h5>
                    <h4>{{ $counts_com['0'] }}</h4>
                </div>
            </div>
            @endcan
        </div> <!-- end card-box -->
    </div><!-- end col -->
    @endforeach
</div>
<!-- end row -->


<!-- Modal -->
<div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Nuevo Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('proveedores.store') }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre o razon social:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa el nombre ">
                    </div>
                    <div class="form-group">
                        <label for="rfc">RFC:</label>
                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="Ingresar RFC ">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electronico:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefono:</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="98123123444">
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion:</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Calle 12 x 13 A Direcc">
                    </div>
                    <div class="form-group">
                        <label for="website">Sitio Web:</label>
                        <input type="text" class="form-control" name="website" id="website" placeholder="example.com">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion:</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="provider_file">Logotipo:</label>
                        <input type="file" name="provider_file" id="provider_file" class="form-control-file">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Registrar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">Cancelar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
