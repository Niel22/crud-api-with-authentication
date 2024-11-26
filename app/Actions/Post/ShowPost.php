<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ShowPost{

    public function execute($id){

        $post = Post::find($id);

        if($post != []){

            if($post->user_id == Auth::id()){

                return $post;
            }

            return false;
        }

        return false;

    }
}