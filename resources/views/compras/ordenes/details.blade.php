@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name', 'SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ORDENES</a></li>
                    <li class="breadcrumb-item active">DETALLES DE ORDEN</li>
                </ol>
            </div>
            <h4 class="page-title"></h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-8 col-lg-7">
        <!-- project card -->
        <div class="card d-block">
            <div class="card-body">

                <div class="float-right">
                    <div class="form-row">
                        <div class="col-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-link"><i class="mdi mdi-keyboard-backspace"></i> Regresar</a>
                        </div>
                      <!--  <div class="col-auto">
                            <select class="custom-select custom-select-sm form">
                                <option selected="">Watch</option>
                                <option value="1">Remind me</option>
                                <option value="2">Close</option>
                            </select>
                        </div> -->
                    </div>
                </div> <!-- end dropdown-->

                <h4 class="mb-3 mt-0 font-18">{{ $orden->detail->order_folio }}</h4>

                <div class="clerfix"></div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">Fecha de elaboración :</label>
                        <p>
                          <!--  <i class='mdi mdi-ticket font-18 text-success mr-1 align-middle'>   -->
                                </i>
                                {{Carbon\Carbon::parse($orden->created_at)->format('d-M-Y')}} <small class="text-muted">{{Carbon\Carbon::parse($orden->created_at)->format('h:i A')}}</small>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="mt-2 mb-1">Análisis de precio :</label>
                        <p>
                            <!-- <i class='mdi mdi-ticket font-18 text-success mr-1 align-middle'> -->
                                </i> {{ $orden->detail->analysis_folio }}
                        </p>
                    </div>
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-md-6">
                        <!-- Reported by -->
                        <label class="mt-2 mb-1">Proveedor :</label>
                        <div class="media">
                            <img src="{{ asset('assets/images/companies/'. $orden->detail->provider->provider_file) }}" alt="Arya S"
                                class="rounded-circle mr-2" height="24" />
                            <div class="media-body">
                                <p> {{ $orden->detail->provider->name }} </p>
                            </div>
                        </div>
                        <!-- end Reported by -->
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <!-- assignee -->
                        <label class="mt-2 mb-1">RFC :</label>
                            <div class="media-body">
                                <p>{{ $orden->detail->provider->rfc}} </p>
                            </div>
                        <!-- end assignee -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-2 mb-1">Unidad Administrativa:</label>
                        <p>{{ $orden->detail->unit_administrative }}</p>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <!-- assignee -->
                        <label class="mt-2 mb-1">Departamento :</label>
                        <p>{{ $orden->department->name }}</p>
                        <!-- end assignee -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-md-6">
                        <!-- Status -->
                        <label class="mt-2 mb-1">No. Requisición :</label>
                        <p>{{ $orden->detail->requisition->folio ?? ''}}</p>
                        <!-- end Status -->
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-md-12">
                        <label class="mt-4 mb-1">Programa :</label>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; width:5%"> <i>Part.</i></th>
                                        <th style="text-align: center; width:5%"><i>Cant.</i></th>
                                        <th style="text-align: center; width:10%"><i>Unidad</i></th>
                                        <th style="text-align: center; width:35%"><i>Concepto</i></th>
                                        <th style="text-align: center; width: 20%"><i>Costo.U.</i></th>
                                        <th style="text-align: center; width: 20%"><i>Importe</i></th>
                                    </tr>
                                </thead>
                                @foreach ($materials as $material)
                                    <tbody>
                                        <tr>
                                            <td>{{ $material->material->departure }}</td>
                                            <td>{{ $material->material->quantity }}</td>
                                            <td>{{ $material->material->unit }}</td>
                                            <td>{{ $material->material->concept}}</td>
                                            <td>{{ $material->material->unit_cost }}</td>
                                            <td>{{ $material->material->cost_quantity }} </td>
                                        </tr>
                                  </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>

                </div>
                <p class="text-muted mb-0">

                </p>

            </div> <!-- end card-body-->

        </div> <!-- end card-->
        <div class="card">
            <div class="card-body">
                <h5>Observación</h5>
                <div class="border rounded mt-4">
                    <form action="{{route('ordenes.update', $orden->id)}}" method="POST" class="comment-area-box">
                        @csrf
                        @method('PUT')
                        <textarea rows="3" class="form-control border-0 resize-none" name="observation" placeholder="Ingresa una observación">{{ $orden->observation}}</textarea>
                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message mr-1'></i>Enviar</button>
                        </div>
                    </form>
                </div> <!-- end .border-->

            </div> <!-- end card-body-->
        </div>
        <!-- end card-->
    </div> <!-- end col -->

    <div class="col-xl-4 col-lg-5">

        <div class="card">
            <div class="card-body">

                <h5 class="card-title font-16 mb-3">Archivos</h5>

                <h6>Archivo de cotizacion</h6>
                <div class="card mb-1 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            @foreach($cotizacion as $i => $cot)
                                <div class="col-auto">
                                    <div class="avatar-sm">
                                        <span class="avatar-title badge-blue rounded">
                                            {{ $quote_ext[$i]}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <a href="javascript:void(0);" class="text-muted font-weight-bold">{{ $cot->quote_file }}</a>
                                   <!-- <p class="mb-0 font-12">2.3 MB</p> -->
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="{{asset('requisitions/cotizadas/'.$cot->quote_file) }}" target="_blank" class="btn btn-link font-16 text-muted">
                                        <i class="dripicons-download"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <h6>Archivo de requisición</h6>
                <div class="card mb-1 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            @foreach($cotizacion as $i => $cot)
                                <div class="col-auto">
                                    <div class="avatar-sm">
                                        <span class="avatar-title badge-blue rounded">
                                           {{$req_ext[$i]}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <a href="javascript:void(0)" class="text-muted font-weight-bold">{{ $cot->requisition->file_req }}</a>
                                    <!-- <p class="mb-0 font-12">0.25 MB</p> -->
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="{{asset('requisitions/autorizadas/'.$cot->requisition->file_req) }}" target="_blank" class="btn btn-link font-16 text-muted">
                                        <i class="dripicons-download"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            <!--    <div class="card mb-0 shadow-none border">
                    <div class="p-2">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-secondary rounded">
                                        pdf
                                    </span>
                                </div>
                            </div>
                            <div class="col pl-0">
                                <a href="javascript:void(0);" class="text-muted font-weight-bold">visa-credit-card.pdf</a>
                                <p class="mb-0 font-12">1.05 MB</p>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="btn btn-link font-16 text-muted">
                                    <i class="dripicons-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            -->
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
