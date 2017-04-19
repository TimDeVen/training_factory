<?php
    namespace nl\mondriaan\ao\trainingsfactory\controls;

    use ao\php\framework\controls\AbstractController;

class MemberController extends AbstractController
{

    public function __construct($control, $action, $message = null)
    {
        parent::__construct($control, $action, $message);
    }

    protected function uitloggenAction()
    {
        $this->model->uitloggen();
        $this->forward('default','bezoeker');
    }

    protected function defaultAction()
    {
       $gebruiker = $this->model->getGebruiker();
       $this->view->set("gebruiker",$gebruiker);
    }

    protected function overzichtinschrijvingenAction()
    {
      $gebruiker = $this->model->getGebruiker();
      $this->view->set("gebruiker",$gebruiker);
      $lessen = $this->model->getIngeschrevenLessen();
      $this->view->set('lessen',$lessen);
    }
    protected function inschrijvenAction()
    {
      $gebruiker = $this->model->getGebruiker();
      $this->view->set("gebruiker",$gebruiker);
    }
    protected function gegevenswijzigenAction() {
        $this->view->set("gebruiker", $this->model->getGebruiker());

        if($this->model->isPostLeeg()) {
            $this->view->set("msg", "Vul uw gegevens in");
        } else {
            switch($this->model->wijziggegevens()) {
                case REQUEST_SUCCESS:
                    $this->view->set("msg", "U heeft successvol uw gegevens gewijzigd!");
                    $this->forward("gegevenswijzigen");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("msg", "Emailadres niet correct of gebruikersnaam bestaat al");
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("msg", "Niet alle gegevens zijn ingevuld");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("msg", "Er niks te wijzigen");
                    break;
            }
        }
    }
}
