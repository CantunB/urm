@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name','SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">REQUISICIONES</a></li>
                    <li class="breadcrumb-item active">CREAR</li>
                </ol>
            </div>
            <h4 class="page-title">NUEVA REQUISICIÓN</h4>
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
                        </div>
                    </div><!-- end col-->
                </div>
                <form method="POST" action="{{ route('requisiciones.store') }}">
                    @method('POST')
                    @include('requisitions.partials.form',
                    ['btnText'=>'Guardar',
                    'user']
                    )

                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

@endsection
