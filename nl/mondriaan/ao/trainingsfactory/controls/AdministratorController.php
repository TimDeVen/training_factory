<?php
namespace framework\controllers;

use framework\utils\Foto as FOTO;
    
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
        $contacten = $this->model->getContacten();
        $this->view->set('contacten', $contacten);
    }
    
    protected function beheerAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        $contacten = $this->model->getContacten();
        $this->view->set('contacten', $contacten);
        $afdelingen = $this->model->getAfdelingen();
        $this->view->set('afdelingen', $afdelingen);
    }
    
    protected function addAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("msg","Vul gegevens in van een nieuwe member");
        }
        else
        {   
            $result=$this->model->addContact();
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
        $afdelingen = $this->model->getAfdelingen();
        $this->view->set('afdelingen',$afdelingen);
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }
    
    protected function deleteAction()
    {
        $result = $this->model->deleteContact();
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
        if($this->model->isPostLeeg())
        {
           $this->view->set("msg","Wijzig hier je  gegevens");
        }
        else
        {
            $result = $this->model->wijzigAnw();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('msg','wijziging gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("msg","De gegevens waren incompleet. Vul compleet in!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("msg","Er was niets te wijzigen");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("msg","gebruikersnaam is al in gebruik, kies een andere waarde.");
                    break;
            }   
        }
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
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