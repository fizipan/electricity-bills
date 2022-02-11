<?php

namespace App\Http\Controllers\Backsite\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Gate;

class TransactionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notCustomer = auth()->user()->roles()
                                    ->whereIn('title', Role::where('id', '!=', 3)
                                    ->get('title')->toArray())
                                    ->count() > 0;
                                    
        if ($notCustomer) {

            $transactions = Transaction::latest()
                                ->with('customer_usage.customer.user')
                                ->paginate(500);

        } else {

            $transactions = Transaction::latest()
                                ->with('customer_usage.customer.user')
                                ->whereHas('customer_usage.customer.user', function ($user) {
                                    $user->where('id', auth()->user()->id);
                                })->paginate(500);

        }

        return view('pages.backsite.transaction.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('customer_usage.customer.user');

        return view('pages.backsite.transaction.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
