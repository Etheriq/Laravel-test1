<?php
namespace proj1\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Sentry\Users\LoginRequiredException as LoginRequired;
use Cartalyst\Sentry\Users\PasswordRequiredException as PasswordRequired;
use Cartalyst\Sentry\Users\WrongPasswordException as WrongPass;
use Cartalyst\Sentry\Users\UserNotFoundException as UserNotFound;
use Cartalyst\Sentry\Users\UserNotActivatedException as UserNotActivated;
use Cartalyst\Sentry\Throttling\UserSuspendedException as UserSuspended;
use Cartalyst\Sentry\Throttling\UserBannedException as UserBanned;
use Cartalyst\Sentry\Users\UserExistsException as UserExist;
use Cartalyst\Sentry\Users\UserAlreadyActivatedException as UserAlreadyActivated;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController {

    public function login()
    {
        if ($this->request->isMethod('post')) {
            try
            {
                // Login credentials
                $credentials = array(
                    'username' => Input::get('username'),
                    'password' => Input::get('password'),
                );

                // Authenticate the user
                $user = Sentry::authenticate($credentials, false);

                return Redirect::route('homepage');
            }
            catch (LoginRequired $e)
            {
                echo 'Login field is required.';
            }
            catch (PasswordRequired $e)
            {
                echo 'Password field is required.';
            }
            catch (WrongPass $e)
            {
                echo 'Wrong password, try again.';
            }
            catch (UserNotFound $e)
            {
                echo 'User was not found.';
            }
            catch (UserNotActivated $e)
            {
                echo 'User is not activated.';
            }

// The following is only required if the throttling is enabled
            catch (UserSuspended $e)
            {
                echo 'User is suspended.';
            }
            catch (UserBanned $e)
            {
                echo 'User is banned.';
            }
        }


        return View::make('security.login');
    }

    public function register() {

        if ($this->request->isMethod('post')) {

            if (Input::get('password') != Input::get('password_confirmation')) {
                Session::flash('error', 'password is not confirmed');
                return Redirect::route('register');
            }

            $validator = Validator::make(
                array(
                    'username' => Input::get('username'),
                    'password_confirmation' => Input::get('password_confirmation'),
                    'password' => Input::get('password'),
                    'email' => Input::get('email'),
                ),
                array(
                    'username' => 'required|min:3',
                    'password_confirmation' => 'required',
                    'password' => 'required|confirmed',
                    'email' => 'required|email',
                )
            );

            if($validator->fails()) {
                Session::flash('error', 'dd');
                return Redirect::route('register');
            }

            try
            {
                // Let's register a user.
                $user = Sentry::register(array(
                    'email'    => Input::get('email'),
                    'username'    => Input::get('username'),
                    'password' => Input::get('password'),
                ));

                // Let's get the activation code
                $activationCode = $user->getActivationCode();

                $url = URL::route('activation');

                $data = array(
                    'from'  => 'Yuriy',
                    'to'    => $user->email,
//                    'activationCode'    => $url,
                    'activationCode'    => $url.'?user='.$user->id.'&code='.$activationCode
                );

                Mail::queue('mail.activation', $data, function ($message) {
                    $message->from('zz@zz.ry', 'Laravel');
                    $message->to('escawork@mail.ru', 'Джон Смит')->subject('Привет! Activation');
                });


            }
            catch (LoginRequired $e)
            {
                echo 'Login field is required.';
            }
            catch (PasswordRequired $e)
            {
                echo 'Password field is required.';
            }
            catch (UserExist $e)
            {
                echo 'User with this login already exists.';
            }

            Session::flash('info', 'На ваш e-mail был выслан код активации');
            return Redirect::route('homepage');
        }

        return View::make('security.register');
    }

    public function activation() {

        if (Input::has('user') and Input::has('code')) {
            $userId = Input::get('user');
            $code = Input::get('code');
                try
                {
                    // Find the user using the user id
                    $user = Sentry::findUserById($userId);

                    // Attempt to activate the user
                    if ($user->attemptActivation($code))
                    {
                        // User activation passed
                        Session::flash('info', 'Пользователь успешно активирован. Теперь вы можете им войти');
                        return Redirect::route('homepage');
                    }
                    else
                    {
                        // User activation failed
                        Session::flash('info', 'Ошибка активации');
                        return Redirect::route('homepage');
                    }
                }
                catch (UserNotFound $e)
                {
                    echo 'User was not found.';
                }
                catch (UserAlreadyActivated $e)
                {
                    echo 'User is already activated.';
                }
        }
    }

}
