<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
 
        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        //$nameの部分には、フォローされる側のユーザーの名前が入っている
        $user = User::where('name', $name)->first();

        //$request->user()は、フォローのリクエストを行なったユーザー
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        //followings()メソッドは、多対多のリレーション(BelongsToManyクラスのインスタンス)が返る
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
 
        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
 
        return ['name' => $name];
    }
}
