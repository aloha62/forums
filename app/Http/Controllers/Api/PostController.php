<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Comments;
use App\Http\Resources\Posts as PostResource;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * List all public posts
     * Returns a paginated instance of published posts
     * Includes the last 5 comments and comment total for each post
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostCollection(Posts::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Posts;
        
        $post->slug = Str::slug($request->title, '-');
        
        $post->save();
    }

    /**
     * Display a public post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostResource(Posts::where('is_published', true)->findorfail($id));
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
