<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




    <div class="container" style="text-align: justify;">
        <h2>Alle trainingsvormen</h2>
        <?php if (isset($boodschap)) { ?>
            <div class="alert alert-info">
                <strong>Melding!</strong> <?php echo $boodschap; ?>
            </div>
        <?php } ?>
        <table class="table">
            <thead>
            <tr>
                <th>Description</th>
                <th>Duration</th>
                <th>Extra_costs</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($trainingsvormen as $trainingsvorm) {?>
                <tr>
                    <td><?php echo $trainingsvorm->getDescription(); ?></td>
                    <td><?php echo $trainingsvorm->getDuration(); ?> Minutes</td>
                    <td><?php echo $trainingsvorm->getExtra_costs(); ?></td>
                    <td><a href="?control=administrator&action=anwTrainingsvorm&id=<?php echo $trainingsvorm->getId();?>">View</a></td>
                    <td><a href="?control=administrator&action=deleteTrainingsvorm&id=<?php echo $trainingsvorm->getId(); ?>">Delete</a></td>
                </tr>
            <?php }
            ?>
            <tr>
                <td>
                    <a href="?control=administrator&action=addTrainingsvorm">Add</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="hidden-thing"></div>

    <div style="clear:both;"></div>

    </body>
<?php include 'includes/footer.php'; ?>