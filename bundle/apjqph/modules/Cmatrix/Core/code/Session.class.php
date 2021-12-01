<?php
namespace Cmatrix\Core;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Db as db;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Core\Session
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Session {
    static $INSTANCES = [];
    private $CookeiName;
    private $Hid;
    
    // --- --- --- --- ---
    function __construct(){
        $this->check();
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function check(){
        if(kernel\App::$SAPI === 'CLI'){
        }
        else{
            $this->CookieName = str_replace('.','_',kernel\Config::instance()->getValue('project/code','cmatrix'));
            $this->Hid = empty($_COOKIE[$this->CookieName]) ? null : $_COOKIE[$this->CookieName];
            
            // нет куки, новая сессия
            if(!$this->Hid){
                $this->Hid = hid();
                $Ident = $this->getIdent();
                
                $Ob = db\Obbject::instance('/Cmatrix/Core/Session')->get($Ident);
                if(!$Ob->IsEmpty){
                    // лишние активные сессии удалить
                    $Ob->history(true)->delete();
                }
                
                db\Obbject::instance('/Cmatrix/Core/Session')->create(array_merge($Ident,['hid'=>$this->Hid]));
                
                $this->setCookie($this->Hid);
            }
            // какая-то старая сессия
            else{
                $Ident = $this->getIdent($this->Hid);
                
                $Session = db\Obbject::instance('/Cmatrix/Core/Session')/*->active(true)*/->get($Ident);
                if($Session->IsEmpty){
                    // если в БД нет этой сессии, то это или сессия закрыта, или какой-то сбой, обновить сессию
                    $this->unsetCookie($this->Hid);
                }
                else{
                    $this->Session = $Session;
                    $this->Sysuser = db\Obbject::instance('/Cmatrix/Core/Sysuser')->get($Session->sysuser_id);
                    
                    // --- touch
                    // через \CmatrixDb нельзя, так как происходит зацикливание
                    $Query = db\Cql::update('/Cmatrix/Core/Session')->value('touch_ts','current_timestamp')->rule('id',$this->Session->id);
                    db\Connect::instance()->exec($Query);
                    //$this->Session->value('touch_ts','current_timestamp')->update();
                }
            }
            
        }
    }
    
    // --- --- --- --- ---
    private function getIdent(){
        $Arr = [];
        
        if(kernel\App::$SAPI === 'CLI'){
            $Arr['ip4'] = '0.0.0.0';
            $Arr['agent'] = 'Cmatrix local';
        }
        else{
            $Arr['ip4']      = isset($_SERVER['REMOTE_ADDR'])          ? $_SERVER['REMOTE_ADDR']          : NULL;
            $Arr['ip4x']     = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : NULL;
            $Arr['proxy']    = isset($_SERVER['HTTP_VIA'])             ? $_SERVER['HTTP_VIA']             : NULL;
            $Arr['agent']    = isset($_SERVER['HTTP_USER_AGENT'])      ? $_SERVER['HTTP_USER_AGENT']      : NULL;
            // $Arr['lang']     = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : NULL;
            // $Arr['charset']  = isset($_SERVER['HTTP_ACCEPT_CHARSET'])  ? $_SERVER['HTTP_ACCEPT_CHARSET']  : NULL;
            // $Arr['encoding'] = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : NULL;
            
            if($Arr['ip4'] === '::1') $Arr['ip4'] = '127.0.0.1';
        }
        return $Arr;
    }
    
    // --- --- --- --- ---
    private function setCookie($hid){
        //$Path = cm\Hash::getFile(CM_TOP.'/config.json')->getValue('www/root');
        $Path = '/';
        
        // --- выставить куку на год
        $Days = 1;    // кол-во дней для куки
        setcookie($this->CookieName,$hid,time() + ($Days * 86400),$Path);
        setcookie($this->CookieName.'_ts',time(),time() + ($Days * 86400),$Path);
			
		// --- перегрузить страницу
		header("Refresh:0");
		exit();        
    }

    // --- --- --- --- ---
    private function unsetCookie(){
        //$Path = cm\Hash::getFile(CM_TOP.'/config.json')->getValue('www/root');
        $Path = '/';
        
        // --- выставить куку на год
        $Days = 1;    // кол-во дней для куки
        setcookie($this->CookieName,'',time()-3600,$Path);
        setcookie($this->CookieName.'_ts','',time()-3600,$Path);
			
		// --- перегрузить страницу
		header("Refresh:0");
		exit();
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance(){
        $Key = md5('current');
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        return self::$INSTANCES[$Key] = new self;
    }
}
?>