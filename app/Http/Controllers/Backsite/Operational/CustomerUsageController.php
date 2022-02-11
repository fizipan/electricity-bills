<?php

namespace App\Http\Controllers\Backsite\Operational;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backsite\Operational\StoreCustomerUsageRequest;
use App\Http\Requests\Backsite\Operational\UpdateCustomerUsageRequest;
use App\Models\Operational\Customer;
use App\Models\Operational\CustomerUsage;
use App\Models\Transaction\DetailTransaction;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Gate;

class CustomerUsageController extends Controller
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
        abort_if(Gate::denies('customer_usage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer_usage = CustomerUsage::latest()->with('customer.user', 'customer.rate')->paginate(500);

        $customers = Customer::latest()->get();

        return view('pages.backsite.operational.customer-usage.index', compact('customers', 'customer_usage'));
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
    public function store(StoreCustomerUsageRequest $request)
    {
        $data = $request->all();

        $du = substr($data['date_usage'], 0,2);
        $mu = substr($data['date_usage'], 3,2);
        $yu = substr($data['date_usage'], 6,4);

        $data['date_usage'] = $yu.'-'.$mu.'-'.$du;

        $dc = substr($data['date_check'], 0,2);
        $mc = substr($data['date_check'], 3,2);
        $yc = substr($data['date_check'], 6,4);

        $data['date_check'] = $yc.'-'.$mc.'-'.$dc;

        $usage = CustomerUsage::create($data);

        // Set code random transaction
        $code = date('Ymd') . str_pad(CustomerUsage::count() + 1, 4, '0', STR_PAD_LEFT);

        // Set total meter
        $total_meter = $usage->start_meter + $usage->end_meter;

        // Set total price
        $total_price = ($usage->end_meter - $usage->start_meter) * $usage->customer->rate->rate_power;

        Transaction::create([
            'customer_usage_id' => $usage->id,
            'code' => $code,
            'total_meter' => $total_meter,
            'total_price' => $total_price,
            'status' => '1',
        ]);

        alert()->success('Success Message', 'Save data has been success');

         return redirect()->route('backsite.customer_usage.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerUsage $customer_usage)
    {
        abort_if(Gate::denies('customer_usage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer_usage->load('customer.user', 'customer.rate');

        return view('pages.backsite.operational.customer-usage.show', compact('customer_usage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerUsage $customer_usage)
    {
        abort_if(Gate::denies('customer_usage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer_usage->load('customer.user', 'customer.rate');

        $customers = Customer::latest()->get();

        return view('pages.backsite.operational.customer-usage.edit', compact('customer_usage', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerUsageRequest $request, CustomerUsage $customer_usage)
    {
        $data = $request->all();

        $du = substr($data['date_usage'], 0,2);
        $mu = substr($data['date_usage'], 3,2);
        $yu = substr($data['date_usage'], 6,4);

        $data['date_usage'] = $yu.'-'.$mu.'-'.$du;

        $dc = substr($data['date_check'], 0,2);
        $mc = substr($data['date_check'], 3,2);
        $yc = substr($data['date_check'], 6,4);

        $data['date_check'] = $yc.'-'.$mc.'-'.$dc;
        
        // Set total meter
        $total_meter = $data['start_meter'] + $data['end_meter'];

        // Set total price
        $total_price = ($data['end_meter'] - $data['start_meter']) * $customer_usage->customer->rate->rate_power;

        $transaction = Transaction::where('customer_usage_id', $customer_usage->id)->first();

        $transaction->update([
            'total_meter' => $total_meter,
            'total_price' => $total_price,
        ]);

        $customer_usage->update($data);

        alert()->success('Success Message', 'Update data has been success');

        return redirect()->route('backsite.customer_usage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerUsage $customer_usage)
    {
        abort_if(Gate::denies('customer_usage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer_usage->forceDelete();

        alert()->success('Success Message', 'Delete data has been success');

        return redirect()->route('backsite.customer_usage.index');
    }
}
