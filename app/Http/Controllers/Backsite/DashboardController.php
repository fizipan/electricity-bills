<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Operational\Customer;
use App\Models\Role;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;

use Gate;

use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
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
        abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notCustomer = auth()->user()->roles()
                                    ->whereIn('title', Role::where('id', '!=', 3)
                                    ->get('title')->toArray())
                                    ->count() > 0;

        if ($notCustomer) {

            $transaction = Transaction::count();

            $bill_unpaid = Transaction::where('status', '1')->count();

            $bill_paid = Transaction::where('status', '3')->count();

        } else {

            $transaction = Transaction::whereHas('customer_usage.customer.user', function ($user) {
                $user->where('id', auth()->user()->id);
            })->count();

            $bill_unpaid = Transaction::whereHas('customer_usage.customer.user', function ($user) {
                $user->where('id', auth()->user()->id);
            })->where('status', '1')->count();

            $bill_paid = Transaction::whereHas('customer_usage.customer.user', function ($user) {
                $user->where('id', auth()->user()->id);
            })->where('status', '3')->count();

        }
        
        return view('pages.backsite.dashboard.index', compact('transaction', 'bill_unpaid', 'bill_paid'));
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
    public function show($id)
    {
        return abort(404);
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
