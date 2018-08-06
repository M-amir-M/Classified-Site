<?php
/**
 * Created by PhpStorm.
 * User: M.amir.M
 * Date: 20/07/2016
 * Time: 06:33 PM
 */

namespace App\Http\Controllers\Traits;


use App\Banner;
use Illuminate\Http\Request;

trait AuthorizesUsers
{

    protected function userCreatedBanner($request)
    {
        return Banner::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => auth()->user()->id
        ])->exists();
    }

    protected function unAuthorized(Request $request)
    {
        if ($request->ajax() | $request->wantsJson()) {
            return response(['message' => 'اوخ!'], 403);
        }
        flash()->errore('اوخ! اجازه ندارید.');
        return back();
    }
}