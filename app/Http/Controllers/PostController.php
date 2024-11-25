<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        return Auth::user()->posts;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }

        $data = $validator->validated();

        $post = Auth::user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        if($post){
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => "Post Created successsfully",
                'post' => $post
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'status'=> 400,
                'message' => "Problem occured when creating post",
            ], 400);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if(Auth::id() != $post->user_id){
            return response()->json([
                'status' => 403,
                'message' => "This is an Unauthorize access"
            ], 403);
        }

        return $post;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if(Auth::id() != $post->user_id){
            return response()->json([
                'status' => 403,
                'message' => "This is an Unauthorize access"
            ], 403);
        }


        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }

        $data = $validator->validated();

        $post->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        return response()->json([
            'success' => true,
            'status' => 201,
            'message' => "Post Updated successsfully",
            'post' => $post
        ], 201);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(Auth::id() != $post->user_id){
            return response()->json([
                'status' => 403,
                'message' => "This is an Unauthorize access"
            ], 403);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'status' => 201,
            'message' => "Post Deleted",
            'post' => $post
        ], 201);


    }
}
