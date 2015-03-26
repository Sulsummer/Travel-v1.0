<?php

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

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="group-index">
				<ul class="nav" role="tablist">
					<li>
						<a href="#GroupName">GroupName</a>
					</li>
					<li>
						<a href="#Label">Label</a>
					</li>
					<li>
						<a href="#Destination">Destination</a>
					</li>
					<li>
						<a href="#Time">Time</a>
					</li>
					<li>
						<a href="#Members">Members</a>
					</li>
				</ul>
			</div>
		</div>
		
    <div class="col-md-9">
			<div class="group-setting">
        <div id="GroupName">
          <div>
            <h3>Group Name</h3>
          </div>
          <form method="GET" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div class="input-group input-group-lg">
              <input type="text" class="form-control" placeholder="Group Name" name="group_name">
              <button type="submit" class="btn btn-default">Confirm</button>
            </div>
          </form>
        </div>
        <hr>
        <div id="Label">
          
        </div>
        <hr>
        <div id="Destination">
       
      
        </div>
        <hr>
        <div id="Time">
        </div>
        <hr>
        <div id="Member">
        </div>
      </div>
		</div>
	</div>
</div>


<footer id = "footer">
	<div class="navbar navbar-default">
		<h5 class="text-center">@Summer</h5>
	</div>	
</footer>
</body>
</html>





