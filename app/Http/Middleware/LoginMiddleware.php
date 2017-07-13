<?php
namespace abisa\Http\Middleware;
use Closure;
use Artisan;
use Validator;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next){
        session_name("abisa");
        session_start();

        return $next($request);
        /*
        if(isset($_SESSION['idUser']) &&  isset($_SESSION['passwd'])){

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            session()->put('id_usuario', $_SESSION['idUser']);
            session()->put('nombre',     $_SESSION['name']);
            session()->put('usuario',    $_SESSION['user']);
            session()->put('password',   $_SESSION['passwd']);

            // $validator = Validator::make($request->all(), [
            //     'title' => 'required|unique:posts|max:255',
            //     'body' => 'required',
            // ]);

            // return redirect('post/create')
            //             ->withErrors($validator)
            //             ->withInput();

           //echo "asdasdas";
           //exit(0);
            //print_r(get_object_vars($request)); exit();
            return $next($request);
            //return get_object_vars($request);
        }
        else{
            session()->flush();
            return redirect('/'); //->action('/');
        }
        */
      }
}
