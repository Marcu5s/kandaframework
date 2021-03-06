<?php
/**
 * @copyright (c) KandaFramework
 * @access public
 * 
 * 
 */
namespace app\modules\painel\controllers;

use help\User;
use kanda\helpers\UploadFile;
use kanda\helpers\Json;
use wideImage\WideImage;
use app\modules\painel\models\Banner;


class BannerController extends \kanda\web\Controller {
 

  public function behaviors() {
    return [
    'getClass' => User::rule(),
    ];
  }

  public function actionIndex() {

    $model = new Banner();
   
    return $this->render('index',[
      'model'=> $model,
      'assets'=> '/tmp/',
      ]);
  }

  public function actionFileUpload(){

   $model = new Banner();

   sleep(4);

   
   exit;

   $file =  UploadFile::load($model,'file');

   $model->name = $file->name;
   $model->size = $file->size;
   $model->type = $file->type;

   $filename = static::getPath().$file->name;

   $image = WideImage::load($file->tmpName)
   ->resize(940,426)
   ->saveToFile($filename); 

   $model->save();

  echo Json::encode([
         'files'=>
         [
            'file'=>[
                  'src' => '/tmp/'.$file->name,
                  'id'  => $model->id,
              ] 
         ]
    ]);
    exit;

 }

  static function getPath(){
    return WWW_ROOT.'/public/tmp/';
  }

 public function actionUpdate($id){

  return $this->render('form', ['model' => $this->findModel($id)]);

}
public function actionDelete($id) {

  if(isset($id) && !empty($id)){
    $model =  $this->findModel($id);

    $name = $model->name;

    if($model->delete()){

        unlink(static::getPath().$name);

      echo  Json::encode([
          'success'=> $id,
          ]);
        exit;

    }
  }        
}   

public function findModel($id){

  if(!empty($id)){
    $model = Banner::find($id);
    return $model;
  }
}

}