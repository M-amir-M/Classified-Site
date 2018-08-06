<?php
/**
 * Created by PhpStorm.
 * User: M.amir.M
 * Date: 07/12/2016
 * Time: 01:54 PM
 */

namespace App\Mailers;


use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
    protected $from = 'active@unisaleman.com';
    protected $to ;
    protected $view ;
    protected $data = [] ;
    protected $mailer ;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailConfigrationTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.confirm';
        $this->data = compact('user');

        $this->deliver();
        auth()->logout();
    }

    public function deliver()
    {
        $this->mailer->send($this->view,$this->data,function($message){
            $message->from($this->from , 'unisaleman یونی سیل من');
            $message->to($this->to)->subject('لطفا حساب کاربری خود را تایید کنید.');
        });
    }

}