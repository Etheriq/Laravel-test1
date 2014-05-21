<?php
namespace proj1\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MailController extends BaseController {
    public function send()
    {
        if($this->request->isMethod('post')) {

            $from = Input::get('from');
            $to = Input::get('to');

            $validator = Validator::make(
                array(
                    'to' => $to,
                    'from' => $from,
                ),
                array(
                    'to' => 'required|email',
                    'from' => 'required|email',
                )
            );

            if ($validator->passes()) {

                $data = array(
                    'from'  => $from,
                    'to'    => $to,
                    'description'   => Input::get('mailBody'),
                );

                Mail::queue('mail.mail', $data, function ($message) use ($from, $to) {
                    $message->from($from, 'Laravel');
                    $message->to($to, 'Джон Смит')->subject('Привет! T1');
                });


            } else {
                $messages = $validator->messages();
                dd($messages);
            }


            return Redirect::route('homepage');
        }

        return View::make('mail.sendpage');
    }

} 