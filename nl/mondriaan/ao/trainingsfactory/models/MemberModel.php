<?php
namespace nl\mondriaan\ao\trainingsfactory\models;

use ao\php\framework\models\AbstractModel;
class MemberModel extends AbstractModel
{
    public function __construct($control, $action) {
    parent::__construct($control, $action);
    }

    public function isGerechtigd() {
    //controleer of er ingelogd is. Ja, kijk of de gebuiker deze controller mag gebruiken
    if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
    {
        $gebruiker=$_SESSION['gebruiker'];
        if ($gebruiker->getRole() == "member")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
    }

    public function uitloggen() {
    $_SESSION = array();
    session_destroy();
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


    public function wijziggegevens()
    {
        $firstname = filter_input(INPUT_POST, 'firstname');
        $preprovision = filter_input(INPUT_POST, 'preprovision');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $dateofbirth = filter_input(INPUT_POST, 'dateofbirth');
        $loginname = filter_input(INPUT_POST, 'loginname');
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $gender = filter_input(INPUT_POST, 'gender');
        $street = filter_input(INPUT_POST, 'street');
        $postal = filter_input(INPUT_POST, 'postal');
        $place = filter_input(INPUT_POST, 'place');
        $id = $this->getGebruiker()->getId();

        if(empty($password)) {
            $sql = "UPDATE `personen`
                    SET firstname = :firstname,
                        preprovision = :preprovision,
                        lastname = :lastname,
                        dateofbirth = :dateofbirth,
                        loginname = :loginname,
                        emailadress = :email,
                        gender = :gender,
                        street = :street,
                        postal_code = :postal,
                        place = :place,
                        password = 'qwerty
                          where id = :id";
            $stmnt = $this->dbh->prepare($sql);

        } else {

            $sql = "UPDATE `personen`
                    SET firstname = :firstname,
                    preprovision = :preprovision,
                    lastname = :lastname,
                    dateofbirth = :dateofbirth,
                    loginname = :loginname,
                    emailadress = :email,
                    gender = :gender,
                    street = :street,
                    postal_code = :postal,
                    place = :place,
                    password = :password
                    where id = :id";
            $stmnt = $this->dbh->prepare($sql);
            $stmnt->bindParam(':password', $password);
        }

        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':email', $email);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal', $postal);
        $stmnt->bindParam(':place', $place);
        $stmnt->bindParam(':id', $id);

        try {
            $stmnt->execute();
        } catch(\PDOEXception $e) {
            var_dump($e);
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
    public function updateGebruiker() {
        $gebruiker_id = $this->getGebruiker()->getId();
        $sql = "SELECT * FROM `personen` WHERE `personen`.`id` = :gebruiker_id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':gebruiker_id', $gebruiker_id);
        $stmnt->setFetchMode(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Persoon');
        $stmnt->execute();
        $_SESSION['gebruiker'] = $stmnt->fetch(\PDO::FETCH_CLASS);
    }


}
