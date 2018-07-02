<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission("show-user")){    
        $posts = Post::latest()->paginate(5);
        return view("Post.index", compact("posts"))
                ->with('i', (request()->input('page', 1) - 1) * 5);;;
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasPermission("create-info"))
        {    
        return view("Post.create", compact("posts"));
         }else{
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'author' => 'required',
            'title' => 'required',
            'description' => 'required'

        ]);

        $posts = new Post();
        $posts->author = $request->author;
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->save();

        alert()->success('Successfully', 'Post Created!');
        return redirect()->route('noticeboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasPermission("show-info"))
        {  
            $posts = Post::find($id);
            return view("Post.show", compact("posts"));
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission("create-info"))
        {   
            $posts = Post::findOrFail($id);

            return view("Post.edit", compact("posts"));
         }else{
            return redirect()->route('home');
        }
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
        request()->validate([
            'author' => 'required',
            'title' => 'required',
            'description' => 'required'
            ]);
        Post::find($id)->update($request->all());
        alert()->success('Successfully', ' Updated Post Info');
         // Session::flash('message', 'You have successfully updated Product.'); 
         return redirect()->route('noticeboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermission("delete-info"))
        {   

        $posts = Post::findOrFail($id)->delete();
        alert()->success('Successfully', ' Deleted Post Info');
        return redirect()->route('noticeboard.index');

        }else{
            return abort(401);
        }
    }
}
