<?php
namespace nl\mondriaan\ao\trainingsfactory\models;

use ao\php\framework\models\AbstractModel;

class AdministratorModel extends AbstractModel {

    public function __construct($control, $action)
    {
        $this->control = $control;
        $this->action = $action;
        $this->dbh = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->startSession();
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM `personen` WHERE `role` = 'member'";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->execute();
        $members = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        return $members;
    }

    public function getInstructeurs()
    {
        $sql = "SELECT * FROM `personen` WHERE role = 'instructeur'";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->execute();
        $members = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        return $members;
    }

    public function deleteUser()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

    if($id===null)
    {
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }
    if($id===false)
    {
        return REQUEST_FAILURE_DATA_INVALID;
    }

        $sql = "SELECT * FROM `personen` WHERE `personen`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $users = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');

    if(count($users)===0)
    {
        return REQUEST_FAILURE_DATA_INVALID;
    }
        $sql = "DELETE FROM `personen` WHERE `personen`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        if($stmnt->rowCount()===1){

            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }

    public function deleteTrainingsvorm()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $sql = "SELECT * FROM `trainingen` WHERE `trainingen`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $trainingen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Training');

        if(count($trainingen)===0)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        $sql = "DELETE FROM `trainingen` WHERE `trainingen`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        if($stmnt->rowCount()===1){
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }

    public function addContact()
    {
        $gebruikersnaam= filter_input(INPUT_POST, 'gn');
        $wachtwoord= filter_input(INPUT_POST, 'ww');
        $voorletter=filter_input(INPUT_POST, 'vl');
        $tussenvoegsel=filter_input(INPUT_POST, 'tv');
        $achternaam=filter_input(INPUT_POST, 'an');
        $afdeling=filter_input(INPUT_POST,'afd',FILTER_VALIDATE_INT);
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $intern=filter_input(INPUT_POST,'int');
        $extern=filter_input(INPUT_POST,'ext');

    if($gebruikersnaam===null || $voorletter===null || $achternaam===null || $afdeling===null ||$email===null)
    {
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

    if($afdeling===false || $email===false)
    {
        return REQUEST_FAILURE_DATA_INVALID;
    }

    if(empty($wachtwoord))
    {
        $wachtwoord='qwerty';
    }

    $result = FOTO::isAfbeeldingGestuurd();
    if($result===IMAGE_FAILURE_TYPE || $result===IMAGE_FAILURE_SIZE_EXCEEDED)
    {
        return $result;
    }

    if($result===IMAGE_NOTHING_UPLOADED)
    {
        $foto=IMAGE_DEFAULT;
    }
    else
    {
        $foto = FOTO::getAfbeeldingNaam();
    }

    $sql="INSERT IGNORE INTO `contacten`  (gebruikersnaam,wachtwoord,voorletter,tussenvoegsel,achternaam,"
    . "extern,intern,email,foto,recht,afdelings_id)VALUES (:gebruikersnaam,:wachtwoord,:voorletter,:tussenvoegsel,:achternaam,"
    . ":extern,:intern,:email,:foto,'medewerkmembering) ";

    $stmnt = $this->db->prepare($sql);
    $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmnt->bindParam(':wachtwoord', $wachtwoord);
    $stmnt->bindParam(':voorletter', $voorletter);
    $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
    $stmnt->bindParam(':achternaam', $achternaam);
    $stmnt->bindParam(':extern', $extern);
    $stmnt->bindParam(':intern', $intern);
    $stmnt->bindParam(':email', $email);
    $stmnt->bindParam(':foto', $foto);
    $stmnt->bindParam(':afdeling', $afdeling);

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
        if(!empty($foto))
        {
            FOTO::slaAfbeeldingOp($foto);
        }
        return REQUEST_SUCCESS;
    }
    return REQUEST_FAILURE_DATA_INVALID;
    }

    public function isGerechtigd()
    {
    //controleer of er ingelogd is. Ja, kijk of de gebruiker de deze controller mag gebruiken
    if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
    {
        $gebruiker=$_SESSION['gebruiker'];
        return $gebruiker->getRecht() === $this->control;
    }
    return false;
    }

    public function uitloggen()
    {
        $_SESSION = array();
        session_destroy();
    }

    public function wijzigAnw()
    {
        $gebruikersnaam= filter_input(INPUT_POST, 'gn');
        $voorletter=filter_input(INPUT_POST, 'vl');
        $tussenvoegsel=filter_input(INPUT_POST, 'tv');
        $achternaam=filter_input(INPUT_POST, 'an');
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $intern=filter_input(INPUT_POST,'int');
        $extern=filter_input(INPUT_POST,'ext');

        if(empty($voorletter)||empty($achternaam)||empty($email)||empty($gebruikersnaam))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($email===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $gebruiker_id = $this->getGebruiker()->getId();

        $sql="UPDATE `contacten` SET gebruikersnaam=:gebruikersnaam,voorletter=:voorletter"
                . ",tussenvoegsel=:tussenvoegsel,achternaam=:achternaam,"
                 . "extern=:extern,intern=:intern,email=:email where `contacten`.`id`= :gebruiker_id; ";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmnt->bindParam(':voorletter', $voorletter);
        $stmnt->bindParam(':tussenvoegsel', $tussenvoegsel);
        $stmnt->bindParam(':achternaam', $achternaam);
        $stmnt->bindParam(':extern', $extern);
        $stmnt->bindParam(':intern', $intern);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);

        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd===1)
        {
            $this->updateGebruiker();
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }

    public function wijzigAnwTrainingsvorm()
    {
        $id = filter_input(INPUT_GET, 'id');
        $description= filter_input(INPUT_POST, 'description');
        $duration=filter_input(INPUT_POST, 'duration');
        $extra_costs=filter_input(INPUT_POST, 'extra_costs');


        if(empty($description)||empty($duration)||empty($extra_costs))
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($description===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $sql="UPDATE `trainingen` SET description=:description,duration=:duration"
            . ",extra_costs=:extra_costs where `trainingen`.`id`= :id;";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':description', $description);
        $stmnt->bindParam(':duration', $duration);
        $stmnt->bindParam(':extra_costs', $extra_costs);
        $stmnt->bindParam(':id', $id);

        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd===1)
        {
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }

    private function updateGebruiker()
    {
        $gebruiker_id = $this->getGebruiker()->getId();
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id`=:gebruiker_id";
        $stmnt = $this->db->prepare($sql);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        $stmnt->setFetchMode(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        $stmnt->execute();
        $_SESSION['gebruiker']= $stmnt->fetch(\PDO::FETCH_CLASS);
    }

    public function resetWw() {
    //TODO
    }

    public function getLid() {
        $id = filter_input(INPUT_GET, 'id');
        $sql = "SELECT * FROM `personen` WHERE id = :id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $lid = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Persoon');
        return $lid[0];


    }

    public function wijzigWw()
    {
    $ww= filter_input(INPUT_POST,'ww');
    $nww1= filter_input(INPUT_POST,'nww1');
    $nww2= filter_input(INPUT_POST,'nww2');

    if($ww===null || $nww1===null || $nww2===null)
    {
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

    if(empty($nww1)||empty($nww2)||empty($ww))
    {
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

    if($_POST['nww1']!==$_POST['nww2'])
    {
        return REQUEST_FAILURE_DATA_INVALID;
    }

    $hww = $this->getGebruiker()->getWachtwoord();

    if($hww!== $ww)
    {
        return REQUEST_FAILURE_DATA_INVALID;
    }

    if($nww1===$ww)
    {
        return REQUEST_NOTHING_CHANGED;
    }

    $id = $this->getGebruiker()->getId();
    $sql = "UPDATE `contacten` SET `contacten`.`wachtwoord` = :nww WHERE `contacten`.`id`= :id";
    $stmnt = $this->db->prepare($sql);
    $stmnt->bindParam(':id', $id);
    $stmnt->bindParam(':nww', $nww1);
    $stmnt->execute();
    $aantalGewijzigd = $stmnt->rowCount();

    if($aantalGewijzigd === 1)
    {
        $this->updateGebruiker();
        return REQUEST_SUCCESS;
    }
    return REQUEST_NOTHING_CHANGED;
    }


    public function getIngeschrevenLessen()
    {
        $sql=' SELECT DATE_FORMAT(`lessons`.`date`, "%d-%m-%Y") as `datum`, 
           DATE_FORMAT(`lessons`.`time`,"%H:%i") as `tijd`, 
           `trainingen`.`extra_costs` as `prijs`, 
           `lessons`.`id` as `id`, 
           `trainingen`.`description` as `soort` ,
           `lessons`.`max_persons` as `max_deelnemers`,
           `registrations` . `payment` as `betaald`
           FROM `lessons` 
            JOIN `trainingen` on `lessons`.`training_id` = `trainingen`.`id`
            JOIN `registrations` on `lessons`.`id` = `registrations`.`id`
            WHERE `lessons`.`id` IN (SELECT lesson_id FROM `registrations` 
                                    WHERE `registrations`.`person_id`=:id)
            order by  DATE(`lessons`.`date`)';

        $stmnt = $this->dbh->prepare($sql);
        $id=$this->getGebruiker()->getId();
        $stmnt->bindParam(':id',$id );
        $stmnt->execute();
        $activiteiten = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Les');
        return $activiteiten;
    }

    public function addInstructeur()
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
                'qwerty',:gender,:street,:postal,:email,:place,:dateofbirth,'instructeur') ";
            $stmnt = $this->dbh->prepare($sql);
        }
        else{
            $sql="INSERT INTO `personen` (firstname,preprovision,lastname,loginname, 
                password,gender,street,postal_code,emailadress,place,dateofbirth,role)VALUES (:firstname,:preprovision,:lastname,:loginname, 
                :password,:gender,:street,:postal,:email,:place,:dateofbirth,'instructeur') ";
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

    public function addTrainingsvorm()
    {
        $description= filter_input(INPUT_POST, 'description');
        $duration= filter_input(INPUT_POST, 'duration');
        $extra_costs=filter_input(INPUT_POST, 'extra_costs');


        if($description===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($duration===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }

        $sql="INSERT INTO `trainingen` (description,duration,extra_costs)VALUES (:description,:duration,:extra_costs) ";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':description', $description);
        $stmnt->bindParam(':duration', $duration);
        $stmnt->bindParam(':extra_costs', $extra_costs);

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

    public function getTrainingsvormen()
    {
        $sql = "SELECT * FROM `trainingen`";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $trainingsvormen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Training');
        return $trainingsvormen;
    }

    public function getTrainingsvorm()
    {
        $id = filter_input(INPUT_GET, 'id');
        $sql = "SELECT * FROM `trainingen` WHERE `trainingen`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();
        $trainingsvormen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Training');
        return $trainingsvormen[0];
    }


}