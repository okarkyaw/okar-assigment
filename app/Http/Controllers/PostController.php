<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostSaveRequest;
use App\Traits\Notify;
use  App\Mail\PostUpdate;
use App\Repositories\PostRepository;
use App\Services\PostService;

class PostController extends Controller
{
    use Notify;

    public function __construct(
        PostRepository $repository,
        PostService $service) {

        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guest()) {
            $posts = $this->$repository->guestPost();
        } else {
           // $user_id = auth()->user()->id;
            // $posts = Post::published()
            //     ->orWhere(function ($query) use ($user_id) {
            //         $query->postOwner($user_id);
            //     })
            //     ->get();
            $posts = $this->$repository->memberPost();
        }

        return view('post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',\App\Post::class);
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',\App\Post::class);
        $post = $this->service->make($request->validated());
        return redirect(route('post.show',$post));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = $this->repository->find($post);
        $this->authorize('view', $post);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit',\App\Post::class);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostSaveRequest $request, Post $post)
    {
        $this->authorize('update',$post);
        $post->update($request->validated());
        \Mail::to('okar.k2002@gmail.com')->send(
            new PostUpdate()
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
