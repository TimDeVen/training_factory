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
  
}
