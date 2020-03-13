<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Post;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use App\Http\Requests\StoreBlogPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $posts = Post::with('user.country')->orderBy('created_at', 'desc')->paginate(4);
        
        return view('posts.index', compact('posts'));
    }

    public function myPosts()
    {
        $auth_id = auth()->id();

        $posts = Post::where('user_id', $auth_id)->orderBy('created_at', 'desc')->paginate(4);

        return view('posts.my-posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBlogPost $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
 
        $data = $request->all();
        $desc = explode(' ', $data['description']);
        $line = implode(" ", array_slice($desc, 0, 10));
        $data['short_desc'] = $line;
        $data['user_id'] = auth()->id();

        if($request->hasfile('image')) {
            $data['image'] = $this->saveImg($request);
        }

        $post = Post::create($data);

        return redirect('/home')->with('status', 'Post was created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->with('comments')->first();

        if($post){
            return view('posts.show', compact('post'));
        }

        return redirect('/posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('posts.edit', compact('post'));
        }

        return redirect('/posts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
        $post = Post::find($id);

        if($post) {

            $data = $request->except('old_image');
            $desc = explode(' ', $data['description']);
            $line = implode(" ", array_slice($desc, 0, 10));
            $data['short_desc'] = $line;
            $data['user_id'] = auth()->id();

            if($request->hasfile('image')) {
                $data['image'] = $this->saveImg($request);
            }

            $post->update($data);

            return redirect('/home')->with('status', 'Post was updated succesfully');
        }

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post) {

            $post->delete();

            return redirect('/my-posts')->with('status', 'Post was deleted succesfully');
        }

        return redirect('/posts');
    }

    private function saveImg(StoreBlogPost $request)
    {
        $image = $request->file('image');
        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path() . '/images/', $name);
        return $name;
    }
 
}
