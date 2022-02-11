<?php

namespace App\Http\Controllers\Backsite\Profile;

use App\Http\Controllers\Controller;

use App\Http\Requests\Backsite\UpdateAccountRequest;
use App\Http\Requests\Backsite\UpdateDetailUserRequest;
use App\Http\Requests\Backsite\UpdateSecurityRequest;
use App\Http\Requests\Backsite\UploadPhotoProfileRequest;

use App\Models\DetailUsers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
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
        $user = User::where('id', Auth::user()->id)->first();
        $detail_user = DetailUsers::where('users_id', Auth::user()->id)->first();

        return view('pages.backsite.profile.index', compact('user', 'detail_user'));
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
    public function store()
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update()
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return abort(404);
    }


    // custom

    public function update_account(UpdateAccountRequest $request, UpdateDetailUserRequest $request_detail_user, $id)
    {
        // update to users
        $data = $request->all();

        $user = User::where('id', $id)->first();
        $user->update($data);

        $data = $request_detail_user->all();

        // set mobile phone
        $data['mobile_phone'] = str_replace(' ', '', $data['mobile_phone']);
        $data['mobile_phone'] = str_replace('_', '', $data['mobile_phone']);

        $item = DetailUsers::where('users_id', $user['id'])->first();
        $item->update($data);

        alert()->success('Success Message','Update data has been success');
        return redirect()->route('backsite.profiles.index');
    }

    public function update_security(UpdateSecurityRequest $request, User $user, $id)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $item = User::findOrFail($id);
        $item->update($data);

        alert()->success('Success Message','Update data has been success');
        return redirect()->route('backsite.profiles.index');
    }

    public function upload(UploadPhotoProfileRequest $request, DetailUsers $detail_users, $id)
    {
        
        // first checking old photo to delete from storage
        $get_item = DetailUsers::where('users_id', $id)->first();

        $position_string = strpos($get_item['photo'], 'assets');
        $get_item = substr($get_item['photo'], $position_string);

        $data = $get_item;
        $data = 'storage/'.$get_item;
        
        if (File::exists($data)) {
            File::delete($data);
        }else{
            $get_item = str_replace("storage/","", $data);
            File::delete('storage/app/public/'.$get_item);
        }
        
        // second get all request & set new path to request field path
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/photo-profile', 'public'
        );
        
        // third get first record as id user and update path
        $item = DetailUsers::where('users_id', $id)->first();
        $item->update($data);

        alert()->success('Success Message','Upload photo has been success');
        return redirect()->route('backsite.profiles.index');
    }

    public function reset(DetailUsers $detail_users, $id)
    {
        // first checking old photo to delete from storage
        $get_item = DetailUsers::where('users_id', $id)->first();
        $ids = $get_item['id'];

        $position_string = strpos($get_item['photo'], 'assets');
        $get_item = substr($get_item['photo'], $position_string);

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        // second update value to null string
        $data = DetailUsers::find($ids);
        $data->photo = '';
        $data->save();

        alert()->success('Success Message','Reset photo has been success');
        return redirect()->route('backsite.profiles.index');

    }
}
