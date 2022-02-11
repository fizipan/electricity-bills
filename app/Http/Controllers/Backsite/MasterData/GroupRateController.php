<?php

namespace App\Http\Controllers\Backsite\MasterData;

use App\Http\Controllers\Controller;

use App\Http\Requests\Backsite\MasterData\StoreGroupRateRequest;
use App\Http\Requests\Backsite\MasterData\UpdateGroupRateRequest;

use App\Models\MasterData\GroupRate;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

use Gate;

class GroupRateController extends Controller
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
         abort_if(Gate::denies('group_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group_rates = GroupRate::latest()->paginate(500);

        return view('pages.backsite.master-data.group-rates.index', compact('group_rates'));
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
    public function store(StoreGroupRateRequest $request)
    {
        $data = $request->all();

        // Set name to upper case    
        $data['name'] = strtoupper($data['name']);

        GroupRate::create($data);

        alert()->success('Success Message','Save data has been success');

        return redirect()->route('backsite.group_rate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GroupRate $group_rate)
    {
        abort_if(Gate::denies('group_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.group-rates.show', compact('group_rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupRate $group_rate)
    {
        abort_if(Gate::denies('group_rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.master-data.group-rates.edit', compact('group_rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRateRequest $request, GroupRate $group_rate)
    {
        $data = $request->all();

        // Set name to upper case    
        $data['name'] = strtoupper($data['name']);

        $group_rate->update($data);

        alert()->success('Success Message','Update data has been success');

        return redirect()->route('backsite.group_rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupRate $group_rate)
    {
        abort_if(Gate::denies('group_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group_rate->delete();

        alert()->success('Success Message','Delete data has been success');

        return redirect()->route('backsite.group_rate.index');
    }
}
