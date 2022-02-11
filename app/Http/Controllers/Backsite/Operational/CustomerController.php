<?php

namespace App\Http\Controllers\Backsite\Operational;

use App\Http\Controllers\Controller;

use App\Http\Requests\Backsite\Operational\StoreCustomerRequest;
use App\Http\Requests\Backsite\Operational\UpdateCustomerRequest;

use App\Models\DetailUsers;
use App\Models\MasterData\Rate;
use App\Models\Operational\Customer;
use App\Models\User;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Gate;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
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
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $customers = Customer::latest()->with('user', 'rate')->paginate(500);

        $rates = Rate::latest()->get()->pluck('code', 'id');

        return view('pages.backsite.operational.customers.index', compact('customers', 'rates'));
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
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->all();

        // save to users
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['email']),
        ]);

        // set mobile phone
        $data['mobile_phone'] = str_replace(' ', '', $data['mobile_phone']);
        $data['mobile_phone'] = str_replace('_', '', $data['mobile_phone']);

        // Set No Meter electric random 12 digit
        $data['no_meter'] = mt_rand(000000000000,999999999999);

        // set status
        $status = 1; // active user
        $data['status'] = $status;

        // set users id
        $data['users_id'] = $user->id;

        // save to detail users
        DetailUsers::create([
            'users_id' => $data['users_id'],
            'mobile_phone' => $data['mobile_phone'],
            'address' => $data['address'],
            'status' => $data['status'],
        ]);

        $user->roles()->sync(3);

        // Set code
        $data['code'] = date('Ymd') . str_pad(Customer::count() + 1, 4, '0', STR_PAD_LEFT);

        Customer::create($data);

        alert()->success('Success Message', 'Save data has been success');

        return redirect()->route('backsite.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('user.detail_users', 'rate');

        return view('pages.backsite.operational.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('user.detail_users', 'rate');

        $rates = Rate::latest()->get()->pluck('code', 'id');

        return view('pages.backsite.operational.customers.edit', compact('customer', 'rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->all();

        $customer->load('user.detail_users', 'rate');

        // save to users
        $user = User::where('id', $customer->users_id)->first();
        $user->update([
            'name' => $data['name'],
        ]);

        // set mobile phone
        $data['mobile_phone'] = str_replace(' ', '', $data['mobile_phone']);
        $data['mobile_phone'] = str_replace('_', '', $data['mobile_phone']);

        // save to detail users
        $detail_user = DetailUsers::where('users_id', $user['id'])->first();
        $detail_user->update([
            'mobile_phone' => $data['mobile_phone'],
            'address' => $data['address'],
        ]);

        $customer->update($data);

        alert()->success('Success Message', 'Save data has been success');

        return redirect()->route('backsite.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        alert()->success('Success Message', 'Delete data has been success');

        return redirect()->route('backsite.customer.index');
    }
}
