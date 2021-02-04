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
                <form id="form" method="POST" action="{{ route('requisiciones.store') }}">
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 20; //Limitación de incremento de campos de entrada
            var addButton = $('.add_button'); //Agregar selector de botones
            var wrapper = $('.field_wrapper'); //Contenedor de campo de entrada
            var fieldHTML = '<tr>'+
                '<td><input type="number" min="0" name="departure[]" class="form-control" required></td>'+
                '<td><input type="number" min="0" name="quantity[]" class="form-control" required></td>'+
                '<td><input type="text" name="unit[]" class="form-control" required></td>'+
                '<td><textarea type="text" name="concept[]" class="form-control" required></textarea></td>'+
                '<td><button type="button" class="remove_button btn btn-danger btn-sm"><i class="fas fa-minus-circle"></td></tr>';

            var x = 1; //El contador de campo inicial es 1
            document.getElementById("cont").value = x;
            //Una vez que se hace clic en el botón Agregar

            $(addButton).click(function(){
                //Verifique el número máximo de campos de entrada
                if(x < maxField){
                    x++; //Contador de campo de incremento
                    $(wrapper).append(fieldHTML); //Agregar campo html
                    document.getElementById("cont").value = x;
                }
            });

            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
                x--;
                document.getElementById("cont").value = x;
            });

        });

    </script>
    <script>
        $('#form').parsley();
    </script>
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
