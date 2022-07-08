<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Withdraw;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\WithdrawRequest;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class DashboardWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Withdraw::with(['user', 'transactionDetails'])
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
                                    <a class="dropdown-item" href="' . route('dashboard-withdraw-edit', $item->id) .'">
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
        return view('pages.dashboard-withdraw');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user']) //memanggil data DB dan relasi di model
                            ->whereHas('product', function($product){ //mencari produk yang berhasil terjual
                                $product->where('users_id', Auth::user()->id); //mencari transaksi pada user yang sedang login
                            })->get();
        
        return view('pages.dashboard-withdraw-create', [
            'sellTransactions' => $sellTransactions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Withdraw::create($data);

        return redirect()->route('dashboard-withdraw');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Withdraw::findOrFail($id);

        return view('pages.dashboard-withdraw-edit',[
            'item' => $item,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}

