<?php
namespace nl\mondriaan\ao\trainingsfactory\models\db;

class Les extends \ao\php\framework\models\db\Entiteit
{
    protected $id;
    protected $time;
    protected $date;
    protected $location;
    protected $max_persons;
    protected $person_id;


    
    public function __construct() {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }

}