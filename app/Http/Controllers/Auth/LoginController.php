<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request) {
        $route = 'user.index';
        $message = 'Вы успешно вошли в личный кабинет';
        if(!Auth::attempt($request->only('email','password'))) {
            throw ValidationException::withMessages([
                'email' => 'These credential don\'t match our records'
            ]);
        }
        $user = Auth::user();
        if ($user->admin) {
            $route = 'admin.index';
            $message = 'Вы успешно вошли в панель управления';
        }
        return redirect()->route($route)
            ->with('success', $message);
    }

    /**
     * Сразу после выхода выполняем редирект и устанавливаем flash-сообщение
     */
    protected function loggedOut(Request $request) {
        return redirect()->route('user.login')
            ->with('success', 'Вы успешно вышли из личного кабинета');
    }
}
