<?php

namespace App\Http\Controllers\Backsite\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backsite\Transaction\PayBillRequest;
use App\Http\Requests\Backsite\Transaction\UploadPayBillRequest;
use App\Models\Role;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Gate;
use File;

class BillController extends Controller
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
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notCustomer = auth()->user()->roles()
                                    ->whereIn('title', Role::where('id', '!=', 3)
                                    ->get('title')->toArray())
                                    ->count() > 0;

        if($notCustomer) {

            $bills = Transaction::latest()
                                ->with('customer_usage.customer.user')
                                ->whereIn('status', [1, 2])
                                ->paginate(500);

        } else {
            
            $bills = Transaction::latest()
                                ->with('customer_usage.customer.user')
                                ->whereIn('status', [1, 2])
                                ->whereHas('customer_usage.customer.user', function($user) {
                                    $user->where('id', auth()->user()->id);
                                })->paginate(500);
                
        }
        

        return view('pages.backsite.transaction.bills.index', compact('bills'));
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
    public function show(Transaction $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->load('customer_usage.customer.user');

        return view('pages.backsite.transaction.bills.show', compact('bill'));
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

    public function pay_bill($id)
    {
        abort_if(Gate::denies('bill_pay'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill = Transaction::with('customer_usage.customer.user')->findOrFail($id);

        return view('pages.backsite.transaction.bills.edit', compact('bill'));
    }

    public function upload_pay_bill(UploadPayBillRequest $request, $id)
    {
        $data = $request->all();

        $item = Transaction::where('id', $id)->first();

        $notCustomer = auth()->user()->roles()
                                    ->whereIn('title', Role::where('id', '!=', 3)
                                    ->get('title')->toArray())
                                    ->count() > 0;

        if ($notCustomer) {
            $data['status'] = 3;
        } else {
            $data['status'] = 2;
        }

        $data['photo'] = $request->file('photo')->store(
            'assets/photo-payment', 'public'
        );;

        $item->update($data);

        alert()->success('Success Message','Upload photo has been success');
        return redirect()->route('backsite.bill.index');
    }

    public function confirm_pay_bill($id)
    {
        abort_if(Gate::denies('bill_confirm_pay'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill = Transaction::findOrFail($id);

        $bill->update([
            'status' => 3,
        ]);

        alert()->success('Success Message', 'Pay Bill has been success');
        return redirect()->route('backsite.bill.index');
    }
}
