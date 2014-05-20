<?php
namespace proj1\Controllers;

use proj1\Controllers\BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

class UserController extends BaseController {

    public function login()
    {
        if ($this->request->isMethod('post')) {

            $name = Input::get('username');
            $pass = Input::get('password');

            echo($name);
            echo($pass);

            exit;
        }


        return View::make('security.login');
    }
}
