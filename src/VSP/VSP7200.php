<?php
    namespace OpenNetworkTools\Manufacturer\ExtremeNetworks\VSP;
        
    class VSP7200 extends \OpenNetworkTools\Manufacturer\ExtremeNetworks\VSP {
    
        public function __construct(){
            parent::__construct();
        }

        public function exportOpenConfig(){
            $this->exportVlan();
        }

        private function exportVlan(){
            foreach ($this->getConfig()->getVlans() as $vlan){
                $this->addConfigFile("vlan create ".$vlan->getVlanId()." name \"".$vlan->getDescription()."\" type port 1");
            }
        }

    }
?>