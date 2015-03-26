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
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-sm" href="homepage.php">Travel</a>
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
            <a href="javascript:void(0)">Search</a>
          </li>
          <li>
          	<a href="">Sign in/up</a>        
          </li>
        </ul>
      </div>
  </div>
</div>

<div class="group-spot bg-info">
  <div class="container">
    <h1>Groups!</h1>
    <p>Groups spotlight balabala</p>
  </div>
</div>

<div class="container">
  <div class="col-md-5">
    <div>
      <h4><span class="glyphicon glyphicon-th"></span>Sign up</h4>
    </div>
    <form method="post" action="../Controller/SignAction.php?act=up">
      <div class="form-group">
        <label for="sign-up-email">Email</label>
        <input type="email" class="form-control" placeholder="Email Address" id="sign-up-email" name="sign-up-email"/>
      </div>
      <div class="form-group">
        <label for="sign-up-nickname">Nickname</label>
        <input type="text" class="form-control" placeholder="Nickname" id="sign-up-nickname" name="sign-up-nickname"/>
      </div>
      <div class="form-group">
        <label for="sign-up-password">Password</label>
        <input type="password" class="form-control" placeholder="Password" id="sign-up-password" name="sign-up-password"/>
      </div>
      <div>
        <button type="submit" class="btn btn-default">Submitttt</button>
      </div>
    </form>
  </div>
  <div class="col-md-1">

  </div>
  <div class="col-md-5">
    <div>
      <h4><span class="glyphicon glyphicon-th"></span>Sign in</h4>
    </div>
    <form method="post" action="../Controller/SignAction.php?act=in">
      <div class="form-group">
        <label for="sign-up-email">Email</label>
        <input type="email" class="form-control" placeholder="Email Address" id="sign-in-email" name="sign-in-email"/>
      </div>
      <div class="form-group">
        <label for="sign-up-password">Password</label>
        <input type="password" class="form-control" placeholder="Password" id="sign-in-password" name="sign-in-password"/>
      </div>
      <div>
        <button type="submit" class="btn btn-default">Submitttt</button>
      </div>
    </form>
  </div>
</div>

<div class="navbar navbar-default">
  <h5 class="text-center">@Summer</h5>
</div>  

</body>
</html>

