<?php
namespace framework\models;

class MedewerkerModel extends AbstractModel
{
    public function __construct($control, $action) {
    parent::__construct($control, $action);
    }

    public function isGerechtigd() {
    //controleer of er ingelogd is. Ja, kijk of de gebuiker deze controller mag gebruiken
    if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
    {
        $gebruiker=$_SESSION['gebruiker'];
        if ($gebruiker->getRecht() == "medewerker")
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
}
