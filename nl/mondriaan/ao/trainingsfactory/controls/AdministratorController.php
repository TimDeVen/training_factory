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
    
    protected function addInstructeurAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Vul gegevens in van een nieuwe member");
        }
        else
        {   
            $result=$this->model->addInstructeur();
            switch($result)
            {
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Foto te groot. Kies kleinere foto.");
                    $this->view->set('form_data',$_POST);
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. foto niet van jpg, gif of png formaat.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Niet alle vereiste data ingevuld.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap", "Contact is niet toegevoegd. Er is foutieve data ingestuurd (bv gebruikersnaam bestaat al).");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap", "Contact is toegevoegd.");
                    $this->forward("beheerInstructeurs");
                    break;  
            }  
        }

        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
    }

    protected function addTrainingsvormAction()
    {
        if($this->model->isPostLeeg())
        {
            $this->view->set("boodschap","Vul gegevens in van een nieuwe training");
        }
        else
        {
            $result=$this->model->addTrainingsvorm();
            switch($result)
            {
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("boodschap", "training is niet toegevoegd. Foto te groot. Kies kleinere foto.");
                    $this->view->set('form_data',$_POST);
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("boodschap", "training is niet toegevoegd. foto niet van jpg, gif of png formaat.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap", "training is niet toegevoegd. Niet alle vereiste data ingevuld.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap", "training is niet toegevoegd. Er is foutieve data ingestuurd.");
                    $this->view->set('form_data',$_POST);
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap", "training is toegevoegd.");
                    $this->forward("beheerTrainingsvormen");
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
                $this->view->set('boodschap','geen te verwijderen contact gegeven, dus niets verwijderd');
                break;
            case REQUEST_FAILURE_DATA_INVALID:
                $this->view->set('boodschap','te verwijderen contact bestaat niet');
                break;
            case REQUEST_NOTHING_CHANGED:
                 $this->view->set('boodschap','Er is niets verwijderd reden onbekend.');
                break;
            case REQUEST_SUCCESS:
                $this->view->set('boodschap','Contact verwijderd.');
                break;
        }
        $this->forward('beheer');
    }

    protected function deleteTrainingsvormAction()
    {
        $result = $this->model->deleteTrainingsvorm();
        switch($result)
        {
            case REQUEST_FAILURE_DATA_INCOMPLETE:
                $this->view->set('boodschap','geen te verwijderen contact gegeven, dus niets verwijderd');
                break;
            case REQUEST_FAILURE_DATA_INVALID:
                $this->view->set('boodschap','te verwijderen contact bestaat niet');
                break;
            case REQUEST_NOTHING_CHANGED:
                $this->view->set('boodschap','Er is niets verwijderd reden onbekend.');
                break;
            case REQUEST_SUCCESS:
                $this->view->set('boodschap','Contact verwijderd.');
                break;
        }
        $this->forward('beheerTrainingsvormen');
    }
    
    protected function fotoAction(){
        
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Wijzig hier je foto");
        }
        else{
            $afbeeldingInfo = FOTO::isAfbeeldingGestuurd();
            switch($afbeeldingInfo)
            {
                case IMAGE_NOTHING_UPLOADED:
                    $this->view->set("boodschap","er is helemaal geen upload gedaan!!");
                    break;
                case IMAGE_FAILURE_SIZE_EXCEEDED:
                    $this->view->set("boodschap","het door juow ge-uploade bestand is te groot!!");
                    break;
                case IMAGE_FAILURE_TYPE:
                    $this->view->set("boodschap","het door jou geuploade bestand is geen afbeelding (jpg, png, gif)!!");
                    break;
                case IMAGE_SUCCES:
                    $result = $this->model->wijzigFoto();
                    switch($result)
                    {
                        case REQUEST_NOTHING_CHANGED:
                        case IMAGE_FAILURE_SAVE_FAILED:
                            $this->view->set('boodschap','er is een serverfout, de afbeelding kan niet opgeslagen worden.');
                            break;
                        case REQUEST_SUCCESS:
                            $this->view->set('boodschap','de foto is succesvol gewijzigd');
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

    protected function anwTrainingsvormAction()
    {
        if($this->model->isPostLeeg())
        {
            $this->view->set("boodschap","Wijzig hier je  gegevens");
        }
        else
        {
            $result = $this->model->wijzigAnwTrainingsvorm();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','wijziging gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","De gegevens waren incompleet. Vul compleet in!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap","gebruikersnaam is al in gebruik, kies een andere waarde.");
                    break;
            }
        }
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);

        $training = $this->model->getTrainingsvorm();
        $this->view->set('training',$training);

    }


    
    protected function wwAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);
        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Wijzig hier je wachtwoord");
        }
        else
        {
            $result = $this->model->wijzigWw();
            switch($result)
            {
                case REQUEST_SUCCESS:
                    $this->view->set('boodschap','wijziging wachtwoord gelukt');
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap","nieuwe wachtwoord niet identiek of oude wachtwoord fout. Poog opnieuw!");
                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("boodschap","Niet alle velden ingevuld!");
                    break;
                case REQUEST_NOTHING_CHANGED:
                    $this->view->set("boodschap","Er was niets te wijzigen");
                    break;
            } 
        }
    }

    protected function beheerInstructeursAction()
    {

        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);

        $instructeurs = $this->model->getInstructeurs();
        $this->view->set('instructeurs',$instructeurs);
    }

    protected function beheerTrainingsvormenAction()
    {

        $gebruiker = $this->model->getGebruiker();
        $this->view->set('gebruiker',$gebruiker);

        $trainingsvormen = $this->model->getTrainingsvormen();
        $this->view->set('trainingsvormen',$trainingsvormen);
    }
}