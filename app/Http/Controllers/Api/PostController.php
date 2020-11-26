<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Http\Resources\Posts as PostResource;
use Illuminate\Http\Resources\Json\JsonResource as Resource;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;


class PostController extends Controller
{
    /**
     * List all public posts
     * Returns a paginated result of published posts
     * (Includes the last 5 comments and comment total for each post)
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list_public()
    {
        try {
            return PostResource::collection(Posts::where('is_published', true)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }

    
    /**
     * List all protected posts
     * Returns a paginated instance of protected posts
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function list_protected()
    {
        try {
            return new Resource(Posts::where('is_published', false)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    /**
     * Create a post
     * Input keys: api_token, title, content, published (1 = yes, 0 = no)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $post = Posts::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title'), '-'),
                'content' => $request->input('content'),
                'is_published' => $request->input('published'),
                'user_id' => $user->id
            ]);
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $post;
    }

    /**
     * Display a public post
     * Input keys: id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_public($id)
    {
        try {
            return new Resource(Posts::where('is_published', true)->findorfail($id));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    /**
     * Display a protected post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_protected($id)
    {
        try {
            return new Resource(Posts::where('is_published', false)->findorfail($id));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    /**
     * Updates the specified post
     * Input keys: api_token, id or slug, title, content, published
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $post = Posts::where('user_id', $user->id)
                ->where('id', $request->input('id'))->orwhere('slug', $request->input('slug'))
                ->update([
                    'title' => $request->input('title'),
                    'slug' => Str::slug($request->input('title'), '-'),
                    'content' => $request->input('content'),
                    'is_published' => $request->input('published'),
                ]);
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $post;
    }

    /**
     * Deletes the specified post
     * Input keys: api_token, id or slug
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = auth()->guard('api')->user();
            $result = Posts::where('user_id', $user->id)
                ->where('id', $id)->orwhere('slug', $id)
                ->delete();
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $result;
    }
}
