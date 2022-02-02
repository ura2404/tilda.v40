<?php
namespace Cmatrix\Web\Models;
use \Cmatrix as cm;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Session extends CommonLogin {
    public function getData(){
        kernel\App::i();
        
        $ParentData = parent::getData();

        $Arr = $ParentData['isSession'] ? [
            'ID'      => $ParentData['session']['id'],
            'HID'     => $ParentData['session']['hid'],
            'IP4'     => $ParentData['session']['ip4'],
            'IP4x'    => $ParentData['session']['ip4x'],
            'Proxy'   => $ParentData['session']['proxy'],
            'Sysuser' => $ParentData['sysuser']['id'] .' // '. $ParentData['sysuser']['code'] .' // '. $ParentData['sysuser']['name'],
            'CTS'     => $this->getMyCts($ParentData['session']),
            'TTS'     => $this->getMyTts($ParentData['session'])
        ] : [];
        
        
        return arrayMergeReplace(parent::getData(),[
            'data' => $Arr,
            'path' => [
                'Home' => CM_WHOME,
                'Текущая сессия' => CM_WHOME .'/session'
            ]

        ]);
    }

    // --- --- --- --- ---
    private function getMyCts($session){
        $Now = new \DateTime('now');
        $Ts = new \DateTime($session['ts']);
        //$Ts = new \DateTime(date('Y-m-d H:i:s',$session['ts']));
        $Interval = $Ts->diff($Now);
        return strBefore($session['ts'],'.') .' // '. $Interval->format('дней:%R%a, часов:%H, минут:%I');
    }
    
    // --- --- --- --- ---
    private function getMyTts($session){
        $Now = new \DateTime('now');
        $Ts = new \DateTime($session['touch_ts']);
        //$Ts = new \DateTime(date('Y-m-d H:i:s',$session['touch_ts']));
        $Interval = $Ts->diff($Now);
        return strBefore($session['touch_ts'],'.') .' // '. $Interval->format('дней:%R%a, часов:%H, минут:%I');
    }
}
?>