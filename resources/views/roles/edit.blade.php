@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name','SMAPAC') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ROLES</a></li>
                    <li class="breadcrumb-item active">EDITAR</li>
                </ol>
            </div>
            <h4 class="page-title">Editar rol {{ $roles->name }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <p class="sub-header">
            <input type="radio" id="selectall" name="special"> Acceso Total <span><strong>(Esto seleccionara todos los permisos existentes)</strong></span>
                <div class="form-group">
                </p>
    </div>
              <div class="container">
                    <form action="{{ action('RoleController@update', $roles->id) }}" method="POST" class="form-group">
                        @csrf
                        @method('PUT')
                        <table data-toggle="table"
                                data-page-size="10"
                                data-buttons-class="xs btn-light"
                                data-pagination="true" class="table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" class="case" id="selectallusers"> Usuarios</th>
                                    <th><input type="checkbox" class="case" id="selectallroles"> Roles</th>
                                    <th><input type="checkbox" class="case" id="selectallpermisos"> Permisos</th>
                                    <th><input type="checkbox" class="case" id="selectallelectores"> Departamentos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    @foreach ($permisos as $item => $val )
                                        @if($item < "4")
                                                <li>
                                                <label>
                                                    <input type="checkbox"
                                                        class="chkusers case"
                                                        name="permission[]"
                                                        value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                    ><strong> {{ $val->name   }}</strong>
                                                </label>
                                                </li>
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>
                                        @foreach ($permisos as $item => $val )
                                            @if($item < "8")
                                            @continue($item < "4")
                                                    <li>
                                                    <label>

                                                        <input type="checkbox"
                                                            class="chkroles case"
                                                            name="permission[]"
                                                            value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                        ><strong> {{ $val->name   }}</strong>
                                                    </label>
                                                    </li>

                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($permisos as $item => $val )
                                            @if($item < "12")
                                            @continue($item < "8")
                                                    <li>
                                                    <label>

                                                        <input type="checkbox"
                                                            class="chkpermisos case"
                                                            name="permission[]"
                                                            value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                        ><strong> {{ $val->name   }}</strong>
                                                    </label>
                                                    </li>

                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($permisos as $item => $val )
                                            @if($item < "16")
                                            @continue($item < "12")
                                                    <li>
                                                    <label>

                                                        <input type="checkbox"
                                                            class="chkelectores case"
                                                            name="permission[]"
                                                            value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                        ><strong> {{ $val->name   }}</strong>
                                                    </label>
                                                    </li>

                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table data-toggle="table"
                                data-page-size="10"
                                data-buttons-class="xs btn-light"
                                data-pagination="true" class="table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" class="case" id="selectallanf"> Coordinaciones</th>
                                    <th><input type="checkbox" class="case" id="selectallsim"> Requisiciones</th>
                                    <th><input type="checkbox" class="case" id="selectallrs"> Cotizaciones</th>
                                    <th><input type="checkbox" class="case" id="selectallrm"> Proveedores</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                @foreach ($permisos as $item => $val )
                                @if($item < "20")
                                @continue($item < "16")
                                            <li>
                                            <label>
                                                <input type="checkbox"
                                                    class="chkanf case"
                                                    name="permission[]"
                                                    value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                ><strong> {{ $val->name   }}</strong>
                                            </label>
                                            </li>
                                @endif
                                @endforeach
                                </td>
                                <td>
                                    @foreach ($permisos as $item => $val )
                                    @if($item < "24")
                                    @continue($item < "20")
                                                <li>
                                                <label>
                                                    <input type="checkbox"
                                                        class="chksim case"
                                                        name="permission[]"
                                                        value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                    ><strong> {{ $val->name   }}</strong>
                                                </label>
                                                </li>
                                    @endif
                                    @endforeach
                                    </td>
                                    <td>
                                        @foreach ($permisos as $item => $val )
                                        @if($item < "28")
                                        @continue($item < "24")
                                                    <li>
                                                    <label>
                                                        <input type="checkbox"
                                                            class="chkrs case"
                                                            name="permission[]"
                                                            value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                        ><strong> {{ $val->name   }}</strong>
                                                    </label>
                                                    </li>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                    @foreach ($permisos as $item => $val )
                                    @if($item < "32")
                                    @continue($item < "28")
                                                <li>
                                                <label>
                                                    <input type="checkbox"
                                                        class="chkrm case"
                                                        name="permission[]"
                                                        value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                    ><strong> {{ $val->name   }}</strong>
                                                </label>
                                                </li>
                                    @endif
                                    @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table data-toggle="table"
                                data-page-size="10"
                                data-buttons-class="xs btn-light"
                                data-pagination="true" class="table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" class="case" id="selectallanf"> Compras</th>
                                    <th><input type="checkbox" class="case" id="selectallsim"> Almacen</th>
                                    <th><input type="checkbox" class="case" id="selectallanf"> &nbsp;</th>
                                    <th><input type="checkbox" class="case" id="selectallanf"> &nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                @foreach ($permisos as $item => $val )
                                @if($item < "36")
                                @continue($item < "32")
                                            <li>
                                            <label>
                                                <input type="checkbox"
                                                    class="chkseccion case"
                                                    name="permission[]"
                                                    value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                ><strong> {{ $val->name   }}</strong>
                                            </label>
                                            </li>
                                @endif
                                @endforeach
                                </td>
                                <td>
                                    @foreach ($permisos as $item => $val )
                                    @if($item < "40")
                                    @continue($item < "36")
                                                <li>
                                                <label>
                                                    <input type="checkbox"
                                                        class="chkmanzana case"
                                                        name="permission[]"
                                                        value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                    ><strong> {{ $val->name   }}</strong>
                                                </label>
                                                </li>
                                    @endif
                                    @endforeach
                                    </td>
                                    <td>
                                        @foreach ($permisos as $item => $val )
                                        @if($item < "44")
                                        @continue($item < "40")
                                                    <li>
                                                    <label>
                                                        <input type="checkbox"
                                                            class="case"
                                                            name="permission[]"
                                                            value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                        ><strong> {{ $val->name   }}</strong>
                                                    </label>
                                                    </li>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                    @foreach ($permisos as $item => $val )
                                    @if($item < "48")
                                    @continue($item < "44")
                                                <li>
                                                <label>
                                                    <input type="checkbox"
                                                        class=" case"
                                                        name="permission[]"
                                                        value="{{ $val->id }}" {{ $roles->permissions->pluck('id')->contains($val->id) ? 'checked' : '' }}
                                                    ><strong> {{ $val->name   }}</strong>
                                                </label>
                                                </li>
                                    @endif
                                    @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Actualizar<span class="btn-label-right"><i class="mdi mdi-check-all"></i></span>
                                </button>
                                <a  href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">
                                    Cancelar<span class="btn-label-right"><i class="mdi mdi-close-outline"></i></span>
                                </a>
                         </div>

                        </form>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
@push('scripts')
  <script>
/*---------------------CHECKBOX USUARIOS-------------------------------*/
$("#selectallusers").on("click", function() {
  $(".chkusers").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkuser").on("click", function() {
  if ($(".chkusers").length == $(".chkusers:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX ROLES-------------------------------*/

$("#selectallroles").on("click", function() {
  $(".chkroles").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkroles").on("click", function() {
  if ($(".chkroles").length == $(".chkroles:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX PERMISOS-------------------------------*/

$("#selectallpermisos").on("click", function() {
  $(".chkpermisos").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkpermisos").on("click", function() {
  if ($(".chkpermisos").length == $(".chkpermisos:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});



/*---------------------CHECKBOX ELECTORES-------------------------------*/

$("#selectallelectores").on("click", function() {
  $(".chkelectores").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkelectores").on("click", function() {
  if ($(".chkelectores").length == $(".chkelectores:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});


/*---------------------CHECKBOX ANFITRIONES-------------------------------*/

$("#selectallanf").on("click", function() {
  $(".chkanf").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkanf").on("click", function() {
  if ($(".chkanf").length == $(".chkanf:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX SIMPATIZANTES-------------------------------*/

$("#selectallsim").on("click", function() {
  $(".chksim").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chksim").on("click", function() {
  if ($(".chksim").length == $(".chksim:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX RESP. SECCION-------------------------------*/

$("#selectallrs").on("click", function() {
  $(".chkrs").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkrs").on("click", function() {
  if ($(".chkrs").length == $(".chkrs:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX RESP. MANZANA-------------------------------*/

$("#selectallrm").on("click", function() {
  $(".chkrm").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkrm").on("click", function() {
  if ($(".chkrm").length == $(".chkrm:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX SECCIONEs-------------------------------*/

$("#selectallrm").on("click", function() {
  $(".chkseccion").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkseccion").on("click", function() {
  if ($(".chkseccion").length == $(".chkseccion:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});

/*---------------------CHECKBOX MANZANA-------------------------------*/

$("#selectallrm").on("click", function() {
  $(".chkmanzana").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".chkmanzana").on("click", function() {
  if ($(".chkmanzana").length == $(".chkmanzana:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});


/*---------------------CHECKBOX TODOS LOS PERMISOS-------------------------------*/

$("#selectall").on("click", function() {
  $(".case").prop("checked", this.checked);
});
// if all checkbox are selected, check the selectall checkbox and viceversa
$(".case").on("click", function() {
  if ($(".case").length == $(".case:checked").length) {
    $("#selectall").prop("checked", true);
  } else {
    $("#selectall").prop("checked", false);
  }
});
</script>
@endpush
@endsection
