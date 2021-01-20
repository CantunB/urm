@csrf
<input type="hidden" name="caption" value="{{"2018, Año del Sesenta y Cinco Aniversario del Reconocimiento al Ejercicio del Derecho a Voto de las Mujeres Mexicanas"}}">
<div class="row">
    <div class="form-group row col-md-12">
        <label for="folio" class="col-md-2 offset-md-7 col-form-label"><strong>REQ. NO.</strong></label>
        <div class="col-md-3">
          <input type="text" name="folio" class="form-control text-right" id="folio"
          value="{{$user->asignado->areas->slug.$countreq.'/'.date('Y')}}">
        </div>
    </div>
    @error('folio')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <input type="hidden" name="accountant" value="{{$countreq}}">
    <input type="hidden" name="user_id" value="{{$user->id}}">

    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 offset-md-7 col-form-label">Fecha de solicitud</label>
        <div class="col-md-3">
            <input type="date" name="added_on"
                   class="form-control  @error('added_on') is-invalid @enderror"
                     id="inputEmail3" placeholder="" value="{{old ('added_on')}}">
                     @error('added_on')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                     @enderror
        </div>
    </div>
    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Direccion</label>
        <div class="col-md-4">
            <input type="text" name="management"
                   class="form-control" id="inputEmail3" placeholder="SMAPAC" value="SMAPAC">
        </div>
    </div>
    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Coordinación</label>
        <div class="col-md-4">
                <input type="text"
                       class="form-control" placeholder="" value="{{ $user->asignado->areas->coordinations->name }}">
        </div>
    </div>
    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Departamento</label>
        <div class="col-md-4">
                <input type="text"
                class="form-control"
                value="{{ $user->asignado->areas->departments->name }}">

        </div>
    </div>
    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Unidad Administrativa</label>
        <div class="col-md-6">
            <input type="text" name="administrative_unit" class="form-control @error('administrative_unit') is-invalid @enderror" id="administrative_unit" placeholder="" value="">
              @error('administrative_unit')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
        </div>
    </div>
    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Fecha Para Requerir Material</label>
        <div class="col-md-3">
            <input type="date" name="required_on" class="form-control @error('required_on') is-invalid @enderror" id="required_on" placeholder="" value="">
            @error('required_on')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row col-md-12">
        <label for="inputEmail3" class="col-md-2 col-form-label">Asunto</label>
        <div class="col-md-6">
            <input type="text" name="issue" class="form-control" id="inputEmail3" placeholder="" value="">
        </div>
    </div>
    <div class="form-group row col-12">
        <label class="col-md-2 col-form-label">Programa</label>
        <div class="form-group col-md-12">
            <table class="table table-responsive ">
                <thead>
                <tr>
                    <th>Partida</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Concepto</th>
                    <th><button type="button" class="add_button btn btn-sm btn-success"><i class="fas fa-plus-circle"></i></button></th>
                </tr>
                </thead>
                    <tbody class="field_wrapper">
                <input class="form-control col-md-12" type="text" name="cont" id="cont" hidden>
                <tr>
                    <td ><input type="number" min="0" name="departure[]" id="departure[]" required
                      class="form-control @error('departure[]') is-invalid @enderror">
                      @error('departure[]')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror</td>
                    <td ><input type="number" min="0" name="quantity[]" id="quantity[]" required
                      class="form-control @error('quantity[]') is-invalid @enderror">
                        @error('quantity[]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror</td>
                    <td ><input type="text" name="unit[]" id="unit[]" required
                      class="form-control  @error('unit[]') is-invalid @enderror">
                      @error('unit[]')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror</td>
                    <td style="width:30rem"><textarea type="text" required name="concept[]" id="concept[]" class="form-control @error('concept[]') is-invalid @enderror"></textarea>
                      @error('concept[]')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror</td>

                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<div class="form-group row col-md-12">
    <label for="inputEmail3" class="col-md-2 col-form-label">Observaciónes</label>
    <div class="col-md-10">
        <input type="text" name="remark" class="form-control" id="inputEmail3" placeholder="" value="{{ old('remark')}}">
    </div>
</div>


    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            {{ $btnText }}<span class="btn-label-right"><i class="mdi mdi-check-all"></i></span>
        </button>
        <a  href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">
            Cancelar<span class="btn-label-right"><i class="mdi mdi-close-outline"></i></span>
        </a>
    </div>

</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" ></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 20; //Limitación de incremento de campos de entrada
        var addButton = $('.add_button'); //Agregar selector de botones
        var wrapper = $('.field_wrapper'); //Contenedor de campo de entrada
        var fieldHTML = '<tr>'+
            '<td><input type="number" min="0" name="departure[]" class="form-control" ></td>'+
            '<td><input type="number" min="0" name="quantity[]" class="form-control"></td>'+
            '<td><input type="text" name="unit[]" class="form-control"></td>'+
            '<td><textarea type="text" name="concept[]" class="form-control"></textarea></td>'+
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
