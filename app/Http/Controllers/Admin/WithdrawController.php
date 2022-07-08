<?php

namespace App\Http\Controllers\Admin;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables as DataTablesDataTables;

class WithdrawController extends Controller
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
            $query = Withdraw::with(['user', 'transactionDetails']);

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
                                    <a class="dropdown-item" href="' . route('withdraw.edit', $item->id) .'">
                                        Edit
                                    </a>
                                    <form action="'. route('withdraw.destroy', $item->id) .'" method="POST">
                                        '. method_field('delete').  csrf_field() .'
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action','status'])
                ->make();
        }

        return view('pages.admin.withdraw.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

        return view('pages.admin.withdraw.edit',[
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
        $data = $request->all();

        $item = Withdraw::findOrFail($id);

        $item->update($data);

        return redirect()->route('withdraw.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Withdraw::findOrFail($id);
        $item->delete();

        return redirect()->route('withdraw.index');
    }
}
