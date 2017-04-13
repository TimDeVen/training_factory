<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <h2>Lessenbeheer</h2>
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
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lessen as $les) {?>
            <tr>
                <td> <?php echo $les->getDate(); ?></td>
                <td> <?php echo $les->getLocation(); ?></td>
                <td> <?php echo $les->getTime(); ?></td>
                <td> <?php echo $les->getMaxPersons(); ?></td>
                <td><a href="?control=instructeur&action=verwijder&id=<?php echo $les->getId(); ?>" >Verwijder</a></td>
                <td><a href="?control=instructeur&action=wijzig&id=<?php echo $les->getId(); ?>" >Wijzig</a></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>