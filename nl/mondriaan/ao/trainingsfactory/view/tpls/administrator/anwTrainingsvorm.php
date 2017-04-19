<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <h2>Details van <?php echo $training->getDescription(); ?></h2>
    <?php if (isset($boodschap)) { ?>
        <div class="alert alert-info">
            <strong>Melding!</strong> <?php echo $boodschap; ?>
        </div>
    <?php } ?>
    <form method="POST" action="">
        <table class="table">
            <thead>
            <tr>
                <th>Description</th>
                <th>Duration</th>
                <th>Extra costs</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="description" placeholder="vul optioneel een intern nummer in." value="<?= $training->getDescription();?>"></td>
                    <td><input type="number" name="duration" placeholder="vul optioneel een intern nummer in." value="<?= $training->getDuration();?>" ></td>
                    <td><input type="number" name="extra_costs" placeholder="vul optioneel een intern nummer in." value="<?= $training->getExtra_costs();?>"></td>
                </tr>
            </tbody>
        </table>
        <div>
            <input type="submit" value="verstuur" />
            <input type="reset" value ="reset" />
        </div>
    </form>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php include 'includes/footer.php'; ?>