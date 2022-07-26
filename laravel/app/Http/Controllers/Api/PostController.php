<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\BlogPost;
use App\Http\Resources\BlogPostResource;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getPosts() {
        return BlogPostResource::collection(BlogPost::get(),200);
    }
    public function getPostsById($id) {
        return BlogPostResource::collection(BlogPost::find($id),200);
    }
    public function savePost(Request $request) {

        DB::beginTransaction();
        $data = $request->input();
        $item = new BlogPost($data);
        $item->save();
        DB::commit();

        return response()->json($item,201);
    }
}
