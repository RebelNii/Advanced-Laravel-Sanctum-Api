<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Requests\V1\UpdatePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Repositories\PostRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Post Management
 * 
 * APIs to management Post resource
 */

class PostController extends Controller
{
    //
    /**
     * get all post data from database
     */
    public function index(){
        return PostResource::collection(Post::query()->paginate(3));
    }

    /**
     * Create new posts
     */

    public function store(StorePostRequest $request, PostRepositories $repository){
        // dd($request);
        // $created = $repository->create($request->only([
        //     'title', 'body'
        // ]));
        $created = $repository->create($request->all());

        if($created){
            return new PostResource($created);
        }else{
            return new GeneralException('Failed',422);
        }


        // $post = [
        //     'title' => $request->title,
        //     'body' => $request->body
        // ];

        // $newPost = Post::create($post);
        // return new PostResource($newPost);

        //Database transaction ensure that all DB queries are completed
    
        // DB::transaction(function () use ($request) {
        //     $post = [
        //         'title' => $request->title,
        //         'body' => $request->body
        //     ];
    
        //     $newPost = Post::create($post);
        //     $newPost->user()->sync($request->user_id);
        //     return new PostResource($newPost);
        // });
    }

    public function show(Post $post){
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post){
        // return $post->update($request->all());
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);

        return new PostResource($post);
    }

    public function delete(Post $post){
        $post->delete();
        return new JsonResponse([
            'data' => 'Success'
        ]);
    }
}
