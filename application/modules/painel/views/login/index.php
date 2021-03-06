<?php

static::$title = 'Admin Adoremos';

use kanda\widgets\FormWidget;
use kanda\helpers\Url;
use kanda\helpers\Session;
?>

<div class="row">
    <div class="module module-login span4 offset4">

        <form  id="FormWidget" action="<?php echo Url::request() ?>" method="POST" class="form-vertical">
            <?php
            $form = FormWidget::begin($model,[]);
            ?>
            <div class="module-head">
                <h3>Login</h3>
            </div>
            <div class="module-body">
                <div class="control-group">
                    <div class="controls row-fluid">
                        <input type="text" placeholder="Login" name="Usuario[login]" id="inputEmail" class="span12">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls row-fluid">
                        <input type="password" placeholder="Senha" name="Usuario[senha]" id="inputPassword" class="span12">
                    </div>
                </div>
            </div>
            <div class="module-foot">
                <div class="control-group">
                    <div class="controls clearfix">
                        <button type="submit" class="btn btn-primary pull-right">Login</button>
                        <label class="checkbox"></label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
 <?php
        echo Session::getflash('error');
 