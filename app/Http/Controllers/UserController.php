<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function detail()
    {
    	$user = Auth::user();
    	return response()->json($user);
    }

    public function update(Request $request)
    {
        $old_password = '';
        $new_password = '';
    	$user = User::find($request->id);

        if($request->old_password != null && $request->email == $user->email)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'new_password' => ['required', 'string', 'min:6'],
                'confirm_password' => ['required', 'string', 'min:6'],
            ]);
        }
        else
        {
            if($request->email != Auth::user()->email)
            {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
            else
            {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);
            }
        }

    	if($request->name != $user->name)
    	{
    		$user->name = $request->name;
    	}

    	if($request->email != $user->email)
    	{
    		$user->email = $request->email;
    	}

    	if($request->file('picture') != null)
    	{
    		$request->validate(['picture' => 'required|mimes:jpeg,jpg,png',]);
    		$path =$request->file('picture')->storeAs('UserDP', $request->file('picture')->getClientOriginalName());
    		echo $path;
    		$user->profile_pic = $path;
    	}

    	if($request->old_password != null)
    	{
            if(Hash::check($request->old_password, $user->password))
            {
                $old_password = 'matched';
        		if($request->new_password == $request->confirm_password)
        		{
                    $new_password = 'matched';
        			$user->password = Hash::make($request->new_password);
        		}
                else
                {
                    return response()->json(['new_password' => 'not matched']);
                }
            }
            else
            {
                return response()->json(['old_password' => 'not matched']);
            }
    	}

    	$user->save();
        return response()->json(['old_password' => $old_password, 'new_password' => $new_password, 'status' => 'updated']);
    }
}
