<?php
static::$title = 'Serviços';

use kanda\widgets\FormWidget;
use kanda\helpers\Url;
use kanda\helpers\Session;
?>
<div class="module">
    <div class="module-head">
        <h3><?php echo static::$title ?></h3>
        <a href="<?php echo Url::prev() ?>" class="btn btn-small btn-warning param">voltar</a>
    </div>
    <div class="module-body">

        <br>
        <form method="POST" name=" " id="Validade" action="<?php echo Url::request() ?>" class="form-horizontal row-fluid" enctype="multipart/form-data" >
            <fieldset>
                <?php
                $form = FormWidget::widget($model, [ 'style' => "\help\Style",]);

                echo $form->text('nome');
                echo $form->textarea('descricao');
                 
           
                ?>
                <div class="form-actions">
                    <button class="btn btn-success" type="submit">Enviar</button>
                </div>

            </fieldset>
        </form> 
        <?php
        echo Session::getflash('update');
        ?>       
    </div>
</div>