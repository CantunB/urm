@extends('layouts.app')
@section('title','Requisicones')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name','SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">REQUISICIONES</a></li>
                    <li class="breadcrumb-item active">LISTA</li>
                </ol>
            </div>
            <h4 class="page-title"></h4>
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
                            @can('create_requisicion')
                            <a href="{{ route('requisiciones.create') }}"
                                class="btn btn-sm btn-info waves-effect waves-light mb-2 float-right"><i class="fas fa-plus-square" ></i> Nueva requisición</a>
                            @endcan
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table id="requi-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;">Departamentos</th>
                                <th scope="col" style="text-align: center; width: 15px"> Numero de requisiciones </th>
                                <th scope="col" style="text-align: center; width: 10px">Opciones</th>
                            </tr>
                            </thead>
                            @foreach($requisitions as $key => $r)
                                <tbody>
                                <td style="text-align: center"><strong>{{ $r->department->name}}</strong></td>
                                <td style="text-align: center; color: #2eb85c">
                                    <button type="button" class="btn btn-pill btn-sm btn-info    "><strong>{{ '' ?: $counts[$key]  }}</strong></button></td>
{{--                                <td>--}}
{{--                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#view">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                                <td style="text-align: center; width: 10px">
                                    <a href="{{route('requisiciones.list',$r->department->id)}}"
                                       class="action-icon  btn btn-soft-info ">
                                        <i class="mdi mdi-currency-eth"></i></a>
                                    </a>
                                </td>
                                </tbody>
                            @endforeach
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
            $('#requi-table').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
            });
        } );
    </script>
@endpush
@endsection
