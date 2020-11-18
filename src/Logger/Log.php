<?php


namespace App\Logger;
use App\Student;


class Log 
{

    public function __construct($action = '',  $message = '', string $id = '') 
    {
        $this->time = date("Y-m-d H:i:s");
        $this->action = $action;
        $this->message = $message;
        $this->id = $id;

    }

    
    public function LogInFile() :void
    {
        $data = array('Time' => $this->time,
                     'Action' => $this->action, 
                     'Message' => $this->message,
                     'id' =>$this->id);   
        $json_string = json_encode($data, JSON_PRETTY_PRINT);            
        $fileLog = fopen("src/Logger/log.json", "a");
        fwrite($fileLog,$json_string . "\r\n");        
        fclose($fileLog);        
    }
        
}