<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>


<div class="container">
    <?php if (isset($boodschap)) { ?>
        <div class="alert alert-info">
            <strong>Melding!</strong> <?php echo $boodschap; ?>
        </div>
    <?php } ?>
  <h3>Lid Worden</h3>
  <p>
      Om gebruik te kunnen maken van de lessen moet je bij ons bekend zijn.<br/>
      Vul hieronder alle gegevens in en registreer jezelf.
  </p>


 <form class="form-horizontal" role="form" method="POST" action="">
    <h2>Registreren</h2>

    <div class="form-group">
        <label for="firstname" class="col-sm-3 control-label">Voornaam</label>
        <div class="col-sm-9">
            <input name="firstname" type="text" id="firstname" placeholder="" class="form-control" autofocus>
        </div>
    </div>

    <div class="form-group">
        <label for="preprovision" class="col-sm-3 control-label">Tussenvoegsel</label>
        <div class="col-sm-9">
            <input name="preprovision" type="text" id="preprovision" placeholder="" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-3 control-label">Achternaam</label>
        <div class="col-sm-9">
            <input name="lastname" type="text" id="lastname" placeholder="" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label for="dateofbirth" class="col-sm-3 control-label">Geboortedatum</label>
        <div class="col-sm-9">
            <input name="dateofbirth" type="date" id="dateofbirth" placeholder="" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label for="loginname" class="col-sm-3 control-label">Gebruikersnaam</label>
        <div class="col-sm-9">
            <input name="loginname" type="text" id="loginname" placeholder="" class="form-control">
            <p>Dit is je login naam</p>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Wachtwoord</label>
        <div class="col-sm-9">
            <input name="password" type="text" id="password" placeholder="" class="form-control">
            <p>Dit is je wachtwoord waarmee je inlogt</p>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Geslacht</label>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input name="gender" type="radio" id="Woman" value="Woman">Vrouw
                    </label>
                </div>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input name="gender" type="radio" id="Man" value="Man">Man
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="street" class="col-sm-3 control-label">Straat</label>
        <div class="col-sm-9">
            <input name="street" type="text" id="street" placeholder="" class="form-control" autofocus>
        </div>
    </div>

    <div class="form-group">
        <label for="postal_code" class="col-sm-3 control-label">Postcode</label>
        <div class="col-sm-9">
            <input name="postal" type="text" id="postal_code" placeholder="" class="form-control" autofocus>
        </div>
    </div>

    <div class="form-group">
        <label for="place" class="col-sm-3 control-label">Stad</label>
        <div class="col-sm-9">
            <input name="place" type="text" id="place" placeholder="" class="form-control" autofocus>
        </div>
    </div>

    <div class="form-group">
        <label for="emailadress" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input name="email" type="email" id="emailadress" placeholder="" class="form-control" autofocus>
        </div>
    </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block buttonaanpassing">Registreer</button>
            </div>
        </div>
    </form>

</div>

</body>

<?php include 'includes/footer.php'; ?>
