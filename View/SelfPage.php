<?php
  isset($_COOKIE["email"])? $email=$_COOKIE["email"] : $email=null;



?>

<!DOCTYPE html>
<head>
  <title>Groups!</title>
  <script type="text/javascript" src="/plugin/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="/plugin/bootstrap/dist/js/bootstrap.min.js"></script>
  <link type = "text/css" href = "/plugin/bootstrap/dist/css/bootstrap.css" rel = "stylesheet"/>
</head>

<body data-spy="scroll" data-target="group-index">
<div class="navbar  navbar-default">
    <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand hidden-sm" href="homepage.php">Homepage</a>
      </div>
      <div role="navigation">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="travelnotes.php">Notes</a>
          </li>
          <li>
            <a href="skimgroup.php">Group</a>
          </li>
          <li>

          	<?php
              if($email==null){
                echo "<a href='sign.php'>Sign in/up</a>";
              }
              else{
                echo "<a href='userpage.php?email=$email'>$email</a>";
              }
            ?>       
          
          </li>
        </ul>
      </div>
  </div>
</div>

<div class="group-spot bg-info">
  <div class="container">
    <h1>Travel!</h1>
    <p>Travel spotlight balabala</p>
  </div>
</div>

<div class="navbar navbar-default" role="navigation">
<div class="container">
  <ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rank</a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li class="divider"></li>            
            <li><a href="#">Something else here</a></li>
        </ul>
    </li>
  </ul>
</div>
</div>




<div class="navbar navbar-default">
  <h5 class="text-center">@Summer</h5>
</div>  

</body>
</html>

