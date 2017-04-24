<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\ORM\Facades\EntityManager;


class AuthenticateUI
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	//dd('in authenticateUi.php');
	//print "in authenticateUi.php<br>";
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                //return response('Unauthorized.', 401);
                return [
                    'code'=>301,
                    'status'=>'error',
                    'msg'=>'Unauthorized',
                    'url'=>'/login'
                ];
            } else {
                return redirect()->guest('/login');
            }
        }
/*
        if (!\Session::get('staff_name')) {
            $sql = "UPDATE BusinessObject\\AdcenterProfiles p set p.last_screen_action_timestamp= CURRENT_TIMESTAMP()
                , p.last_screen_action = '" . $request->route()->getUri() . "'
                where p.userid = " . \Auth::user()->getid();
            $query = EntityManager::createQuery($sql);
            $query->execute();
        }
*/
//        $inputs=\Input::get();
//        $sanitized=$this->sanitizer->sanitize(['*' => 'strip_tags|trim'], $inputs);
//
//        \Input::merge($sanitized);

        return $next($request);
    }
}
