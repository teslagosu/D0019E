<?php
//database class
class Database{
    //variables
    private $server;
    private $database;
    private $username;
    private $password;
//constructor
   function Database(){
        $this->server = "utbweb.its.ltu.se:3308";
        $this->database = "D0019E_V20_sebhyr7";
        $this->username = "sebhyr7";
        $this->password = "uMx9bpgb";

}
//returns server
function getServer(){
       return $this->server;
}
//returns database
function getDatabase(){
       return $this->database;
}
//returns username to database
function getUsername(){
       return $this->username;

}
//returns password to database
function getPassword(){
       return $this->password;
}


}
?>