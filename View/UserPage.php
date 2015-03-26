<?php
  include_once("../Demo/User.php");
  use Demo\User;
  include_once("../Demo/Group.php");
  use Demo\Group;
  
  isset($_COOKIE["email"])? $email=$_COOKIE["email"] : $email=null;
  if($email == null){
    header("Location:homepage.php");
    exit();
  }

  if($_GET["email"] == $email){
    header("Location:selfpage.php");
    exit();
  }

//User
  $newUser = new User($_GET["email"]);
  $user = $newUser->user;
  $userId = $user["u_id"];
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


<div class="container">
  <div class="row">
    

    <div class="col-md-3">
      <div class="user-index">
        <ul class="nav" role="tablist">
          <li>
            <a href="#UserBase">Base Info</a>
          </li>
          <li>
            <a href="#UserFriends">Friends</a>
          </li>
          <li>
            <a href="#UserOwnedGroup">Owned Groups</a>
          </li>
          <li>
            <a href="#UserJoinedGroup">Joined Groups</a>
          </li>
        </ul>
      </div>
    </div>


    <div class="col-md-9">
      <div class="user-info">
        <hr>
        <div id="UserBase">
          <h3>Base Info</h3>
          <form method="post" action="../Controller/PraiseAction.php?p=user&id=<?php echo $userId; ?>">
              <button type="submit" class="btn btn-info">Praise this guy</button>
          </form>
          <br>
          <div class="panel panel-info">
            <div class="panel-heading">Nickname</div>
              <div class="panel-body">
                <div class="col-md-6">    
                    <?php
                      echo $user["nickname"];
                    ?>
                  <span class="badge">
                    <span class="glyphicon glyphicon-thumbs-up">
                      <?php
                        echo $user["popularity"];
                      ?>
                    </span>
                  </span>
                </div>
              </div>
              <div class="panel-heading">Email</div>
              <div class="panel-body">
                <?php
                  echo $user["email"];
                ?>
              </div>
              <div class="panel-heading">Be Friend</div>
              <div class="panel-body">
                <form method="post" action="">
                  <button type="submit" class="btn btn-danger">Be Friend</button>

                </form>
                <?php
                  
                ?>
              </div>
          </div>
        </div>
      </div>
    


      <div class="user-friends">
        <hr>
        <div id="UserFriends">
          <h3>Friends</h3>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">All Friends are Here!</div>
              <div class="panel-body">
                <?php
                  for($i = 0; $i < $friendsCount; $i ++){
                    $friendEmail = $friendsInfo[$i]["email"];
                    $friendNickname = $friendsInfo[$i]["nickname"];
                    echo "<a href='userpage.php?email=$friendEmail'>$friendNickname</a>";
                    echo "<hr>";
                  }
                ?>
              </div>
            </div>
      </div>


      <div class="user-owned-group">
        <hr>
        <div id="UserOwnedGroup">
          <h3>Owned Groups</h3>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">All Groups are Here!</div>
              <div class="panel-body">
                <?php
                  for($i = 0; $i < count($ownedGroup); $i ++){
                    $ownedGroupId = $ownedGroup[$i]["g_id"];
                    $ownedGroupName = $ownedGroup[$i]["g_name"];
                    echo "<a href='skimgroup.php?groupid=$ownedGroupId'>$ownedGroupName</a>";
                    echo "<hr>";
                  }
                ?>
              </div>
            </div>
      </div>


      <div class="user-joined-group">
        <hr>
        <div id="UserJoinedGroup">
          <h3>Joined Groups</h3>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">All Groups are Here!</div>
              <div class="panel-body">
                <?php
                  for($i = 0; $i < count($joinedGroup); $i ++){
                    $joinedGroupId = $joinedGroup[$i]["g_id"];
                    $joinedGroupName = $joinedGroup[$i]["g_name"];
                    echo "<a href='skimgroup.php?groupid=$joinedGroupId'>$joinedGroupName</a>";
                    echo "<hr>";
                  }
                ?>
              </div>
            </div>
      </div>
    </div>







  </div>
</div>






<div class="navbar navbar-default">
  <h5 class="text-center">@Summer</h5>
</div>  

</body>
</html>

