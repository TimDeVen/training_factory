<?php
namespace framework\models\db;

class Afdeling extends Entiteit
{
    protected $id;
    protected $omschrijving;
    protected $foto;
    protected $afkorting;
    protected $naam;
    
    public function __construct() {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }
}