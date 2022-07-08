<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Product;
use App\Models\Refund;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\WithdrawRequest;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class DashboardRefundController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = Refund::with(['user', 'transactionDetails'])
                            ->where('users_id', Auth::user()->id)
                            ->get();

            return DataTablesDataTables::of($query)
                ->addColumn('status', function($item){
                    if($item->status == 'SUCCESS' ){
                        $bt ='<span class="badge badge-success">SUCCESS</span>';
                    } else if ($item->status == 'PENDING'){
                        $bt ='<span class="badge badge-warning">PENDING</span>';
                    } else if ($item->status == 'CANCELLED'){
                        $bt ='<span class="badge badge-danger">CANCELLED</span>';
                    } else {
                        $bt ='<span class="badge badge-primary">PROCESS</span>';
                    }
                    return $bt; 
                })
                ->addColumn('action', function($item){
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown=toggle mr-1 mb-1"
                                        type="button"
                                        data-toggle="dropdown">
                                        Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('dashboard-refund-edit', $item->id) .'">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('pages.dashboard-refund');
    }
    public function create()
    {
        $buyTransactions = TransactionDetail::with(['transaction.user']) //memanggil data DB dan relasi di model
                            ->whereHas('transaction', function($transaction){ //mencari produk yang berhasil terjual
                                $transaction->where('users_id', Auth::user()->id); //mencari transaksi pada user yang sedang login
                            })->get();
        
        return view('pages.dashboard-refund-create', [
            'buyTransactions' => $buyTransactions,
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        Refund::create($data);

        return redirect()->route('dashboard-refund');
    }
     public function edit($id)
    {
        $item = Refund::findOrFail($id);

        return view('pages.dashboard-refund-edit',[
            'item' => $item,

        ]);
    }
}
