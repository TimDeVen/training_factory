<?php
namespace nl\mondriaan\ao\trainingsfactory\models\db;

class Persoon extends \ao\php\framework\models\db\Entiteit
{
    protected $id;
    protected $loginname;
    protected $password;
    protected $firstname;
    protected $preprovision;
    protected $lastname;
    protected $dateofbirth;
    protected $gender;
    protected $emailadress;
    protected $hiering_date;
    protected $salary;
    protected $street;
    protected $postal_code;
    protected $place;
    protected $role;
    
    public function __construct() {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }

    public function getName() {
        return "$this->firstname $this->preprovision $this->lastname";
    }
}