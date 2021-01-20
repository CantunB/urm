<?php

namespace Smapac\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smapac\PurchaseInvoice;
use Smapac\PurchaseOrder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if( Auth::user()->hasRole(['titular']) )
        {
            return redirect()->route('requisiciones.create');
        }elseif ( Auth::user()->hasRole(['admin','super-admin']) )
        {
            $day = Carbon::tomorrow();
            $count_ordenes = [];
            $ordenes = PurchaseOrder::where('status','<=','1')
            //->where('created_at',$day)
            ->groupBy(['pur_order_details_id'])->get();

            $count_ordenes = PurchaseInvoice::where('status','0')->groupBy(['purchase_id'])->get();
            $count_ordenes = count($count_ordenes);

            $total = PurchaseInvoice::where('status','0')->groupBy(['purchase_id'])->get();
            foreach($total as $suma)
            {
                $total = $suma->total_purchase;
            }

        return view('home',compact('ordenes','count_ordenes','total'));
        }
    }
}
