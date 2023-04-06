<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends Controller
{

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

    /**
     * Сразу после входа выполняем редирект и устанавливаем flash-сообщение
     */
    protected function authenticated(Request $request, $user) {
        $route = 'user.index';
        $message = 'Вы успешно вошли в личный кабинет';
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
