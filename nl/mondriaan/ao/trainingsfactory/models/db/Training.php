<?php
namespace nl\mondriaan\ao\trainingsfactory\models\db;

class Training extends \ao\php\framework\models\db\Entiteit
{
    protected $id;
    protected $description;
    protected $duration;
    protected $extra_costs;
    protected $lesson_id;

    public function __construct() {
        $this->id = filter_var($this->id,FILTER_VALIDATE_INT);
    }

}
