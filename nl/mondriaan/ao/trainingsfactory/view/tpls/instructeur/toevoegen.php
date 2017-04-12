<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

  <?php if (isset($boodschap)) { ?>
  <div class="alert alert-info"> 
    <strong>Melding!</strong> <?php echo $boodschap; ?>    
  </div>
  <?php } ?>
<div class="container" style="text-align: justify;">
    <div class="row">
        <form action="" method="POST">
            <div class="form-group row">
                <label for="datum" class="col-2 col-form-label">Datum</label>
                <div class="col-10">
                    <input class="form-control" name="datum" type="date" id="datum">
                </div>
            </div>
            <div class="form-group row">
                <label for="tijd" class="col-2 col-form-label">Tijd</label>
                <div class="col-10">
                    <input class="form-control" type="number" name="tijd" id="tijd">
                </div>
            </div>
            <div class="form-group row">
                <label for="locatie" class="col-2 col-form-label">Locatie</label>
                <div class="col-10">
                    <input class="form-control" type="text" name="locatie" id="locatie">
                </div>
            </div>
                <div class="form-group row">
                <label for="maxpers" class="col-2 col-form-label">Max personen</label>
                <div class="col-10">
                    <input class="form-control" name="maxpers" type="number" id="maxpers">
                </div>
            </div>
            <input type="submit" value="Voeg toe" class="btn btn-primary">
        </form>
    </div>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php// include 'includes/footer.php'; ?>