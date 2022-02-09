<?php
namespace Cmatrix\Kernel;

/**
 * Class \Cmatrix\Kernel\Json
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Json {
    /**
     * data array
     */
    private $Data;

    // --- --- --- --- ---
    function __construct(array $data){
        $this->Data = $data;
    }

    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Data' : return $this->getData();
            case 'Encode' : return $this->encode();
            default : throw new ex\Property($this,$name);            
        }
    }

    // --- --- --- --- ---
    private function getData(){
        return $this->Data;
    }

    // --- --- --- --- ---
    public function setData($data){
        $this->Data = $data;
        return $this;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    /**
     * @return string 
     */
    public function encode(){
        return json_encode($this->Data,
            JSON_PRETTY_PRINT             // форматирование пробелами
            | JSON_UNESCAPED_SLASHES      // не экранировать '/'
            | JSON_UNESCAPED_UNICODE      // не кодировать текст
        );
    }
    
    // --- --- --- --- ---
    public function putFile($path){
        $Umask = umask(0000);
        file_put_contents($path,$this->encode());
        chmod($path,0770);
        umask($Umask);
    }
    
    // --- --- --- --- ---
    /**
     * @return array
     */
     /*
    public function decode(){
        return $this->Data;
    }
*/    

    // --- --- --- --- ---
    /*
    public function setData(array $data){
        $this->Data = $data;
        return $this;
    }
    */
    // --- --- --- --- ---
    /*
    public function put($filePath){
        file_put_contents($filePath,json_encode($this->Data,
            JSON_PRETTY_PRINT             // форматирование пробелами
            | JSON_UNESCAPED_SLASHES      // не экранировать '/'
            | JSON_UNESCAPED_UNICODE      // не кодировать текст
         ));
    }
    */

    // --- --- --- --- ---
    static function create(array $data){
        return new self($data);
    }

    static function getString($data){
        $Arr = json_decode($data,true);
        return new self($Arr);
    }
    
    // --- --- --- --- ---
    /**
     * @param string $path - путь к json файлу
     */
    static function getFile($path){
        if(!file_exists($path)) throw new \Exception('Wrong json file');
        
        $Arr = json_decode(file_get_contents($path),true);
        return new self($Arr);
    }
}
?>