<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function createUser(): JsonResponse
    {
        $name = \request('name');
        $email = \request('email');
        $location = \request('location');
        $country = \request('country');

        $data = array('name'=>$name,'email'=>$email,'location'=>$location,'country'=>$country);
        $userid = DB::table('users')->insertGetId($data);
        return response()->json([
            'user_id'=>$userid,
            'name'=>$name,
            'email'=>$email,
            'location'=>$location,
            'country'=>$country
            ]);
    }
    public function createPost(int $user_id): JsonResponse
    {
        $body = \request('body');
        $data = array('user_id'=>$user_id,'body'=>$body);
        $post_id = DB::table('posts')->insertGetId($data);
        return response()->json([
            'post_id'=>$post_id,
            'user_id'=>$user_id,
            'body'=>$body]);
    }
    public function writeComment(int $user_id,int $post_id): JsonResponse
    {
        $body = \request('body');
        $data = array('user_id'=>$user_id,'post_id'=>$post_id,'body'=>$body);
        $comment_id = DB::table('comments')->insertGetId($data);
        return response()->json([
            'comment_id' => $comment_id,
            'post_id'=>$post_id,
            'user_id'=>$user_id,
            'body'=>$body]);
    }
    public function getPosts(int $user_id): JsonResponse
    {
        $posts = DB::table('posts')->where('user_id',$user_id)->get();
        return response()->json([
            'posts'=>$posts,
        ]);
    }
    public function getComments(int $user_id,int $post_id): JsonResponse
    {
        $comments = DB::table('comments')->whereRaw('user_id=? AND post_id=?', [$user_id,$post_id])->get();
        return response()->json([
            'comments'=>$comments,
        ]);
    }

}
