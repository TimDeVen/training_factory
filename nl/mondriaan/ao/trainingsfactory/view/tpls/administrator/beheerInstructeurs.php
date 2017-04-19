<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <h2>Beheer Instructeurs</h2>
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
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($instructeurs as $instructeur) {?>
            <tr>
                <td> <?php echo $instructeur->getName(); ?></td>
                <td> <?php echo $instructeur->getLoginname(); ?></td>
                <td> <?php echo $instructeur->getPlace(); ?></td>
                <td> <?php echo $instructeur->getEmailadress(); ?></td>
                <td> <?php echo $instructeur->getRole(); ?></td>
                <td><a href="?control=administrator&action=anw&id=<?php echo $instructeur->getId(); ?>" >View</a></td>
                <td><a href="?control=administrator&action=delete&id=<?php echo $instructeur->getId(); ?>" >Delete</a></td>
            </tr>
        <?php }
        ?>
        <tr>
            <td>
            <a href="?control=administrator&action=addInstructeur">Add</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php include 'includes/footer.php'; ?>