<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class AdminPostController extends Controller
{

    private function getCategoryDropdownOptions()
    {
        return Category::pluck('name', 'id')->sortBy('name')->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post = new Post;
        $categoryDropdownOptions = self::getCategoryDropdownOptions();
        
        return view('admin.posts.createOrEdit', ['post'=>$post, 'categoryDropdownOptions'=>$categoryDropdownOptions]); // , 'roleDropdownOptions'=>$roleDropdownOptions
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        

        if (!$input['category_id']) {
            unset($input['category_id']);
        }
        $post = Post::create($input);
        //dd($input);
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $fileName = time().'_'.rand(10000,99999).'.'.$photo->getClientOriginalExtension();

            $photo->move(public_path('images/photos'), $fileName);

            $photoModel = Photo::create(['file'=>$fileName]);
            $photoModel->save();

            $post->photo()->associate($photoModel);
            
        }
        $post->save();

        Session::flash('message_success', 'post added: '.$post->name);

        return redirect('/admin/posts');
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
