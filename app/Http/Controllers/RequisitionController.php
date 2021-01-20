<?php

namespace Smapac\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Smapac\AssignedRequisition;
use Smapac\AssignedRequesteds;
use Smapac\Requisition;
use Smapac\User;
use Smapac\AssignedUserAreas;
use Smapac\AssignedAreas;
use Smapac\Requested;
use Illuminate\Http\Request;
use Smapac\Http\Requests\RequisitionRequest;
use Smapac\Http\Requests\RequisitionUploadRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
class RequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_or_permission:create_requisicion')->only(['create','store']);
        $this->middleware('role_or_permission:read_requisicion')->only(['index','show']);
        $this->middleware('role_or_permission:update_requisicion')->only(['edit','update']);
        $this->middleware('role_or_permission:delete_requisicion')->only(['destroy']);

        ini_set('max_execution_time', 300);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (auth()->user()->hasPermissionTo('update_requisicion'))
        {
            $requisitions = AssignedRequisition::select('department_id')->distinct(['department_id'])->paginate(10);
            foreach ($requisitions as $key => $requisition) {
                $array= array(
                $counts[]= AssignedRequisition::where('department_id',$requisitions[$key]->department_id)
                    ->count('requisition_id')
            );
            }
            if (empty($counts)){
                $counts = 0;
            }else
            {
                $counts;
            }
            return view('requisitions.index', compact('requisitions','counts'));
        }
        else
        {
            $requisitions = AssignedRequisition::where('user_id', '=', auth()->user()->id)->paginate(10);
            return view('requisitions.list', compact('requisitions'));
        }
    }


    public function list($requisition)
    {
        if(auth()->check())
        {
        if (auth()->user()->hasRole('super-admin') or auth()->user()->hasRole('admin')) {
                $requisitions = AssignedRequisition::where('department_id','=', $requisition)->paginate(10);
        }else
            {
                $requisitions = AssignedRequisition::where('user_id', '=', auth()->user()->id)->paginate(10);
            }
        }
        return view('requisitions.list',compact('requisitions'));
    }


    public function autorizadas(Request $request)
    {

        if (auth()->user()->hasPermissionTo('update_requisicion'))
        {
          $requisitions = AssignedRequisition::select('department_id')->distinct(['department_id'])->paginate(10);
            foreach ($requisitions as $i => $requisition) {
            $department = AssignedRequisition::where('department_id',$requisition->department_id)->distinct(['department_id'])->get();

            foreach ($department as $j => $id) {

                $counts[$i]= Requisition::where('status','1')->where('id',$id->requisition_id)->count();

                if (empty($counts)){
                    $counts = 0;
                }else
                {
                    $counts;
                }
            }
        }
            return view('requisitions.autorizadas', compact('requisitions','counts'));
        }
    }

    public function autorizadaslist($requisition)
    {

        if (auth()->user()->hasRole('super-admin') or auth()->user()->hasRole('admin')) {
            $req = AssignedRequisition::where('department_id',$requisition)->pluck('requisition_id');
                $requisitions = [];
                foreach ($req as $key => $value) {
                    $requisitions[] = Requisition::where('id',$value)->where('status','1')->get();
                }
        return view('requisitions.autorizadaslist',compact('requisitions'));
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->check())
        {
                $user = auth()->user();
            $req = AssignedRequisition::all()->where('department_id',auth()->user()->depto);
            $requi = $req->last();
            if($requi === null) {
                $requi = new Requisition();
                $countreq = $requi->accountant = 1;
            }else {
                $countreq = $requi->accountant + 1;
            }


        }
        return view('requisitions.create',compact('user','countreq'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequisitionRequest $request)
    {
       // return $request->all();
        $requisition = Requisition::create($request->all());

        $requesteds = new Requested();
        foreach ($request->departure as $item=>$v) {
            $data2=array(
                'departure' => $request->departure[$item],
                'quantity' => $request->quantity[$item],
                'unit' => $request->unit[$item],
                'concept' => $request->concept[$item],
                'created_at' => now(),
            );
            $requesteds = Requested::insert($data2);
        }

        $registros = Requested::latest()->orderBy('id', 'desc')
            ->take($request->input('cont'))
            ->get();

        foreach($registros as $r)
        {
            $idrequesteds = $r->id;
            $requisition->requesteds()->attach
            ($requisition->id,
                ['requested_id'=>$idrequesteds,
                    'created_at' => now()
                ]);
        }

        $requisition = $requisition->user()
            ->attach(
              //  auth()->user()->id ,
                 $request->input('user_id'),
                [
                    'accountant' => $request->input('accountant'),
                    'department_id' => auth()->user()->asignado->areas->departments->id ,
                    'created_at' => now()
                ]
            );

        return redirect()->route('requisiciones.index')->with('success','Requisición almacenada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Smapac\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $requisition = AssignedRequisition::where('id','=',$id)->get();
        $requesteds = AssignedRequesteds::orderBy('requested_id','ASC')
            ->with('requested')
            ->where('requisition_id','=',$requisition[0]->requisition_id)
            ->get();
        return view('requisitions.show',compact('requisition','requesteds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smapac\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit( $requisition)
    {
            $requisition = AssignedRequisition::findOrFail($requisition);
        if (is_null($requisition->requisition->file_req)) {
            return view('requisitions.edit',compact('requisition'));
        }else{
            return redirect(route('requisiciones.index'));
        }
    }

    public function upload ($requisition)
    {
        $requisition = Requisition::findOrFail($requisition);
        //return $requisitions->file_req;
        //  return $requisitions;
        if (is_null($requisition->file_req)) {
            //return 'No Existe imagen' ;
            $requisition = Requisition::findOrFail($requisition);
            return view('requisitions.upload', compact('requisition'));
        }else{
            // return 'Existe imagen';
            $requisition = Requisition::findOrFail($requisition);
            return view('requisitions.authorized', compact('requisition'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Smapac\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $requisition)
    {

       // return $request->all();
        $requisition = Requisition::findOrFail($requisition); //Actualizar estado de la requisicion
        $requisition->update($request->all());
        $requisition->status = $request->status;  // Busqueda del status
        $requisition->save();  // Guardar

     //   $req = Requisition::findOrFail($requisition); //Se localiza la requisicion con el id
       // $req->update($request->all()); //Se actualizan los datos
        $requesteds = AssignedRequesteds::where('requisition_id','=', $requisition)->get(); //Se hace la busqueda en la tabla a partir del id de la requisicion
        foreach ($requesteds as $item => $v){   // Inicia el foreach para recorre los resultados
            foreach ($request->unit as $key => $val) { //Inicia el foreach para recorrer el request con los nuevos datos
                $array = array( //se crea un array para guardar las posiciones del primer foreach
                    $data2 = array(  //se crea un array para guardar las posiciones del segundo foreach
                        'departure' => $request->departure[$key],  //se pasan las variables del request
                        'quantity' => $request->quantity[$key],
                        'unit' => $request->unit[$key],
                        'concept' => $request->concept[$key],
                    ),   //Termina el primer array
            ); // Termina el segundo array
                Requested::where('id','=',$requesteds[$item]->requested->id)->update($data2); //Se guardan los datos
                                                                                                //con base a la posicion del primer array
                                                                                                //y los datos del segundo array
            } //Termina el recorrido del segundo foreach
        }  // Termina el recorrido del primer foreach

        return redirect()->route('requisiciones.index' )->with('update', 'Requisición Actualizada');
    }

   /* Funcion para almacenar la requisicion autorizada
         por medio de la imagen
   */

    public function file_upload(RequisitionUploadRequest $request,  $requisition)
    {
        $requisition = Requisition::findOrFail($requisition);
        if ($request->hasFile('file_req')){
            $file = $request->file("file_req");
           //$nombrearchivo  = str_slug($request->slug).".".$file->getClientOriginalExtension();
            $nombrearchivo  =  $requisition->folio .'.'.$file->getClientOriginalExtension();
            $nombrearchivo = str_replace ( '/' , '_' , $nombrearchivo );
            $file->move(public_path("requisitions/autorizadas/"),$nombrearchivo);
            $requisition->file_req      = $nombrearchivo;
            $requisition->status        = 1;
            $requisition->save();
        }
        return redirect()->route('requisiciones.autorizadas')->with('success', 'Requisición autorizada');
    }

    /*
    *Expor PDF
    * @param  \Smapac\Requisition  $requisition
    * Barryvdh\DomPDF\Facade as PDF
    */
    public  function requisitionspdf( $id)
    {
        //return $id;
        /** Consulta para obtener el director**/
        //$director = Role::all()->where('slug','=','director')->first();
        //$director = DB::table('role_user')->where('role_id','=',$director->id)->get();
        //$director = AssignedUserAreas::where('user_id','=',$director[0]->user_id)->get();
        $director = 'Ing. Nicolas Hernandez Ynurreta Mancera';
        $coordinador = 'L.A.E Bianca Eugenia Saenz Ortega';
        $requisition = AssignedRequisition::where('id',$id)->get();

        $requesteds = AssignedRequesteds::orderBy('requested_id','ASC')->with('requested')->where('requisition_id','=',$requisition[0]->requisition_id)->get();
     //   $requisitions = AssignedRequisition::;
        $pdf = PDF::loadView('requisitions.requisition-pdf', compact('requisition','requesteds','director','coordinador'));
        return $pdf->download('REQ.'.$requisition[0]->requisition->folio.'.pdf');
    }

    public  function requisitionauthorized($id)
    {
        $requisitions = AssignedRequisition::findOrFail($id);

        if (is_null($requisitions->requisition->file_req)) {
            $requisitions = AssignedRequisition::findOrFail($id);
            // AssignedUserAreas::all();
            return view('requisitions.edit', compact('requisitions'));
        }else{
            $requisitions = AssignedRequisition::findOrFail($id);
            return view('requisitions.authorized', compact('requisitions'));
            //      return view('requisitions.load', compact('requisitions'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Smapac\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy($requisition)
    {
        $requisition = Requisition::findOrFail($requisition);
        $requisition->delete();
        return back()->with('destroy','Se han eliminado todos los registros de la requisición');
    }
}
