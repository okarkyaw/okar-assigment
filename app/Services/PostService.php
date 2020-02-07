<?php
namespace App\Services;
use \Cache;
use \Mail;
use App\Post;
use  App\Mail\PostCreate;

class PostService{
    
    public function make($data){
        $data['author_id'] = \Auth::user()->id;
        $post = Post::create($post);
       
        Cache::forever('post.' . $post->id, $post);
        Mail::to('okar.k2002@gmail.com')->send(
            new PostCreate()
        );
        return $post;
    }
}