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
}
