<?php
namespace proj1\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException as LoginRequired;
use Cartalyst\Sentry\Users\PasswordRequiredException as PasswordRequired;
use Cartalyst\Sentry\Users\WrongPasswordException as WrongPass;
use Cartalyst\Sentry\Users\UserNotFoundException as UserNotFound;
use Cartalyst\Sentry\Users\UserNotActivatedException as UserNotActivated;
use Cartalyst\Sentry\Throttling\UserSuspendedException as UserSuspended;
use Cartalyst\Sentry\Throttling\UserBannedException as UserBanned;
use Illuminate\Support\Facades\Redirect;

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
}
