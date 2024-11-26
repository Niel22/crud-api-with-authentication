<?php

namespace App\Http\Controllers;

use App\Actions\Post\CreatePost;
use App\Actions\Post\DeletePost;
use App\Actions\Post\ListPost;
use App\Actions\Post\ShowPost;
use App\Actions\Post\UpdatePost;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class PostController extends Controller
{
    use ApiResponse;

    public function index(ListPost $action)
    {
        if($post = $action->execute()){
            return $this->success($post);
        }

        return $this->error('This user has not created any post yet');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request, CreatePost $action)
    {

        if($action->execute($request->all())){
            return $this->success([], "Post Created Successfully");
        }

        return $this->error('Problem occured while creating post');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id, ShowPost $action)
    {
        if($post = $action->execute($id)){
            return $this->success($post);
        }

        return $this->error('Post not found');


    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, UpdatePost $action, $id)
    {
        if($action->execute($id, $request->all())){
            return $this->success([], 'Post Updated Successfully');
        }

        return $this->error('Problem updating post');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, DeletePost $action)
    {
        
        if($action->execute($id)){
            return $this->success([], 'Post Deleted');
        }

        return $this->error('Problem deleting post');

    }
}
