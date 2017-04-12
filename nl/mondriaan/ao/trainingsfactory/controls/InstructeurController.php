<?php
    namespace nl\mondriaan\ao\trainingsfactory\controls;
    
    use ao\php\framework\controls\AbstractController;

class InstructeurController extends AbstractController
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
    protected function lessenbeheerAction()
    {
       $gebruiker = $this->model->getGebruiker();
       $this->view->set("gebruiker",$gebruiker);
       
       $lessen = $this->model->getLessen();
       $this->view->set("lessen",$lessen);
       
    }
    
    protected function verwijderAction()
    {
        $result = $this->model->verwijderLes();
       
            switch($result){
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','Les is verwijderd !');
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
            }
            $this->forward('lessenbeheer','instructeur');
    }
    
    protected function wijzigAction() {
        if($this->model->isPostLeeg()) {
           $this->view->set("boodschap","Wijzig hier je  gegevens");
           $les = $this->model->getLes();
           $this->view->set("les",$les);
        } else {
            $result = $this->model->wijzigLes();
            switch($result){
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','wijziging gelukt');
                    $this->forward('lessenbeheer','instructeur');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","De gegevens waren incompleet. Vul compleet in!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
            }   
        }
       $gebruiker = $this->model->getGebruiker();
       $this->view->set("gebruiker",$gebruiker);
    }
    
    protected function toevoegenAction() {
        if($this->model->isPostLeeg()) {
           $this->view->set("boodschap","Voeg hier een les toe");
        } else {
            $result = $this->model->voegLesToe();
            switch($result){
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','Les toevoegen gelukt!');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","Niet alles goed ingevuld");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
            }   
        }
       $gebruiker = $this->model->getGebruiker();
       $this->view->set("gebruiker",$gebruiker);
    }
}