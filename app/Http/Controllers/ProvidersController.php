<?php

namespace Smapac\Http\Controllers;

use Illuminate\Http\Request;
use Smapac\Providers;
use Image;
use Smapac\PurchaseOrderDetail;
use Smapac\Quotesrequisitions;

class ProvidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_or_permission:create_proveedores')->only(['create','store']);
        $this->middleware('role_or_permission:read_proveedores')->only(['index','show']);
        $this->middleware('role_or_permission:update_proveedores')->only(['edit','update']);
        $this->middleware('role_or_permission:delete_proveedores')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Providers::where('status', '0')->paginate(10);
      //  $cotizaciones = Quotesrequisitions::where('provider_id',$providers)->orderBy('requisition_id', 'ASC')->get();
        $cotizaciones = Quotesrequisitions::select('department_id')->distinct(['department_id'])->get();
        foreach ($cotizaciones as $key => $cotizacion) {
            $array= array(
                $counts_cot[$key]= Quotesrequisitions::where('department_id',$cotizacion->department_id)
                    ->count()
            );
        }
    if (empty($counts_cot)){
            $counts_cot[] = 0;
        }else{
            $counts_cot;
        }
        $compras = PurchaseOrderDetail::select('provider_id')->distinct(['provider_id'])->get();
        foreach ($compras as $key => $compra) {

            $array= array(
                $counts_com[]= PurchaseOrderDetail::where('provider_id',$compra->provider_id)
                    ->count()
            );
        }
        if (empty($counts_com)){
            $counts_com[] = 0;
        }else{
             $counts_com;
        }
        return view('proveedores.index', compact('providers','counts_cot','counts_com'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$proveedore  = new Providers;
        $proveedor  = Providers::create($request->all());
  /*       if($request->hasFile('provider_file')){
            $provider_file = $request->file("provider_file");
            $provider_filename = $provider_file->getClientOriginalName();
            $provider_file->move(public_path("/assets/images/companies/"), $provider_filename);

            $proveedor->provider_file       = $provider_filename;
            $proveedor->save();
         }
*/
/*         if ($request->hasFile('provider_file')){
            $provider_file    = $request->file('provider_file');
            $provider_filenombre     = $provider_file->guessExtension();
            $ruta=public_path('/assets/images/companies/'.$provider_filenombre);
            Image::make($provider_file->getRealPath())
                ->resize(300,300, function ($constraint){
                    $constraint->aspectRatio();
                })
                ->save($ruta,72);

                $proveedor->provider_file       = $provider_filenombre;
                $proveedor->save();
        } */

        if ($request->hasFile('provider_file')) {
            $file = $request->file('provider_file');
            $filename = $proveedor->name .'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(150,150)->save(public_path('/assets/images/companies/'. $filename) );

           // $user->update($request->all());
            $proveedor->provider_file = $filename;
            $proveedor->save();
        }

        if ($proveedor == true){
            $success = true;
            $message = 'Proovedor Registrado';
        }else{
            $success = true;
            $message = 'Fallo el registro';
        }
        //  $coordinations->save();
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
        //return redirect()->route('proveedores.index')->with('success','Proveedor Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Smapac\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $providers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Smapac\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function edit($providers)
    {
        $provider = Providers::findorFail($providers);
        $cotizaciones = Quotesrequisitions::where('provider_id',$providers)->orderBy('requisition_id', 'ASC')->get();
        return view('proveedores.edit', compact('provider','cotizaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Smapac\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $providers)
    {
        $providers = Providers::findOrFail($providers);
        $providers->update($request->all());
            if ($request->hasFile('provider_file')) {
                $file = $request->file('provider_file');
                $filename = $providers->name .'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(150,150)->save(public_path('/assets/images/companies/'. $filename) );

            // $user->update($request->all());
                $providers->provider_file = $filename;
                $providers->save();
            }
        return redirect('proveedores')->with('update', 'Proveedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Smapac\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function destroy($providers)
    {
        $providers = Providers::findOrFail($providers);
        $providers->delete();
        return back()->with('destroy','Proveedor Eliminado');
    }
}
