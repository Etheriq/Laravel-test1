<?php
namespace proj1\Controllers\Uzer;

use proj1\Controllers\Base\BaseController;

class UserController extends BaseController {

    public function login()
    {
        if ($this->request->isMethod('post')) {
            echo('qqq');

            exit;
        }


        return View::make('security.login');
    }
}
