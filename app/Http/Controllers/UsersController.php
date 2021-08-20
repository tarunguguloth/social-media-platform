<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_BAD_REQUEST);
        }
        $user_id = $this->userService->createUser($request);
        return response()->json([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'location'=>$request->input('location'),
            'country'=>$request->input('country'),
            ]);
    }
    public function createPost(Request $request,int $user_id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_BAD_REQUEST);
        }
        $post_id = $this->userService->createPost($request,$user_id);

        return response()->json([
            'post_id'=>$post_id,
            'user_id'=>$user_id,
            'body'=>$request->input('body')]);
    }
    public function writeComment(Request $request,int $user_id,int $post_id): JsonResponse
    {   $validator = Validator::make($request->all(), [
        'body' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_BAD_REQUEST);
        }
        $comment_id = $this->userService->writeComment($request,$user_id,$post_id);
        return response()->json([
            'comment_id' => $comment_id,
            'post_id'=>$post_id,
            'user_id'=>$user_id,
            'body'=>$request->input('body')]);
    }
    public function getPosts(int $user_id): JsonResponse
    {
        $posts = $this->userService->getPosts($user_id);
        if($posts==null){
            return response()->json(['message' => "user with id-$user_id does not exist"],Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'posts'=>$posts,
        ]);
    }
    public function getComments(int $user_id,int $post_id): JsonResponse
    {
        $comments = $this->userService->getComments($user_id,$post_id);
        if($comments==null){
            return response()->json(['message' => "post with id-$post_id does not exist"],Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'comments'=>$comments,
        ]);
    }
    public function getUsers(): JsonResponse
    {
        $users = $this->userService->getUsers();
        if($users==null){
            return response()->json(['message' => "No users registered"],Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'users'=>$users,
        ]);

    }

}
