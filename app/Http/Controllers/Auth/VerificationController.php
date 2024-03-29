<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        //设定了所有的控制器动作都需要登录后才能访问
        $this->middleware('auth');
        //设定只有verify动作使用signed中间件进行认证
        $this->middleware('signed')->only('verify');
        //对verify和resend动作做了访问频率限制， 限制1分钟不超过6次
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
