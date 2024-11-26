<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DeletePost{

    public function execute($id){

        $post = Post::find($id);

        if($post != []){

            if($post->user_id == Auth::id()){

                return $post->delete();
            }

            return false;

        }

        return false;

    }
}