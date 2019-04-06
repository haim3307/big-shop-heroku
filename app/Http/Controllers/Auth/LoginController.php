<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\SigninRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Socialite,Auth;
class LoginController extends MainController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait\
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as protected traitLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->redirectTo = \URL::previous();
        $this->middleware('guest', ['except' => 'logout']);
    }
    /*public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/
    public function showLoginForm()
    {
        self::setTitle('Login');
        return view('auth.login',self::$data);
    }
    public function login(SigninRequest $request)
    {
        if ($user = $this->attemptLogin($request)) {
            Session::put('user',auth()->user());
            return $this->sendLoginResponse($request);

        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        if ($this->authenticated($request, $this->guard()->user())){
            return redirect()->route('cms.home');
        }else if ($request->has('rt') && !empty($request->rt)){
            return redirect($request->rt);
        }else{
            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return $user->allowedCMS();
    }
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request)
    {
        if($request->rt) Session::put('rt',$request->rt);
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        try{
            $user = Socialite::driver('facebook')->user();
        }catch (\Exception $e){
            return redirect('login/facebook');
        }
        $findUser = User::where('email',$user->email)->first();
        if($findUser){
            $authUser = $findUser;
        }else{
            $authUser = new User([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt('123456'),
            ]);
            $authUser->save();
        }
        Auth::login($authUser);
        Session::put('user',auth()->user());
        if ($this->authenticated($request, $this->guard()->user())){
            return redirect()->route('cms.home');
        }else if (Session::has('rt') && !empty(Session::get('rt'))){
            Session::flash('scrollToId',1);
            return redirect(Session::get('rt'));
        }else{
            return redirect()->intended($this->redirectPath());
        }
    }
}
