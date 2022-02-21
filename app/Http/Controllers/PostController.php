<?php

namespace App\Http\Controllers;

use App\Models\Post;
// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\AccessToken;

class PostController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth:api','bearer_header']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|unique:posts,title',
            'content' => 'required',
        ]);
        // return auth()->user();
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->author = auth()->user()->name;
        $post->save();


        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $post = Post::find($request->post);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json([
            'data'=>[
                'message' => 'Post Updated Successfully'
            ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'data'=>[
                'message' => 'Post deleteed successfully'
            ]
            ]);
    }
    public function logout(){
        $user = auth()->user()->token();
        $user->revoke();
        return response()->json([
            'data'=>[
                'message'=> 'Logged out'
            ]
            ]);
    }
}
