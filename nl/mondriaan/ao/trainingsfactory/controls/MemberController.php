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
    }
    protected function inschrijvenAction()
    {
      $gebruiker = $this->model->getGebruiker();
      $this->view->set("gebruiker",$gebruiker);
      
      
    }

    protected function gegevenswijzigenAction()
    {
      $gebruiker = $this->model->getGebruiker();
      $this->view->set("gebruiker",$gebruiker);
    }
}
