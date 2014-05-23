<?php
namespace proj1\facades;

use Illuminate\Support\Facades\Request;
use proj1\Controllers\BaseController;

class ApiAuth extends BaseController {

    public function check() {




        $de = array('xx-auth-api' => 'gdsfggfgdfgdhfghdjfkhgkdhfGFDGdgdfgGDdfdg4');



        if ($this->request->headers->has('xx-auth-api')) {
            $qq = 'yes';
        } else {
            $qq = 'no';
        }

        echo($qq);

        echo('Hello from ApiAuth Facade method check() !!!  <br/>');
    }

} 