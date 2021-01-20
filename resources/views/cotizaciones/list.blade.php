@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name','SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">COTIZACIONES</a></li>
                    <li class="breadcrumb-item active">LISTA</li>
                </ol>
            </div>
            <h4 class="page-title">COTIZACIONES DEL DEPARTAMENTO</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-right">
                            <a href="{{ url()->previous() }}"
                                class="btn btn-sm btn-danger waves-effect waves-light mb-2">
                                <i class="mdi mdi-menu-left-outline"></i> Regresar</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table id="quotes-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <th style="text-align: center">Folio de requisicion</th>
                            <th style="text-align: center">Fecha de cotizacion</th>
                            <th style="text-align: center">No.Cotizaciones</th>
                            <th style="text-align: center">Opciones</th>
                        </thead>
                        @foreach($quotes as $key => $q)
                            <tbody>
                            <td style="text-align: center">{{ $q->requisition->folio }}</td>
                            <td style="text-align: center">{{ \Carbon\Carbon::parse($q->requisition->created_at)->format('Y/m/d') }}</td>
                            <td style="text-align: center">
                                <a href="#" class="badge badge-dark">{{ $count[$key] }}</a></td>
                            <td style="text-align: center">
                                @can('read_quotes')
                                    <a title="Ver cotizaciones" href="{{route('cotizaciones.show',$q->requisition->id)}}"
                                    class="action-icon">
                                        <i style="center" class="mdi mdi-archive"></i></a>
                                    </a>
                                @endcan
                                @can('read_compras')
                                    <a title="Generar orden de compra" href="{{route('ordenes.show', $q->requisition->id)}}"
                                    class="action-icon">
                                        <i  class="mdi mdi-clipboard-text-multiple"></i></a>
                                    </a>
                                @endcan
                                @can('delete_quotes')
                                    <a title="Eliminar cotización"
                                    class="action-icon" data-toggle="modal" data-target="#delete">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                @endcan
                            </td>

                            <!-- INICIO DEL MODAL-->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Eliminar Cotizacion</strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Desea eliminar la cotizacion?</h5>
                                            <p><strong>{{$q->requisition->folio}} </strong></p>
                                            <p>Eliminaras las cotizaciones de los proveedores</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                            <!-- Inicio btn para eliminar-->
                                            <form style="display:inline"
                                                method="POST"
                                                {{--  action="{{ route('users.destroy', $user->id) }}">  --}}
                                                action="{{ route('cotizaciones.destroy', $q->requisition->id)  }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-xs" type="submit">Eliminar</button>
                                            </form>
                                            <!-- Final btn para eliminar-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FINAL DEL MODAL-->
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row -->
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#quotes-table').DataTable({
            });
        } );
    </script>
@endpush
@endsection
