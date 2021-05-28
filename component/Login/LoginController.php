<?php

namespace Neoan3\Component\Login;

use Neoan3\Core\Unicore;
use Neoan3\Frame\Demo;
use Neoan3\Model\User\UserModel;

/**
 * Class LoginController
 * @package Neoan3\Component\Login
 *
 * Generated by neoan3-cli for neoan3 v3.*
 */

class LoginController extends Demo {
    /**
     * Route: Login
     */
    function init(): void
    {
        $this
            ->hook('main', 'login')
            ->renderer->includeJs(base . '/component/Login/login.ctrl.js')
            ->output();
    }

    /**
     * @throws \Neoan3\Core\RouteException
     */
    function postLogin($body=[])
    {
        $this->loadModel(UserModel::class);
        if(isset($register)){
            $user = UserModel::register($body);
        } else {
            $user = UserModel::login($body);
        }
        $auth = $this->Auth->assign($user['id'],['all'], $user);
        return [
            'token'=> $auth->getToken(),
            'user'=> $user
        ];
    }
    function getLogin()
    {
        return ['any'=>'thing'];
    }

}