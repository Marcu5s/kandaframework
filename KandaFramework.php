<?php
/**
 * @copyright (c) KandaFramework
 * @access public
 * 
 */
  

set_include_path(get_include_path() . PATH_SEPARATOR . WWW_ROOT);
set_include_path(get_include_path() . PATH_SEPARATOR . KANDA_ROOT);
  
namespace kanda; 
 

require_once dirname(__DIR__).'/db/ActiveRecord.php';
 

use app\Controller;
 
use helps\Http; 
 
class Kanda{

    public static $app;

    public static $request;
    
    public static $get;
    
    public static $param;

    public function __construct() {

        Kanda::$request = helps\Http::run();
          
        Kanda::$app = (object) [
                    'arrays'     => helps\Arrays::run(),
                    'cache'      => helps\Cache::run(),
                    'crop'       => helps\Crop::run(),
                    'html'       => helps\Html::run(),
                    'url'        => helps\Url::run(),
                    'uploadFile' => helps\UploadFile::run(),
                    'session'    => helps\Session::run(),
        ];
         
    }

    /**
     * @access public
     *      * 
     * @importante metodo @Core contem include as principais class dos sistema
     * 
     * @param array() $main
     * 
     * 
     */
    public static function begin($main) {
   
        define('DSN',$main['config']['db']['dsn']);
        
        Kanda::$param = (object) $main['param'];

        ActiveRecord\Config::initialize(function($cfg) {
                $cfg->set_connections(array(
                'development' => DSN));
        });

        date_default_timezone_set($main['config']['timezone']);
        
        Controller::begin($main)->load();
         
        
    }
     

}
$kanda = new Kanda();
$kanda->begin($main);