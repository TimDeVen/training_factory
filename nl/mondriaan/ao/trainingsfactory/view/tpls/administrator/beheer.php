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
            <th>Role</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user) {?>
            <tr>
                <td> <?php echo $user->getName(); ?></td>
                <td> <?php echo $user->getLoginname(); ?></td>
                <td> <?php echo $user->getPlace(); ?></td>
                <td> <?php echo $user->getEmailadress(); ?></td>
                <td> <?php echo $user->getRole(); ?></td>
                <td><a href="?control=administrator&action=anw&id=<?php echo $user->getId(); ?>" >View</a></td>
                <td><a href="?control=administrator&action=delete&id=<?php echo $user->getId(); ?>" >Delete</a></td>
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