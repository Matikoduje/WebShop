<?php


class Alert
{

    private $msg;
    private $type;
    private $alert;

    public function __construct($msg, $type)
    {
        $this->msg = $msg;
        $this->type = $type;
        $this->createAlert();
    }

    private function createAlert()
    {
        $this->alert = '<div class="alert alert-' .  $this->type . ' fade in"><a class="close" data-dismiss="alert">×</a><span>' . $this->msg . '</span></div>';
    }

    public function getAlert()
    {
        return $this->alert;
    }
}