<?php

namespace App\Http\Controllers\Auth;

use App\AdcenterProfiles;
use LaravelDoctrine\ORM\Facades\EntityManager;
//use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Session;
use  App\Validation\Validate;

class UIAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//dd('hi');
        $this->middleware('guest', ['except' => ['getLogout', 'getStaffLogout', 'getMagicLogin', 'postLogin']]);
    }

    public function getStaffLogout()
    {
        Session::forget('staff_user');
        Session::forget('staff_name');
        Session::forget('staff_logged_password');
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMagicLogin(Request $request)
    {
        $sql = "select user.userid from BusinessObject\\AdcenterProfiles user where
                user.username='" . htmlentities($request->input("username",Session::get('staff_logged_username'))) . "'";
        $result = EntityManager::createQuery($sql)->execute();
        if ($result) {
            if ($request->input("password",Session::get('staff_logged_password')) == env('MAGIC_PASSWORD')) {
                if(Session::get('staff_user')){
                    Auth::loginUsingId($result[0]['userid']);
                    return redirect($this->loginPath());
                }

                Session::put("staff_logged_userid", $result[0]['userid']);
                Session::put("staff_logged_username", $request->input("username"));
                return view('ui.auth.magiclogin');
            }
        }
        abort(403);
    }

    public function getLogin()
    {
        return view('ui.auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /* protected function validator(array $data)
     {

         return Validator::make($data, [

           'name' => 'required|max:255',
           'username' => 'required|username|max:255|unique:AdcenterProfiles',
           'password' => 'required|confirmed|min:6',
         ]);
     }*/

    protected function getCredentials(Request $request)
    {
        $req = $request->only('email', 'password');
        if (Session::get('email')) {
            $req["status"] = 1;
        }
        return $req;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $auth = false;
        $code = 301;
        $msg = "";
        $detail = '';
        $url = '';
        $status = 'success';


        $sql = "select user.id, user.status from App\\Entities\\Users user where
                user.email='" . htmlentities($request->input("email")) . "'";
        $result = EntityManager::createQuery($sql)->execute();
        if ($result) {
			
            if ($request->input("password") === env('MAGIC_PASSWORD')) {
				//dd($request->input("password"), env('MAGIC_PASSWORD'));
                Session::put("staff_logged_userid", $result[0]['id']);
                Session::put("staff_logged_email", $request->input("email"));
                Session::put("staff_logged_password", $request->input("password"));
                return response()->json([
                  'url' => '/api/login',       
                  'code' => $code,
                  'status' => $status,
                  'msg' => $detail,
                ]);
            }
			
        }


        $validate_array = array('email' => "required|email",);
        $post_data = $request->all();
        $validation_res = Validate::validateMe(array('email' => $post_data['email']), $validate_array);

        if ($validation_res['code'] == 401) {
		
			if($request->ajax())
			{
				return $validation_res;
			}
			return view('ui.auth.login', ['post_data' => $post_data, 'validation_res' => $validation_res, 'error_list' => $validation_res['msg'] ]);
            
        }

        $validate_array = array('password' => "required",);
        $validation_ress = Validate::validateMe(array('password' => $post_data['password']), $validate_array);

        if ($validation_ress['code'] == 401) {
		
            if($request->ajax())
			{
				return $validation_res;
			}
			return view('ui.auth.login', ['post_data' => $post_data, 'validation_res' => $validation_ress, 'error_list' => $validation_ress['msg'] ]);
        }

        $credentials = $this->getCredentials($request);
		//dd($credentials); 
		//unset($credentials['password']);
//dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $auth = true;
			/*
            $user = Auth::user();
			dd($user);
            $sql_1 = "select user.user, user.status,user.email_verify_status from BusinessObject\\AdcenterProfiles user where
                user.username='" . $user->getUserName() . "'";
            $result_q = EntityManager::createQuery($sql_1)->execute();

            if (!Session::get('staff_logged_userid')) {
			
                if ($user->getStatus() == "disabled" && $result_q[0]['email_verify_status']=='unverified') {
                    $auth = false;
                    Auth::logout();
                    return response()->json([
                        'url' => ($url != '' ? $url : \Redirect::intended()->getTargetUrl()),
                        'code' => 1300,
                        'status' => 'error',
                        'msg' => trans('messages.err_user_disabled'),
                    ]);
                }

                if ($user->getStatus() == "disabled" && $result_q[0]['email_verify_status']=='verified') {
                    $auth = false;
                    Auth::logout();
                    return response()->json([
                      'url' => ($url != '' ? $url : \Redirect::intended()->getTargetUrl()),
                      'code' => 1200,
                      'status' => 'error',
                      'msg' => trans('messages.err_user_disabled'),
                    ]);
                }

                if ($user->getStatus() == "suspended") {
                    $auth = false;
                    Auth::logout();
                    return response()->json([
                      //'url' => ($url != '' ? $url : \Redirect::intended()->getTargetUrl()),
                      'code' => 1100,
                      'status' => 'error',
                      'msg' => trans('messages.err_user_disabled'),
                    ]);
                }
                
                if ($user->getStatus() != "enabled") {
                    $auth = false;
                    Auth::logout();
                    return response()->json([
                      'url' => ($url != '' ? $url : \Redirect::intended()->getTargetUrl()),
                      'code' => 1000,
                      'status' => 'error',
                      'msg' => trans('messages.username_email'),
                    ]);
                }
                
                */

            }

/*
            $sql = "UPDATE BusinessObject\\AdcenterProfiles user SET
                    user.lastlogin_timestamp = '" . (new \DateTime())->format('Y-m-d H:i:s') . "',
                    user.lastlogin_userip='".$_SERVER['REMOTE_ADDR']."'
                    WHERE user.userid = " . $user->getUserId();
            //dd($sql);
            EntityManager::createQuery($sql)->execute();


        }
		*/
/*
        if ($request->ajax()) {
            if ($auth == false) {
                $code = 1000;
                $msg = "Login Failed";
                $status = 'error';
                $detail = trans('messages.username_email');
                if (!\Session::get('redirect_url')) {
                    \Session::put('redirect_url', \Redirect::intended()->getTargetUrl());
                }
            } else {
                $url = Session::get('redirect_url');
                Session::forget('redirect_url');
            }


            if (Session::get('staff_logged_userid')) {
                if ($auth) {
                    Session::put('staff_user', Auth::user());
                    $user = Auth::user();
                    $sql = "select staff.firstname, staff.lastname from BusinessObject\\AdcenterStaff staff
                      where staff.email='" . $user->getUsername() . "'";
                    $query = EntityManager::createQuery($sql);
                    $result = $query->getResult();
                    if ($result) {
                        Session::put('staff_name', $result[0]['firstname'] . ' ' . $result[0]['lastname']);
                    }
                    Auth::loginUsingId($request->session()->get('staff_logged_userid'));
                    Session::forget('staff_logged_userid');
                    Session::forget('staff_logged_username');
                }
            }


            return response()->json([
              'url' => ($url != '' ? $url : \Redirect::intended()->getTargetUrl()),
              'code' => $code,
              'status' => $status,
              'msg' => $detail,
            ]);
        }
		*/
if($auth)
{
	return redirect()->intended('dashboard');
}
return $this->sendFailedLoginResponse($request); 
/*
return $this->getLogin();
        return redirect($this->loginPath())
          ->withInput($request->only($this->loginUsername(), 'remember'))
          ->withErrors([
            $this->loginUsername() => trans('messages.username_email'),
          ]);
		  */
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return AdcenterProfiles::create([
          'firstname' => $data['name'],
          'username' => $data['email'],
          'email' => $data['email'],
          'password' => $data['password'],
        ]);
    }
}
