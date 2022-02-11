<?php

namespace App\Http\Controllers\Backsite\MasterData;

use App\Http\Controllers\Controller;

use App\Http\Requests\Backsite\MasterData\StoreRateRequest;
use App\Http\Requests\Backsite\MasterData\UpdateRateRequest;

use App\Models\MasterData\GroupRate;
use App\Models\MasterData\Rate;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Gate;

class RateController extends Controller
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
        abort_if(Gate::denies('rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $rates = Rate::latest()->with('group_rate')->paginate(500);

        $group_rates = GroupRate::latest()->get()->pluck('name', 'id');

        return view('pages.backsite.master-data.rates.index', compact('rates', 'group_rates'));
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
    public function store(StoreRateRequest $request)
    {
        $data = $request->all();

        // Set Power
        $data['power'] = rtrim(str_replace('VA', '', $data['power']), ' ');
        $data['power'] = str_replace(',', '', $data['power']);

        // Set Price
        $data['rate_power'] = ltrim(str_replace('IDR', '', $data['rate_power']), ' ');
        $data['rate_power'] = str_replace(',', '', $data['rate_power']);

        // Set Code
        $group_rate = GroupRate::where('id', $data['group_rate_id'])->firstOrFail();
        $data['code'] = $group_rate->name . '/' . $data['power'] . 'VA';

        // Save to rate
        Rate::create($data);

        alert()->success('Success Message', 'Save data has been success');

        return redirect()->route('backsite.rate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        abort_if(Gate::denies('rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $rate->load('group_rate');

        return view('pages.backsite.master-data.rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        abort_if(Gate::denies('rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rate->load('group_rate');

        $group_rates = GroupRate::latest()->get()->pluck('name', 'id');

        return view('pages.backsite.master-data.rates.edit', compact('rate', 'group_rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateRequest $request, Rate $rate)
    {
        $data = $request->all();

        // Set Power
        $data['power'] = rtrim(str_replace('VA', '', $data['power']), ' ');
        $data['power'] = str_replace(',', '', $data['power']);

        // Set Price
        $data['rate_power'] = ltrim(str_replace('IDR', '', $data['rate_power']), ' ');
        $data['rate_power'] = str_replace(',', '', $data['rate_power']);

        // Set Code
        $group_rate = GroupRate::where('id', $data['group_rate_id'])->firstOrFail();
        $data['code'] = $group_rate->name . '/' . $data['power'] . 'VA';

        // Save to rate
        $rate->update($data);

        alert()->success('Success Message', 'Update data has been success');

        return redirect()->route('backsite.rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        abort_if(Gate::denies('rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rate->delete();

        alert()->success('Success Message', 'Delete data has been success');

        return redirect()->route('backsite.rate.index');
    }
}
