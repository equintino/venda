<?php
class Balanco {
    private $lcEst;
    private $lcObt;
    
    public function getLcEst() {
        return $this->lcEst;
    }
    public function getLcObt() {
        return $this->lcObt;
    }
    public function setLcEst($lcEst) {
        $this->lcEst = $lcEst;
    }
    public function setLcObt($lcObt) {
        $this->lcObt = $lcObt;
    }
}