<?php
    namespace OpenNetworkTools\Manufacturer\ExtremeNetworks\ERS;
        
    class ERS5600 extends \OpenNetworkTools\Manufacturer\ExtremeNetworks\ERS {
    
        public function __construct(){
            parent::__construct();
            $this->getConfig()->addVlans(1)->setVlanId(1);
        }

        public function analyseConfigFile(){
            foreach ($this->getConfigFile() as $k => $v){
                $this->analyseVlan($k, $v);
            }
        }

        private function analyseVlan($key, $line){
            if(preg_match("#^vlan create ([0-9,-]+)#", $line, $match)){
               $vlans = \OpenNetworkTools\Toobox\Manufacturer\ExtremeNetworks\analyseVlans::explode($match[1]);
               foreach ($vlans as $vlan) $this->getConfig()->addVlans($vlan)->setVlanId($vlan);
            } elseif(preg_match("#^vlan name ([0-9]+) \"(.*)\"#", $line, $match)){
                $this->getConfig()->getVlans($match[1])->setDescription($match[2]);
            } elseif(preg_match("#^vlan ports ([0-9/-]+) pvid ([0-9]+)#", $line, $match)){
                $interfaces = \OpenNetworkTools\Toobox\Manufacturer\ExtremeNetworks\analysePorts::explode($match[1]);
                foreach ($interfaces as $interface) $this->getConfig()->addInterfaces($interface);
            }
        }

    }