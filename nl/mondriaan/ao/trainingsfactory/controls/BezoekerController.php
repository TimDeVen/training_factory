<?php
namespace nl\mondriaan\ao\trainingsfactory\controls;

class BezoekerController extends \ao\php\framework\controls\AbstractController
{
    public function __construct($control, $action, $message = NULL) {
        parent::__construct($control, $action, $message);
    }

    protected function inloggenAction()
    {
        if($this->model->isPostLeeg()) {
           $this->view->set("msg","Vul uw gegevens in");
        }
        else
        {
            $resultInlog=$this->model->controleerInloggen();
            switch($resultInlog)
            {
                case REQUEST_SUCCESS:
                     $this->view->set("msg","Welkom op de beheers applicatie. Veel werkplezier");
                     $recht = $this->model->getGebruiker()->getRole();
                     $this->forward("default", $recht);
                     break;
                case REQUEST_FAILURE_DATA_INVALID:
                     $this->view->set("msg","Gegevens kloppen niet. Probeer opnieuw.");
                     break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                     $this->view->set("msg","niet alle gegevens ingevuld");
                     break;
            }
        }
    }

    protected function defaultAction()
    {

         if($this->model->isPostLeeg()) {
           $this->view->set("msg","Vul uw gegevens in");
        }
        else
        {
            $resultInlog=$this->model->controleerInloggen();
            switch($resultInlog)
            {
                case REQUEST_SUCCESS:
                     $this->view->set("msg","Welkom op de beheers applicatie. Veel werkplezier");
                     $recht = $this->model->getGebruiker()->getRole();
                     $this->forward("default", $recht);
                     break;
                case REQUEST_FAILURE_DATA_INVALID:
                     $this->view->set("msg","Gegevens kloppen niet. Probeer opnieuw.");
                     break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                     $this->view->set("msg","niet alle gegevens ingevuld");
                     break;
            }
        }

    }


    protected function lidWordenAction()
    {
        if($this->model->isPostLeeg())
        {
            $this->view->set("boodschap","Vul uw gegevens in");
        }
        else
        {
            $result=$this->model->registreren();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap","U bent successvol geregistreerd!");
                    $this->forward("default");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set('form_data',$_POST);
                    $this->view->set("boodschap","emailadres niet correct of gebruikersnaam bestaat al");
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set('form_data',$_POST);
                    $this->view->set("boodschap","Niet alle gegevens ingevuld");
                    break;
            }
        }
    }

    protected function contactAction()
    {

    }

    protected function regelsAction()
    {
      
    }
}
