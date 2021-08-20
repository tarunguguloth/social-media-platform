<?php


namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService{

    public function createUser( Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $location = $request->input('location');
        $country = $request->input('country');

        $data = array('name'=>$name,'email'=>$email,'location'=>$location,'country'=>$country);
        return DB::table('users')->insertGetId($data);

    }

    public function createPost(Request  $request,int $user_id){

        $body = $request->input('body');
        $data = array('user_id'=>$user_id,'body'=>$body);
        return DB::table('posts')->insertGetId($data);
    }

    public function writeComment(Request  $request,int $user_id,int $post_id){
        $body = $request->input('body');
        $data = array('user_id'=>$user_id,'post_id'=>$post_id,'body'=>$body);
        return DB::table('comments')->insertGetId($data);
    }
    public function getPosts(int $user_id){
        return DB::table('posts')->where('user_id',$user_id)->get();
    }
    public function getComments(int $user_id,int $post_id)
    {
        return DB::table('comments')->whereRaw('user_id=? AND post_id=?', [$user_id, $post_id])->get();
    }
    public function getUsers()
    {
        return DB::table('users')->get();
    }


}
