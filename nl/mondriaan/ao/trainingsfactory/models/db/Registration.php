<?php
namespace nl\mondriaan\ao\trainingsfactory\models\db;

class Registration extends \ao\php\framework\models\db\Entiteit
{
    protected $id;
    protected $payment;
    protected $lesson_id;
    protected $person_id;

    
    public function __construct() {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }

}