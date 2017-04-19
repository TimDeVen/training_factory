<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>


<div class="container">
    <?php if (isset($boodschap)) { ?>
        <div class="alert alert-info">
            <strong>Melding!</strong> <?php echo $boodschap; ?>
        </div>
    <?php } ?>
    <h3>Add een instructeur</h3>
    <p>
        Voeg door dit formulier in te vullen een instructeur toe. <br/>
    </p>


    <form class="form-horizontal" role="form" method="POST" action="">
        <h2>Instructeur</h2>

        <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
                <input name="description" type="text" id="firstname" placeholder="" class="form-control" autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="preprovision" class="col-sm-3 control-label">Duration</label>
            <div class="col-sm-9">
                <input name="duration" type="number" id="preprovision" placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">Extra costs</label>
            <div class="col-sm-9">
                <input name="extra_costs" type="number" id="lastname" placeholder="" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block buttonaanpassing">Maak training aan</button>
            </div>
        </div>
    </form>

</div>

</body>

<?php include 'includes/footer.php'; ?>
