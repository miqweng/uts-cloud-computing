<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function index() {
        return view('admin.auth.index');
    }

    function login(Request $request) {
        try {
            $formdata = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if(Auth::attempt($formdata)){
                return $this->success('Login successfully !', 'admin.dashboard.index');
            }
            return $this->error('Found Error : email or password not regitered!');
        } catch (\Throwable $th) {
            return $this->error('Found error :' . ' ' . $th->getMessage());
        } catch (\Exception $th) {
            return $this->error('Found error :' . ' ' . $th->getMessage());
        }
    }

    function logout()
    {
        try {
            Auth::logout();
            return $this->success('Logout successfully !', 'auth.index');
        } catch (\Throwable $th) {
            return $this->error('Found error :' . ' ' . $th->getMessage());
        } catch (\Exception $th) {
            return $this->error('Found error :' . ' ' . $th->getMessage());
        }
    }
}
