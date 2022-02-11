<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backsite\StoreDetailUserRequest;
use App\Http\Requests\Backsite\StoreUserRequest;
use App\Http\Requests\Backsite\UpdateDetailUserRequest;
use App\Http\Requests\Backsite\UpdateUserRequest;

use App\Models\DetailUsers;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Gate;
use Illuminate\Support\Facades\Hash;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
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
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::orderBy('created_at', 'desc')->paginate(500);
        $roles = Role::all()->pluck('title', 'id');

        return view('pages.backsite.management.users.index', compact('users', 'roles'));
    }

    public function store(StoreUserRequest $request, StoreDetailUserRequest $request_detail_user)
    {
        $data = $request->all();
        
        // set uuid
        $uuid = Uuid::uuid4()->toString();
        $data['uuid'] = $uuid;

        // default password email
        $data['password'] = Hash::make($data['email']);

        // save to users
        $user = User::create($data);

        $data = $request_detail_user->all();

        // set status
        $status = 1; // active user
        $data['status'] = $status;

        // set mobile phone
        $data['mobile_phone'] = str_replace(' ', '', $data['mobile_phone']);
        $data['mobile_phone'] = str_replace('_', '', $data['mobile_phone']);

        // set users id
        $data['users_id'] = $user->id;

        // save to detail users
        $request_detail_user = DetailUsers::create($data);

        // sync role by users select
        $user->roles()->sync($request->input('roles', []));

        alert()->success('Success Message', 'Save data has been success');

        return redirect()->route('backsite.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');
        $detail_user = DetailUsers::where('users_id', $user['id'])->first();

        return view('pages.backsite.management.users.show', compact('user', 'detail_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detail_user = DetailUsers::where('users_id', $user->id)->first();
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');

        return view('pages.backsite.management.users.edit', compact('roles', 'user', 'detail_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, UpdateDetailUserRequest $request_detail_user, User $user)
    {
        // update users
        $data = $request->all();

        $user->update($data);

        // update roles
        $user->roles()->sync($request->input('roles', []));

        // update to detail users
        $data = $request_detail_user->all();

        // set mobile phone
        $data['mobile_phone'] = str_replace(' ', '', $data['mobile_phone']);
        $data['mobile_phone'] = str_replace('_', '', $data['mobile_phone']);

        $item = DetailUsers::where('users_id', $user['id'])->first();
        $item->update($data);

        alert()->success('Success Message', 'Update data has been success');

        return redirect()->route('backsite.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // checking photo for deleting photo from storadge
        $photo_profile = DetailUsers::where('users_id', $user->id)->first();

        // delete detail users
        DetailUsers::where('users_id', $user->id)->forceDelete();

        // delete file photo
        if(isset($photo_profile)){
            if ($photo_profile->photo != "") {
                $data = 'storage/' . $photo_profile->photo;
                if (File::exists($data)) {
                    File::delete($data);
                } else {
                    File::delete('storage/app/public/' . $photo_profile->photo);
                }
            }
        }

        // delete users
        $user->forceDelete();

        alert()->success('Success Message', 'Delete data has been success');

        return back();
    }


    // custom
    
    public function filter(Request $request)
    {
        abort_if(Gate::denies('user_filter'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $ds = substr($request->from, 0,2);
        $ms = substr($request->from, 3,2);
        $ys = substr($request->from, 6,4);
        $ss = substr($request->from, 11);

        $from = $ys.'-'.$ms.'-'.$ds.' '.$ss;

        $de = substr($request->to, 0,2);
        $me = substr($request->to, 3,2);
        $ye = substr($request->to, 6,4);
        $se = substr($request->to, 11);

        $to = $ye.'-'.$me.'-'.$de.' '.$se;

        $find = $request->find;

        $users = User::whereBetween('created_at', [$from, $to])
                    ->where('name', 'LIKE', '%'.$find.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(500);

        $roles = Role::all()->pluck('title', 'id');
                    
        $find = $request->find;
        $from = $request->from;
        $to = $request->to;

        return view('pages.backsite.management.users.index', compact('users', 'roles', 'find', 'from', 'to'));
    }

    public function reset_password($id)
    {
        abort_if(Gate::denies('user_reset_password'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $get_user = User::where('id', $id)->first();
        $new_password = hash::make($get_user['email']);

        // update password
        $user = User::find($id);
        $user->password = $new_password;
        $user->save();

        alert()->success('Success Message', 'Reset password has been success');

        return back();
    }
}
