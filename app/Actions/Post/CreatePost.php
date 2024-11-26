<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost{

    public function execute($request){

        
        $post = Auth::user()->posts()->create($request);

        if($post){
            return true;
        }

        return false;

    }

}