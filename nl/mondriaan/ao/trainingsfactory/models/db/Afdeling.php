<?php
namespace nl\mondriaan\ao\trainingsfactory\models\db;

class Afdeling extends \ao\php\framework\models\db\Entiteit
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