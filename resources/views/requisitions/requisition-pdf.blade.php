<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 4cm;
            background-color: #ffffff;
            color: white;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 4cm;
            background-color: #ffffff;
            color: black;
            text-align: center;
            font-size: x-small;
        }
        h4 {
            color: #4f4866;
            font-weight: normal;
            font-size: 1px;
            font-family: Arial;
            text-transform: uppercase;
        }
table, th {
  border: 1px solid black;
}
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>REQ. NO. {{ $requisition[0]->requisition->folio }}</title>
</head>
<body>
<header><br>
    <div class="container" >
        <div class="row">
            <div class="col-md-2" style="text-align: start ">
                <img src="{{ public_path('img/smapac-logo.png') }}" width="100" height="70" alt="A 200x200 image" class="img">
            </div>
            <div class="col-8 offset-2" style="text-align: center; color: #000000;">
         <p style="font-size: 12px; text-align: center">
           <strong>SISTEMA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE CARMEN
           </strong>
           </p>
          <p style="line-height:10px; font-size:12px; text-align:center;  margin-top:15px">
            <strong>COORDINACIÓN ADMINISTRACIÓN Y FINANZAS</strong>
          </p>
          <p style="font-size:12px; text-transform:uppercase; text-align:center; line-height:15px">
          <strong>{{$requisition[0]->user->asignado->areas->departments->name}}</strong>
          </p>
            </div>
            <div class="col-md-2 offset-10" style="text-align:right ">
                <img src="{{ public_path('img/carmen_logo.png') }}" width="80" height="70" alt="A 200x200 image" class="img">
            </div>
            <div class="row">
                <div class="col-12" style=" font-size:x-small; color: #000000; margin-top: 70px">
                    <br>
                  <p style="font-size:x-small;line-height:10px">  <strong>"2020, Año de Leona Vicario, Benemérita madre de la Patria"</strong></p>
                </div>
            </div>
        </div>

    </div>
</header>

<main>
    <div class="container col-md-10 table-responsive" style="margin-top: 170px">
        <div class="row-cols-xl-6">
        @foreach($requisition as $r)
                <div class="row" style="float: end">
                    <div class="col-md-4 col-md-offset-8" style="text-align:right; float: right">
                    <p style="font-size:x-small"><strong>REQ. NO. {{ $r->requisition->folio }}</strong><br>
                      <strong> {{ Carbon\Carbon::parse($r->requisition->added_on)->format('d/m/Y')}}</strong>
                    </p>
                    </div>
                </div>
            <br>

            <div class="row justify-content-start">
                <div class="col-8">
                      <p style="font-size:10px; line-height:20px">
                        <strong>DIRECCIÓN:  </strong>{{ $r->requisition->management }}<br>
                        <strong>COORDINACIÓN:  </strong>{{$r->user->asignado->areas->coordinations->name}}<br>
                        <strong>DEPARTAMENTO:  </strong>{{$r->user->asignado->areas->departments->name}}<br>
                        <strong>UNIDAD ADMINISTRATIVA:  </strong>{{ $r->requisition->administrative_unit }} <br>
                        <strong>FECHA PARA REQUERIR MATERIAL: {{ Carbon\Carbon::parse($r->requisition->required_on)->format('d/m/Y')}}</strong><br>
                        <strong>ASUNTO:  </strong>{{ $r->requisition->issue }}<br>
                        <strong>PROGRAMA:</strong>
                      </p>

                </div>
            </div>
                    <div class="row col-md-12 table-responsive table-sm">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th style="font-size: 10px;text-align: center "WIDTH="10"> <i>PARTIDA</i></th>
                                <th style="font-size: 10px;text-align: center "WIDTH="1"><i>CANTIDAD</i></th>
                                <th style="font-size: 10px;text-align: center "WIDTH="10"><i>UNIDAD</i></th>
                                <th style="font-size: 10px;text-align: center"><i>CONCEPTO</i></th>
                            </tr>
                            </thead>
                            @foreach ($requesteds as $req)
                                <tbody>
                                <tr>
                                    <td style="font-size: 10px;text-align: center ">{{$req->requested->departure }}</td>
                                    <td style="font-size: 10px;text-align: center ">{{ $req->requested->quantity}}</td>
                                    <td style="font-size: 10px;text-align: center ">{{$req->requested->unit }}</td>
                                    <td style="font-size: 10px">{{$req->requested->concept }}</td>
                                </tr>
                                </tbody>
                            @endforeach
                            <br>
                            <br>
                            <thead>
                              <tr>
                            <th  style="font-size: 10px"colspan="4">
                                <label> <strong>  OBSERVACIONES: </strong>
                                    {{ $r->requisition->remark }}
                                </label>

                            </th>
                          </tr>
                            </thead>
                        </table>
                        @endforeach
                    </div>
            </div>
    </div>
    </div>
</main>
<footer>
    <div class="row">
            <div class="row">
                <div style="text-align: center; font-size: smaller ;" class="col-md-4 order-md-1">
                <strong>    SOLICITÓ
                    <br>
                    <br>
                        ____________________<br>
                    {{$requisition[0]->user->name}}<br>
                       &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Jefe del Departamento {{$requisition[0]->user->asignado->areas->departments->name}}<br>
                </strong>
                </div>
                <div style="text-align:center; font-size: smaller" class="col-md-4 offset-4">
                    <strong>Vo.Bo. :
                    <br>
                    <br>
                        ____________________<br>
                        {{$coordinador}}<br>
                        &nbsp; &nbsp; Titular de la Coordinacion de Administración y Finanzas<br></strong>
                </div>
                <div style="text-align:center; font-size: smaller" class="col-md-4 offset-8">
                    <strong>AUTORIZÓ:
                    <br>
                    <br>
                        ____________________<br>
                        {{$director}}<br>
                        Director General
                </div>
            </div>
    </div>
</footer>
</body>
</html>
