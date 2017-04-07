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
        $tel=filter_input(INPUT_POST,'tel');
        $pc=filter_input(INPUT_POST,'pc');
        $plaats=filter_input(INPUT_POST,'plaats');

        if($gn===null || $vl===null || $an===null || $adres===null ||$email===null ||$plaats===null|| $pc===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if( $email===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if(empty($ww))
        {
            $sql=   "INSERT INTO `gebruikers`  (gebruikersnaam,voorletters,tussenvoegsel,achternaam, 
                adres,email,telefoon,postcode,woonplaats,recht)VALUES (:gebruikersnaam,:voorletters,:tussenvoegsel,:achternaam, 
                :adres,:email,:telefoon,:postcode,:plaats,'deelnemer') ";
            $stmnt = $this->db->prepare($sql);
        }
        else{
            $sql=   "INSERT INTO `gebruikers`  (gebruikersnaam,wachtwoord,voorletters,tussenvoegsel,achternaam, 
                adres,email,telefoon,postcode,woonplaats,recht)VALUES (:gebruikersnaam,:wachtwoord,:voorletters,:tussenvoegsel,:achternaam, 
                :adres,:email,:telefoon,:postcode,:plaats,'deelnemer') ";
            $stmnt = $this->db->prepare($sql);
            $stmnt->bindParam(':wachtwoord', $ww);
        }
        $stmnt->bindParam(':gebruikersnaam', $gn);
        $stmnt->bindParam(':voorletters', $vl);
        $stmnt->bindParam(':tussenvoegsel', $tv);
        $stmnt->bindParam(':achternaam', $an);
        $stmnt->bindParam(':adres', $adres);
        $stmnt->bindParam(':telefoon', $tel);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':postcode', $pc);
        $stmnt->bindParam(':plaats', $plaats);

        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        if($stmnt->rowCount()===1)
        {
            return REQUEST_SUCCESS;
        }
        return REQUEST_FAILURE_DATA_INVALID;
    }

}
