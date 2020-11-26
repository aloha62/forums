<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource as Resource;
use App\Comments;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    /**
     * Display comments for a public post
     * Returns a paginated result of published comments
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_public($id)
    {
        try {
            return new Resource(DB::table('comments')
                ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.is_published', true)
                ->select(['comments.id', 'comments.content', 'comments.is_published', 'comments.user_id', 'comments.post_id', 'comments.created_at', 'comments.updated_at'])
                ->where('comments.post_id', $id)
                ->where('comments.is_published', true)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    
    /**
     * Display comments for a protected post
     * Returns a paginated result of comments
     * Input keys: api_token, id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_protected($id)
    {
        try {
            return new Resource(DB::table('comments')
                ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.is_published', false)
                ->select(['comments.id', 'comments.content', 'comments.is_published', 'comments.user_id', 'comments.post_id', 'comments.created_at', 'comments.updated_at'])
                ->where('comments.post_id', $id)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    
    /**
     * Display public comments for a user
     * Returns a paginated result of published comments
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_public_user($id)
    {
        try {
            return new Resource(Comments::where('is_published', true)->where('user_id', $id)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }

    
    /**
     * Display private comments for a user
     * Returns a paginated result of protected comments
     * Input keys: api_token, id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show_private_user($id)
    {
        try {
            return new Resource(Comments::where('is_published', false)->where('user_id', $id)->paginate(5));
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    /**
     * Create a comment
     * Input keys: api_token, content, post_id, published (1 = yes, 0 = no)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $comment = Comments::create([
                'content' => $request->input('content'),
                'is_published' => $request->input('published'),
                'post_id' => $request->input('post_id'),
                'user_id' => $user->id
            ]);
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $comment;
    }
    
    
    /**
     * Updates the specified comment
     * Input keys: api_token, id, content, published (1 = yes, 0 = no)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $comment = Comments::where('user_id', $user->id)
                ->where('id', $request->input('id'))
                ->update([
                    'content' => $request->input('content'),
                    'is_published' => $request->input('published')
                ]);
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $comment;
    }
    
    
    /**
     * Deletes the specified comment
     * Input keys: api_token, id
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = auth()->guard('api')->user();
            $result = Comments::where('user_id', $user->id)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $e){
            throw new HttpException(500, $e->getMessage());
        }
        return $result;
    }
}
