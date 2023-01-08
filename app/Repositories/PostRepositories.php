<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Post;
use App\Repositories\BaseRepositories;
use Exception;
use Illuminate\Support\Facades\DB;

class PostRepositories extends BaseRepositories
{
    public function create(array $attributes){
        $post = [
            'title' => data_get($attributes, 'title', 'Untitled'),
            'body' => data_get($attributes, 'body')
        ];

        $newPost = Post::query()->create($post);

        return $newPost;


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
    /**
     * @param Post $post
     * @param array $attributes
     * @return mixed
     */

    public function update($post,array $attributes){
        $updated = $post->update([
            'title' => data_get($attributes, 'title', $post->title),
            'body' => data_get($attributes, 'body', $post->body),
        ]);

        if(!$updated){
            throw new \Exception('Failed to update Post');
        }

        return $post;
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function delete($post){
        return DB::transaction(function () use($post) {
            $deleted = $post->forceDelete();
    
            // if(!$deleted){
            //     throw new Exception('Failed to Delete Post');
            // }

            throw_if(!$deleted, GeneralException::class, 'Failed');
            return $deleted;
            
        });

    }
}