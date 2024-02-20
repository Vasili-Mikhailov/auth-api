<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use App\Http\Requests\UserAuthRequest;


class UserController extends Controller
{
    /**
     * User authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticateUser(UserAuthRequest $request){
        
        $userData = $request->validated();
        
        ksort($userData);
        $sig = $userData['sig'];
        unset($userData['sig']);

        $str = implode("", array_map(
                function($k, $v){ 
                    return $k . '=' . $v;
                }, 
                array_keys($userData), 
                array_values($userData)
            ));
        $str .= env("APP_SECRET_KEY");

        $result = [];

        if (mb_strtolower( md5($str), 'UTF-8' ) === $sig){
            $userInfo = User::createOrUpdateUser($userData);
            $session = UserSession::createOrUpdateUserSession($userData);

            $result = [
                "access_token" => $session->access_token,
                "user_info" => $userInfo,
                "error" => "",
                "error_key" => "",
            ];
        } else {
            $result = [
                'error' => 'Ошибка авторизации в приложении',
                'error_key' => 'signature error',
            ];
        }

        return response()->json([$result]);
    }
}
