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
        // Verificamos si hay sesi�n activa
        if (Auth::check())
        {
            // Si tenemos sesi�n activa mostrar� la p�gina de inicio
            return Redirect::to('/');
        }
        // Si no hay sesi�n activa mostramos el formulario
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
        if (Auth::attempt($data,$remember)) // Como segundo par�metro pas�mos el checkbox para sabes si queremos recordar la contrase�a
        {
            // Si nuestros datos son correctos mostramos la p�gina de inicio
            return Redirect::intended('/');
        }
        
        // Si los datos no son los correctos volvemos al login y mostramos un error
        return Redirect::back()->with('error_message', 'Usuario o Contrase�a no validos')->withInput();
    }
    
    public function logOut()
    {
        // Cerramos la sesi�n
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerr� la sesi�n
        return Redirect::to('seguridad/login')->with('error_message', 'Logged out correctly');
    }
}
