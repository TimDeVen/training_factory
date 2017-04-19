<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <div class="row">
        <div class="col-xs-6">
            <h3>Gegevens Lid Wijzigen</h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="">
           <h2>Wijzigen</h2>

           <div class="form-group">
               <label for="firstname" class="col-sm-3 control-label">Voornaam</label>
               <div class="col-sm-9">
                   <input name="firstname" type="text" id="firstname" value="<?= $gebruiker->getFirstname() ?>" placeholder="" class="form-control" autofocus>
               </div>
           </div>

           <div class="form-group">
               <label for="preprovision" class="col-sm-3 control-label">Tussenvoegsel</label>
               <div class="col-sm-9">
                   <input name="preprovision" type="text" id="preprovision" value="<?= $gebruiker->getPreprovision()?>"  placeholder="" class="form-control">
               </div>
           </div>

           <div class="form-group">
               <label for="lastname" class="col-sm-3 control-label">Achternaam</label>
               <div class="col-sm-9">
                   <input name="lastname" type="text" id="lastname" placeholder="" value="<?= $gebruiker->getLastname()?>"  class="form-control">
               </div>
           </div>

           <div class="form-group">
               <label for="dateofbirth" class="col-sm-3 control-label">Geboortedatum</label>
               <div class="col-sm-9">
                   <input name="dateofbirth" type="date" id="dateofbirth" value="<?= $gebruiker->getDateofbirth()?>" placeholder="" class="form-control">
               </div>
           </div>

           <div class="form-group">
               <label for="loginname" class="col-sm-3 control-label">Gebruikersnaam</label>
               <div class="col-sm-9">
                   <input name="loginname" type="text" id="loginname" value="<?= $gebruiker->getLoginname()?>" placeholder="" class="form-control">
                   <p>Dit is je login naam</p>
               </div>
           </div>

           <div class="form-group">
               <label for="password" class="col-sm-3 control-label">Wachtwoord</label>
               <div class="col-sm-9">
                   <input name="password" type="text" id="password" value="<?= $gebruiker->getPassword()?>" placeholder="" class="form-control">
                   <p>Dit is je wachtwoord waarmee je inlogt</p>
               </div>
           </div>

           <div class="form-group">
               <label class="control-label col-sm-3">Geslacht</label>
               <div class="col-sm-6">
                   <div class="row">
                       <div class="col-sm-4">
                           <label class="radio-inline">
                               <input name="gender" type="radio" id="Woman" value="Woman" <?= $gebruiker->getGender() === "Woman" ? "checked" : "";?>>Vrouw
                           </label>
                       </div>
                       <div class="col-sm-4">
                           <label class="radio-inline">
                               <input name="gender" type="radio" id="Man" value="Man" <?= $gebruiker->getGender() === "Man" ? "checked" : "";?>>Man
                           </label>
                       </div>
                   </div>
               </div>
           </div>

           <div class="form-group">
               <label for="street" class="col-sm-3 control-label">Straat</label>
               <div class="col-sm-9">
                   <input name="street" type="text" value="<?= $gebruiker->getStreet()?>" id="street" placeholder="" class="form-control" autofocus>
               </div>
           </div>

           <div class="form-group">
               <label for="postal_code" class="col-sm-3 control-label">Postcode</label>
               <div class="col-sm-9">
                   <input name="postal" type="text" id="postal_code" value="<?= $gebruiker->getPostal_code()?>" placeholder="" class="form-control" autofocus>
               </div>
           </div>

           <div class="form-group">
               <label for="place" class="col-sm-3 control-label">Stad</label>
               <div class="col-sm-9">
                   <input name="place" type="text" id="place" value="<?= $gebruiker->getPlace()?>" placeholder="" class="form-control" autofocus>
               </div>
           </div>

           <div class="form-group">
               <label for="emailadress" class="col-sm-3 control-label">Email</label>
               <div class="col-sm-9">
                   <input name="email" type="email" id="emailadress" value="<?= $gebruiker->getEmailadress()?>" placeholder="" class="form-control" autofocus>
               </div>
           </div>

               <div class="form-group">
                   <div class="col-sm-9 col-sm-offset-3">
                       <button type="submit" class="btn btn-primary btn-block buttonaanpassing">Registreer</button>
                   </div>
               </div>
           </form>
    </div>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php include 'includes/footer.php'; ?>
