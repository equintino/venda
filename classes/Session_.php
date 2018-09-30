<?php
class Session {
    private $SID;
    private $login;
    
    public function __construct() {
        session_start();
        $this->setSID(crypt(session_id()));
    }
    public function confSID($atual,$ant){
        $rst = crypt($atual,$this->SID)==$this->SID;
        return $rst;
    }
    public function getSID() {
        return $this->SID;
    }
    public function setSID($SID) {
        $this->SID = $SID;
    }
    public function getLogin() {
        return $this->login;
    }
    public function setLogin($login) {
        $_SESSION['login'] = crypt($login);
        $this->login = $_SESSION['login'];
    }
}