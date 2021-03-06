<?php

namespace app\modules\painel\controllers;


use \kanda\web\Controller;

use app\modules\painel\models\Usuario;
use kanda\helpers\Session;
use kanda\helpers\Url;
use app\help\User;

class DefaultController extends Controller {

    public function behaviors() {
        return [
            'getClass' => User::rule(),
        ];
    }

    public function actionIndex() {

    	 $model = new Usuario;
 
        if (empty(Session::getSession()->nome)) {

            Session::setSession([
                    'token' => md5(date('d')),
            ]); 

           return $this->redirect(
            [
                'painel/login',
                'token'=> Session::getSession()->token,
            ]);

        } else {
  
            return $this->render('index', [
                        'usuario' => $model->count(),
            ]);
        }

    }
    

}