<?php
namespace proj1\facades;

use Illuminate\Support\Facades\Request;
use proj1\Controllers\ApiController;
use proj1\Controllers\BaseController;
use Illuminate\Http\Response;

class ApiAuth {

    public function check($route, $request) {


        $ze = $request->headers->has('xx-auth-api');
        $ze = $request->headers->get('xx-auth-api');

        $tt =  $request->headers->get('timestamp');

//        $ze = array_fetch($ze, 'xx-auth-api');

        var_dump($tt);
//        dd($request->headers->headers['xx-auth-api'][0]);

//        if ($this->request->headers->has('xx-auth-api')) {
//            $qq = 'yes';
//        } else {
//            $qq = 'no';
//        }


//           $tt = new ApiController();


//        $data = array(
//            'zxc' => 'zxcvbnm',
//        );
//
//
//        return Response::create('zz', 200, $data);

    }

} 