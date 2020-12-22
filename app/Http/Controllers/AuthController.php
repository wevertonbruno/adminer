<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check())
            return view('dashboard');
        //else
            return redirect()->route('app.login');
    }

    public function login()
    {
        if(Auth::check())
            return redirect()->route('app.dashboard');
            
        return view('login');
    }

    public function authenticate(Request $request)
    {
        //dd($request->all());
        
        //credencial do usuário
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if(Auth::attempt($credentials))
            return redirect()->route('app.dashboard');

        return redirect()->back()->withInput()->withErrors(["Os dados informados não conferem!"]);

    }

    public function register()
    {
        if(!Auth::check())
            return view('register');
    }

    public function create(Request $request)
    {
        if(Auth::check())
            return redirect()->route('app.dashboard');

        //validation
        $data = $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:16',
        ]);

        //criptografando senha
        $data['password'] = bcrypt($data['password']);
        
        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];

        if($user->save())
            return redirect()->route('app.login')->withInput()->with('success', 'Registrado com sucesso!');

        return redirect()->back()->withInput()->withErrors(["Ocorreu um erro no registro. Por favor, tente novamente!"]);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('app.login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {   
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate([ 'email' => $providerUser->getEmail() ],[
            'name' => $providerUser->getName() ?? $providerUser->getNickName(),
            'provider_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        Auth::login($user);

        return redirect()->route('app.dashboard');

    }

    public function forgotPassword(){
        return view('forgotPassword');
    }

    public function forgotPasswordDo(Request $request) 
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function redefinePassword($token){
        return view('redefinePassword', compact('token'));
    }

    public function handleRedefinePassword(Request $request) 
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
    
                $user->setRememberToken(Str::random(60));
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('app.login')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
