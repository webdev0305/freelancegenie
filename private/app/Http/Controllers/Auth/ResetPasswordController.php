<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ValidationRequest;
use View;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
         try {

            $data = $request->input();
            $validation = \Validator::make($data, ValidationRequest::$pass_reset);

            if ($validation->fails()) {
                $errors = $validation->messages();
                return Redirect::back()->with('errors', $errors);
            }

            //Get and check user data by email
            $userData = User::GetUserByMail( $data['email']);

//Check Email Exit
            if (empty($userData) && $userData == '') {
                Session::flash('error',  Config::get('message.options.INLAVID_MAIL'));
                return Redirect::back();
            }
            $user_sentinal = \Sentinel::findById($userData->id);
            if ($reminder = \Reminder::exists($user_sentinal)) {

                if ($data['token'] == $reminder->code) {
                    $user = \Sentinel::findById($user_sentinal->id);
                    if ($reminder = \Reminder::complete($user, $data['token'], $data['password'])) {
                        Session::flash('success',  Config::get('message.options.PAS_RESET'));
                        return Redirect::to('/login');
                    } else {

                        Session::flash('error',  Config::get('message.options.LINK_USED'));
                        return Redirect::to('/');
                    }
                } else {
                    Session::flash('error',  Config::get('message.options.LINK_USED'));
                    return Redirect::to('/');
                }
            } else {
                Session::flash('error',  Config::get('message.options.LINK_USED'));
                return Redirect::to('/');
            }
        } catch (Exception $ex) {
            return View::make('errors.exception')->with('Message', $ex->getMessage());
        }
    }


    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }
}
