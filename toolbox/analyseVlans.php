<?php
    namespace OpenNetworkTools\Toobox\Manufacturer\ExtremeNetworks;
        
    class analyseVlans {
    
        static function explode($data){
            $vlans = array();
            $data = explode(",", $data);
            foreach ($data as $k => $v){
                if (strpos($v, '-') !== false) {
                    $range = explode("-", $v);
                    for($i=$range[0];$i<=$range[1];$i++) $vlans[] = (int)$i;
                } else {
                    for($i=$v; $i<=$v;$i++) $vlans[] = (int)$i;
                }
            }
            return $vlans;
        }
    
    }
?>