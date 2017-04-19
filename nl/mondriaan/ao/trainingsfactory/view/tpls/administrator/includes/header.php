<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/administrator.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <title>Training Factory</title>
</head>
<body>
    <div class="row">
        <div class="col-xs-6 col-md-4">
            <img src="img/fight.png" alt="Training Centrum Den Haag" width="250px" height="200px"/>
        </div>

        <div class="col-xs-6 col-md-4">
            <center><div id="titelh">Training Centrum<br/>Den Haag</div></center>
        </div>

        <div class="col-xs-6 col-md-4 placing">
            <?php echo $gebruiker->getName(); ?><br/>
            <?php echo $gebruiker->getRole(); ?><br/>
            <a href="?control=member&action=uitloggen"><input class="btn btn-lg btn-secondary btn-block" type="submit" value="Uitloggen"></a>
        </div>

    </div>
