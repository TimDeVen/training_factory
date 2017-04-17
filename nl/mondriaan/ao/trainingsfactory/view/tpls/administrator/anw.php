<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <h2>Details van <?php echo $lid->getName(); ?></h2>
    <?php if (isset($boodschap)) { ?>
        <div class="alert alert-info">
            <strong>Melding!</strong> <?php echo $boodschap; ?>
        </div>
    <?php } ?>
    <table class="table">
        <thead>
        <tr>
            <th>Naam</th>
            <th>gebruikersnaam</th>
            <th>place</th>
            <th>emailadress</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?php echo $lid->getName(); ?></td>
                <td> <?php echo $lid->getLoginname(); ?></td>
                <td> <?php echo $lid->getPlace(); ?></td>
                <td> <?php echo $lid->getEmailadress(); ?></td>
                <td> <?php echo $lid->getRole(); ?></td>
            </tr>
        </tbody>
    </table>
    <br/>
    <br/>
    <br/>
    <h2>Ingeschreven lessen</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Soort</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Prijs</th>
            <th>Max deelnemers</th>
            <th>Betaald</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lessen as $les) {?>
            <tr>
                <td> <?php echo $les->soort; ?></td>
                <td> <?php echo $les->datum; ?></td>
                <td> <?php echo $les->tijd; ?></td>
                <td> <?php echo $les->prijs; ?></td>
                <td> <?php echo $les->max_deelnemers; ?></td>
                <?php if ($les->betaald == 0): ?>
                   <td>nee</td>
                <?php else:?>
                <td>Ja</td>
                <?php endif; ?>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php include 'includes/footer.php'; ?>