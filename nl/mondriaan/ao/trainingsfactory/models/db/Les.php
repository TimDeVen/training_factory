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

    public function getName() {
        return "$this->firstname $this->preprovision $this->lastname";
    }
    public function getTime() {
        return $this->time;
    }
    public function getDate() {
        return $this->date;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getMaxPersons() {
        return $this->max_persons;
    }
    public function getId() {
        return $this->id;
    }
}