<?php
    namespace framework\controllers;
    
    use framework\models as MODELS;
    use framework\view as VIEW;

class MedewerkerController extends AbstractController
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
}
