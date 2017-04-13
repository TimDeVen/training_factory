<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container" style="text-align: justify;">
    <div class="row">
        <div class="col-xs-12">
            <h3>U bent ingelogd als <?php echo $gebruiker->getRole(); ?></h3>
            <p>De administrateur, of een van zijn/haar medewerkers, verwerkt alle binnengekomen financiële documenten in de boekhouding van het bedrijf.
                Tegenwoordig gebeurt dit bijna altijd door middel van een geautomatiseerde boekhouding.
                Hiervoor zijn diverse gespecialiseerde softwarepakketten die gebruikt kunnen worden.
                Alle uitgaande en binnengekomen facturen worden ingeboekt in de debiteuren- en crediteurenadministratie.
                De bankafschriften worden verwerkt in de kas-, bank- en giroboeken.</p>
        </div>
    </div>
</div>
<div class="hidden-thing"></div>

<div style="clear:both;"></div>

</body>
<?php include 'includes/footer.php'; ?>
