<?php
/**
 * Created by PhpStorm.
 * User: M.amir.M
 * Date: 14/07/2016
 * Time: 09:14 PM
 */

namespace App\Http;


class Flash
{
    public function create($title, $message,$level,$key='flash_message')
    {
        session()->flash($key, [
            'title' => $title,
            'message' => $message,
            'level' => $level
        ]);
    }

    public function info($title, $message)
    {
        return $this->create($title, $message,'info');
    }

    public function success($title, $message)
    {
        return $this->create($title, $message,'success');
    }

    public function warning($title, $message)
    {
        return $this->create($title, $message,'warning');
    }

    public function error($title, $message)
    {
        return $this->create($title, $message,'error');
    }

    public function overlay($title, $message,$level='success')
    {
        return $this->create($title, $message,$level,'flash_message_overlay');
    }
}