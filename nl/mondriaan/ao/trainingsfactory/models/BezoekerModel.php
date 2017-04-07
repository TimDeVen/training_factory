<?php
namespace nl\mondriaan\ao\trainingsfactory\models;

class BezoekerModel extends  \ao\php\framework\models\AbstractModel
{
    public function __construct($control, $action)
    {
        parent::__construct($control, $action);
    }

    public function controleerInloggen()
    {
        $gn=  filter_input(INPUT_POST, 'gn');
        $ww=  filter_input(INPUT_POST, 'ww');

        if ( ($gn!==null) && ($ww!==null) )
        {
             $sql = 'SELECT * FROM `personen` WHERE `loginname` = :gn AND `password` = :ww';
             $sth = $this->dbh->prepare($sql);
             $sth->bindParam(':gn',$gn);
             $sth->bindParam(':ww',$ww);
             $sth->execute();

             $result = $sth->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');

             if(count($result) === 1)
             {
                 $this->startSession();
                 $_SESSION['gebruiker']=$result[0];
                 return REQUEST_SUCCESS;
             }
             return REQUEST_FAILURE_DATA_INVALID;
        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

}
