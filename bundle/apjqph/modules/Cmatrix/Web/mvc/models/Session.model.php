<?php
namespace Cmatrix\Web\Models;
use \Cmatrix as cm;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Session extends CommonLogin {
    public function getData(){
        kernel\App::i();
        
        $ParentData = parent::getData();
        
        return arrayMergeReplace($ParentData,[
            'session' => [
                'cts' => $this->getMyCts($ParentData['session']),
                'tts' => $this->getMyTts($ParentData['session']),
            ]
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyCts($session){
        $Now = new \DateTime('now');
        $Ts = new \DateTime($session['ts']);
        //$Ts = new \DateTime(date('Y-m-d H:i:s',$session['ts']));
        $Interval = $Ts->diff($Now);
        return $Interval->format('дней:%R%a, часов:%H, минут:%I');
    }
    
    // --- --- --- --- ---
    private function getMyTts($session){
        $Now = new \DateTime('now');
        $Ts = new \DateTime($session['touch_ts']);
        //$Ts = new \DateTime(date('Y-m-d H:i:s',$session['touch_ts']));
        $Interval = $Ts->diff($Now);
        return $Interval->format('дней:%R%a, часов:%H, минут:%I');
    }
}
?>