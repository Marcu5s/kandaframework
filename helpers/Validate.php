<?php
/**
 * @copyright (c) KandaFramework
 * @access public
 * 
 * 
 */
namespace kanda\helpers;

class Validate extends Assets{
    
    protected static $rules;
    protected static $message;
    protected static $class;
   
    public function __construct() {
        
        $model =  new Assets();

        $this->base = KANDA_ROOT .'/assets/';
         
        $this->basename = 'Validate';   
        
        $this->js = [
            'js/jquery-v1.11.js',
            'js/jquery.validate.min.js',
            'js/additional-methods.min.js',
         ]; 
         //Script para ser listado no final
         parent::init(); 
         $model->createAssets([static::end()],'js');

    } 

     public static function begin($model) {

       
        static::$class = explode("\\", get_class($model));;
        static::$class = end(static::$class);

        $rules = $model::rules();
        
        $message = 'Obrigátorio';

        // [[1,2,3],'required']
        $reduce = function($class,$colun){
               
               static::$rules   .= "'" . static::$class . "[$colun]':'required',";
               static::$message .= "'" . static::$class . "[$colun]':{required:'Obrigátorio'},"; 
        };

        foreach ($rules as $key => $colun) {

           
                switch ($colun[1]) {

                    case 'required':
                      array_reduce($colun[0], $reduce,null);
                    break;

                    case 'varchar':

                        static::$rules   .= "'" . static::$class . "[$colun[0]]':'required',";
                        static::$message .= "'" . static::$class . "[$colun[0]]':{required:'$message'},";

                        break;
                    case 'integer':
                    case 'float':

                        static::$rules .= "'" . static::$class . "[$colun[0]]':{required: true,number: true},";
                        static::$message .= "'" . static::$class . "[$colun[0]]':{required:'$message',number:'{$colun['error']}'},";

                        break;
                    case 'email':

                        static::$rules .= "'" . static::$class . "[$colun[0]]':{required: true,email: true},";
                        static::$message .= "'" . static::$class . "[$colun[0]]':{required:'$message',email:'{$colun['error']}'},";

                        break;
                    case 'file':
                        static::$rules .= "'" . static::$class . "[$colun[0]]':{extension:\"{$colun['extension']}\"},";
                        static::$message .= "'" . static::$class . "[$colun[0]]':{extension:'{$colun['error']}'},";
                        break;
                }
            }

            return new Validate();
            
        }

        public static function end()
        {

            
              return  "$('#FormWidget').validate({rules:{".static::$rules."},messages:{".static::$message."},});";
        
            

        }
   
      
}