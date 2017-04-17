<?php
namespace nl\mondriaan\ao\trainingsfactory\controls;

use ao\php\framework\controls\AbstractController;
    
class AdministratorController extends AbstractController
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
        $this->view->set('gebruiker',$gebruiker);
    }
    
    protected function beheerAction()
    {
        $lessen = $this->model->getIngeschrevenLessen();
        $this->view->set('lessen',$lessen);

        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);

        $users = $this->model->getUsers();
        $this->view->set('users',$users);
    }
    
    protected function addAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("msg","Vul gegevens in van een nieuwe member");
        }
        else
        {   
            $result=$this->model->addUser();
            switch($result)
            {
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("msg", "Contact is niet toegevoegd. Foto te groot. Kies kleinere foto.");
                    $this->view->set('form_data',$_POST);
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("msg", "Contact is niet toegevoegd. foto niet van jpg, gif of png formaat.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("msg", "Contact is niet toegevoegd. Niet alle vereiste data ingevuld.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("msg", "Contact is niet toegevoegd. Er is foutieve data ingestuurd (bv gebruikersnaam bestaat al).");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("msg", "Contact is toegevoegd.");
                    $this->forward("beheer");
                    break;  
            }  
        }

        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    protected function deleteAction()
    {
        $result = $this->model->deleteUser();
        switch($result)
        {
            case REQUEST_FAILURE_DATA_INCOMPLETE:
                $this->view->set('msg','geen te verwijderen contact gegeven, dus niets verwijderd');
                break;
            case REQUEST_FAILURE_DATA_INVALID:
                $this->view->set('msg','te verwijderen contact bestaat niet');
                break;
            case REQUEST_NOTHING_CHANGED:
                 $this->view->set('msg','Er is niets verwijderd reden onbekend.');
                break;
            case REQUEST_SUCCESS:
                $this->view->set('msg','Contact verwijderd.');
                break;
        }
        $this->forward('beheer');
    }
    
    protected function fotoAction(){
        
        if($this->model->isPostLeeg())
        {
           $this->view->set("msg","Wijzig hier je foto");
        }
        else{
            $afbeeldingInfo = FOTO::isAfbeeldingGestuurd();
            switch($afbeeldingInfo)
            {
                case IMAGE_NOTHING_UPLOADED:
                    $this->view->set("msg","er is helemaal geen upload gedaan!!");
                    break;
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("msg","het door juow ge-uploade bestand is te groot!!");
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("msg","het door jou geuploade bestand is geen afbeelding (jpg, png, gif)!!");
                    break;
                case IMAGE_SUCCES:
                    $result = $this->model->wijzigFoto();
                    switch($result)
                    {
                        case REQUEST_NOTHING_CHANGED:
                        case IMAGE_FAILURE_SAVE_FAILED:
                            $this->view->set('msg','er is een serverfout, de afbeelding kan niet opgeslagen worden.');
                            break;
                        case REQUEST_SUCCESS:
                            $this->view->set('msg','de foto is succesvol gewijzigd');
                            $this->forward ('default');
                    }
                    break;
            }
        }
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    protected function anwAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);

        $lid = $this->model->getLid();
        $this->view->set('lid',$lid);

        $lessen = $this->model->getIngeschrevenLessen();
        $this->view->set('lessen',$lessen);
    }
    
    protected function wwAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        if($this->model->isPostLeeg())
        {
           $this->view->set("msg","Wijzig hier je wachtwoord");
        }
        else
        {
            $result = $this->model->wijzigWw();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('msg','wijziging wachtwoord gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("msg","nieuwe wachtwoord niet identiek of oude wachtwoord fout. Poog opnieuw!");
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("msg","Niet alle velden ingevuld!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("msg","Er was niets te wijzigen");
                    break;
            } 
        }
    }
}