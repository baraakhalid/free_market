<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class Authcontroller extends Controller
{
    public function showLoginView(Request $request)
    {
   
            $validator = Validator(
            ['guard' => $request->guard],
            ['guard' => 'required|string|in:admin,user,vendor']
        );
        if (!$validator->fails()) {
            session()->put('guard', $request->guard);
            return response()->view('cms.auth.login',['guard'=>$request->guard]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }       
    }

public function login(Request $request)
{
    $validator = Validator($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:3',
        'remember' => 'required|boolean',
    ]);

    if (!$validator->fails()) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::guard(session()->get('guard'))->attempt($credentials, $request->input('remember'))) {
            return response()->json(['message' => 'Logged in successfully']);
        } else {
            return response()->json(['message' => 'Login failed, check credentials'], Response::HTTP_BAD_REQUEST);
        }
    } else {
        return response()->json(
            ['message' => $validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST
        );
    }
}
public function editPassword(Request $request)
{
    return response()->view('cms.auth.edit-password');
}

public function updatePassword(Request $request)
{
    $guard = auth('admin')->check() ? 'admin' : 'vendor';
    $validator = Validator($request->all(), [
        'password' => 'required|current_password:' . $guard,
        'new_password' => [
            'required', 'confirmed',
            Password::min(8)
                ->symbols()
                ->letters()
                ->mixedCase()
                ->numbers()
                ->uncompromised(),
        ],
    ]);

    if (!$validator->fails()) {
      
        $user = $request->user();
        $user->forceFill([
            'password' => Hash::make($request->input('new_password')),
        ]);
        $isSaved = $user->save();
        return response()->json(
            ['message' => $isSaved ? 'Password changed successfully' : 'Failed to change password!'],
            $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    } else {
        return response()->json(
            ['message' => $validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST
        );
    }
}



public function logout(Request $request)
{
    $guard = session('guard');
    Auth::guard($guard)->logout();
    $request->session()->invalidate();
    return redirect()->route('cms.login', $guard);
}
  
}


