<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = new User;
        $roleDropdownOptions = self::getRoleDropdownOptions();
        return view('admin.users.createOrEdit', ['user'=>$user, 'roleDropdownOptions'=>$roleDropdownOptions]);
    }

    private static function getRoleDropdownOptions()
    {
        return Role::pluck('name', 'id')->sortBy('name')->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $input = $request->all();

        $user = User::create($input);
        
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $fileName = time().'_'.rand(10000,99999).'.'.$photo->getClientOriginalExtension();
            //$filePath = $photo->storeAs('images/photos', $fileName, 'public');
            $photo->move(public_path('images/photos'), $fileName);
            //dd($fileName);
            //$photo = $request->file('photo');

            //$photoModel = new Photo;
            //$photoModel->file = $fileName;
            $photoModel = Photo::create(['file'=>$fileName]);
            //$input['photo_id'] = 
            $photoModel->save();

            //$input['photo_id'] = $photoModel->id;
            //$user->photo()->associate($photoModel);
            //$photoModel->user()->associate($user);



            $user->photo()->associate($photoModel);
            
        }
        $user->save();
        //dd('no file');
        //
        
        Session::flash('message_success',$user->name.' has been added');

        return redirect('/admin/users');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roleDropdownOptions = self::getRoleDropdownOptions();
        return view('admin.users.createOrEdit', ['user'=>$user, 'roleDropdownOptions'=>$roleDropdownOptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $input = $request->all();

        //$user = User::create($input);
        $user = User::findOrFail($id);
        
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $fileName = time().'_'.rand(10000,99999).'.'.$photo->getClientOriginalExtension();
            //$filePath = $photo->storeAs('images/photos', $fileName, 'public');
            $photo->move(public_path('images/photos'), $fileName);
            //dd($fileName);
            //$photo = $request->file('photo');

            $photoModel = Photo::create(['file'=>$fileName]);
            //$photoModel->file = $fileName;
            //$input['photo_id'] = 
            $photoModel->save();

            //$input['photo_id'] = $photoModel->id;
            //$user->photo()->associate($photoModel);
            //$photoModel->user()->associate($user);



            $user->photo()->associate($photoModel);
            
        }
        if (!$request->password) {
            unset($input['password']);
        }
        $user->update($input);
        Session::flash('message_success',$user->name.' has been updated');
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $userName = $user->name;
        if ($user->photo) {
            //dd($user->photo->getRawOriginal('file'));
            unlink(public_path('images/photos/').$user->photo->getRawOriginal('file'));
        }
        $user->delete();
        Session::flash('message_success',$userName.' has been deleted');
        
        return redirect('/admin/users');
    }
}
