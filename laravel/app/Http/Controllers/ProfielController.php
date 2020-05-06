<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Skill;
use App\Background;
use Illuminate\Support\Facades\Auth;


class ProfielController extends Controller
{

    public function index(){

        $user = Auth::user();
    
        return view('users.user_edit', ['user' => $user,]);
    }

    public function store(Request $request){

        if( $request->has('post') ){

            $user = Auth::user();
            $form = $request->all();
            $user->self_introduction = $request->self_introduction;
            $user->fill($form)->save();
    
            return redirect('/')->with('flash_message', 'プロフィール情報を更新しました');
        }

        $request->flash();
        return $this->index();
        
    }



    public function update(Request $request)
    {

        return redirect()->route('users.show');
    }
}
