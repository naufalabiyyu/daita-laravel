<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionsController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('transaction', function($transaction){
                                $transaction->where('users_id', Auth::user()->id);
                            })->orderBy('id','desc')->get();
                            
        return view('pages.dashboard-transactions',[
            'transactions' => $transactions
        ]);
    }
    public function details(Request $request, $id)
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->findOrFail($id);

        return view('pages.dashboard-transactions-detail',[
            'transactions' => $transactions
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-detail', $id);
    }
}
