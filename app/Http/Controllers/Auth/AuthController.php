<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\BaseController as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $response= [
                'user' => $auth,
                'token'=> $success
            ];
            return response($response, 200);
        }
        else{
            return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',

        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create([
            'gender' => $input['gender'],
            'firstname' => $input['firstName'],
            'lastname' => $input['lastName'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
        Mail::send('emails', [], function($message) {
            $message->to($input['email'], $input['firstName'])->subject('Artisans Web Testing Mail');
            $message->from(config('mail.from.adress'),'Artisans Web');
        });
        return $this->handleResponse($success, 'User successfully registered!');
    }

}
