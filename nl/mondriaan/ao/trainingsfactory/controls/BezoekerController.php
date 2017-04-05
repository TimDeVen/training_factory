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
                     $recht = $this->model->getGebruiker()->getRecht();
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
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
    }
    
    protected function defaultAction()
    {
       $afdelingen=$this->model->getAfdelingen();
       $this->view->set("afdelingen",$afdelingen);
       $directeur = $this->model->getDirecteur();
       $this->view->set("directeur",$directeur);
    }
    
    protected function afdelingAction()
    {
       $directeur = $this->model->getDirecteur();
       $this->view->set("directeur",$directeur);
       
       $afdelingen=$this->model->getAfdelingen();
       $this->view->set("afdelingen",$afdelingen);
       
       $contacten = $this->model->getContacten();
       if($contacten===REQUEST_FAILURE_DATA_INCOMPLETE || $contacten===REQUEST_FAILURE_DATA_INVALID)
       {          
               $this->view->set("msg","opvragen contacten is niet gelukt!");
               $this->forward("default", "bezoeker");
       }
       $this->view->set("contacten",$contacten);
              
       $team = $this->model->getAfdeling();
       if($team===REQUEST_FAILURE_DATA_INCOMPLETE || $team===REQUEST_FAILURE_DATA_INVALID)
       {          
               $this->view->set("msg","opvragen afdeling is niet gelukt!");
               $this->forward("default", "bezoeker");
       }
       $this->view->set("team",$team);              
    }
    
    protected function detailsAction()
    {
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $contact = $this->model->getContact();
        if($contact===REQUEST_FAILURE_DATA_INCOMPLETE || $contact===REQUEST_FAILURE_DATA_INVALID)
        {          
               $this->view->set("msg","opvragen persoon is niet gelukt!");
               $this->forward("default", "bezoeker");
        }
        $this->view->set("contact",$contact);
    }
    
    protected function directeurAction()
    {
        $afdelingen=$this->model->getAfdelingen();
        $this->view->set("afdelingen",$afdelingen);
        $directeur = $this->model->getDirecteur();
        $this->view->set("directeur",$directeur);
        $this->view->set("contact",$directeur);
    }
}