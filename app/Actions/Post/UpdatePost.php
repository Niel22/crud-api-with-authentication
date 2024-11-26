<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UpdatePost{

    public function execute($id, $request){

        $post = Post::find($id);

        if($post != []){

            if($post->user_id == Auth::id()){
                return $post->update($request);
            }

            return false;
        }

        return false;

    }

}