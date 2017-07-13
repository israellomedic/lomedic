<?php
namespace abisa\Http\Controllers\Seguridad;
use Auth;
use Request;
use Redirect;

use abisa\Http\Requests;
use abisa\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLogin()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('/');
        }
        // Si no hay sesión activa mostramos el formulario
        return View('Seguridad.login');
    }
    
    public function postLogin()
    {
        // Obtenemos los datos del formulario
        $data = [
            'usuario' => Request::get('usuario'),
            'password' => Request::get('password'),
            'estatus' => 1
        ];
        $remember = Request::get('remember'); //Request::get('remember');
        
        // Verificamos los datos
        if (Auth::attempt($data,$remember)) // Como segundo parámetro pasámos el checkbox para sabes si queremos recordar la contraseña
        {
            // Si nuestros datos son correctos mostramos la página de inicio
            return Redirect::intended('/');
        }
        
        // Si los datos no son los correctos volvemos al login y mostramos un error
        return Redirect::back()->with('error_message', 'Usuario o Contraseña no validos')->withInput();
    }
    
    public function logOut()
    {
        // Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('seguridad/login')->with('error_message', 'Logged out correctly');
    }
}
