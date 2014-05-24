<?php
namespace proj1\Controllers;

use Illuminate\Http\Response;

class ApiController extends BaseController {

    public function ttt() {


        $data = array(
            'zxc' => 'zxcvbnm',
            'timestamp' => new \DateTime('now'),
        );


        return Response::create('z22z', 200, $data);
    }
}