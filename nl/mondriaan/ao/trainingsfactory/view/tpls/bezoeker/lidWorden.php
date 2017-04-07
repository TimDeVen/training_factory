<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Training Factory</title>
</head>
<body>
    
<style>
.form-control{
    margin-top: 15px;
    width: 75%;
}
.btn-group-lg>.btn, .btn-lg {
    margin-top: 15px;
    padding: 2px !important; 
    width: 75%;
}

.placing{
    padding-left:300px;
    padding-right:0px;
}

#titelh {
    font-family: fantasy !important;
    font-size: 36px;
}

input[type=submit].btn-block {
    width: 75%;
}
</style>

  
<div class="row">
    <div class="col-xs-6 col-md-4">
        <img src="img/fight.png" alt="Training Centrum Den Haag" width="250px" height="200px"/>
    </div>

    <div class="col-xs-6 col-md-4">
        <center><div id="titelh">Training Centrum<br/>Den Haag</div></center>
    </div>

    <div class="col-xs-6 col-md-4 placing">
        <form action="" method="POST">       
          <input type="text" class="form-control" name="gn" placeholder="login name" required="" autofocus="" />
          <input type="password" class="form-control" name="ww" placeholder="Password" required=""/>      

          <input class="btn btn-lg btn-secondary btn-block" type="submit" value="Log in">  
          <input class="btn btn-lg btn-secondary btn-block" type="submit" value="Reset WW">
        </form>
    </div>
    
</div>
    
<nav class="navbar navbar-default">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li><a href="?control=bezoeker&action=default">Home</a></li>
      <li><a href="#">Trainings Aanbod</a></li>
      <li class="active"><a href="?control=bezoeker&action=lidWorden">Lid worden</a></li>
      <li><a href="#">Gedrags regels</a></li>
      <li><a href="#">Locatie & Contact</a></li>
    </ul>
  </div>
</nav>


<div class="row">
    <div class="col-xs-6 col-md-4">
        <center><img src="img/vechtsport1.jpg" alt="" width="250px" height="200px"/></center>
        
    </div>

    <div class="col-xs-6 col-md-4">
        <img src="img/vechtsport2.jpg" alt="" width="500px" height="200px"/>
    </div>

    <div class="col-xs-6 col-md-4">
        <center><img src="img/vechtsport3.jpg" alt="" width="250px" height="200px"/></center>
    </div>
    
</div>


  
<div class="container">
  <h3>Lid Worden</h3>
  <p>
    
  </p>
</div>
    
</body>
</html>