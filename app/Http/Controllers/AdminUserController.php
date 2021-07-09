<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


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
        //$roleDropdownOptions = [''=>'-none-'];
        //$roles = Role::all()->sortBy('name');
        //foreach ($roles as $role) {
        //    $roleDropdownOptions[$role->id] = $role->name;
        //}
        $roles = Role::pluck('name', 'id')->sortBy('name')->all();
        $roleDropdownOptions = $roles;
        return view('admin.users.createOrEdit', ['typeDisplay'=>'Create', 'user'=>$user, 'roleDropdownOptions'=>$roleDropdownOptions, 'role_id' => 0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
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

            $photoModel = new Photo;
            $photoModel->file = $fileName;
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
        //
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
        //
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
    }
}
