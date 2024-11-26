<?php

namespace App\Actions\Post;

use Illuminate\Support\Facades\Auth;

class ListPost{

    public function execute(){

        $post = Auth::user()->posts;

        if($post->isNotEmpty()){
            return $post;
        }

        return false;

    }
}