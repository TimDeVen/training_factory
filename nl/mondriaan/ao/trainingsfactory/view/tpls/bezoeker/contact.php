<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>




<div class="container">
  <h3>Contact en Locatie</h3>
  <p>
    <strong>Training centrum Den Haag </strong><br>
    Alphons Diepenbrockhof 1<br>
    2551 KE Den Haa<br>
    info@trainingcentrumdenhaag.nl<br>
    06-22785904<br>
  </p>
    <div id="map"></div>
    <script>
      function initMap() {
        var trainingsfactory = {lat: 52.059630, lng: 4.231231};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: trainingsfactory
        });
        var marker = new google.maps.Marker({
          position: trainingsfactory,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3mwtaNY6AQBugGk0XZvTtdMkgmwgj3fo&callback=initMap">
    </script>


</div>

</body>
</html>
<?php include 'includes/footer.php'; ?>
