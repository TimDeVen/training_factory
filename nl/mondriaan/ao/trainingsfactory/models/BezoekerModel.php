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


    public function registreren()
    {
        $firstname= filter_input(INPUT_POST, 'firstname');
        $preprovision= filter_input(INPUT_POST, 'preprovision');
        $lastname=filter_input(INPUT_POST, 'lastname');
        $loginname=filter_input(INPUT_POST, 'loginname');
        $password=filter_input(INPUT_POST, 'password');
        $gender=filter_input(INPUT_POST,'gender');
        $street=filter_input(INPUT_POST,'street');
        $postal=filter_input(INPUT_POST,'postal');
        $place=filter_input(INPUT_POST,'place');
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $dateofbirth=filter_input(INPUT_POST,'dateofbirth');

        var_dump($_POST);

        if($email===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($loginname===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if(empty($password))
        {
            $sql="INSERT INTO `personen` (firstname,preprovision,lastname,loginname, 
                password,gender,street,postal_code,emailadress,place,dateofbirth,role)VALUES (:firstname,:preprovision,:lastname,:loginname, 
                'qwerty',:gender,:street,:postal,:email,:place,:dateofbirth,'member') ";
            $stmnt = $this->dbh->prepare($sql);
        }
        else{
            $sql="INSERT INTO `personen` (firstname,preprovision,lastname,loginname, 
                password,gender,street,postal_code,emailadress,place,dateofbirth,role)VALUES (:firstname,:preprovision,:lastname,:loginname, 
                :password,:gender,:street,:postal,:email,:place,:dateofbirth,'member') ";
            $stmnt = $this->dbh->prepare($sql);
            $stmnt->bindParam(':password', $password);
        }
        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal', $postal);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':place', $place);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);

        try
        {

            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            var_dump($e);
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($stmnt->rowCount()===1)
        {
            return REQUEST_SUCCESS;
        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

}
