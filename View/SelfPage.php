<?php
  include_once("../Demo/User.php");
  use Demo\User;
  include_once("../Demo/Group.php");
  use Demo\Group;
  include_once("../Demo/Message.php");
  use Demo\Message;
  include_once("../Demo/Apply.php");
  use Demo\Apply;
  
  isset($_COOKIE["email"])? $email=$_COOKIE["email"] : $email=null;
  if($email == null){
    header("Location:homepage.php");
    exit();
  }
//User
  $newUser = new User($email);
  $self = $newUser->user;

//Friends
  $friends = $newUser -> getUserFriend();
  $friendsCount = count($friends);
  $friendsInfo = array();
  for($i = 0; $i < $friendsCount; $i ++){
      array_push($friendsInfo, $newUser->getUserFriendInfo($friends[$i]["f_id"]));
  }

//Groups
  $newGroup = new Group();
  $ownedGroup = $newGroup -> getAllSetGroup($self["u_id"]);
  $joinedGroup = $newGroup -> getAllGroup($self["u_id"]);

//Message 
  $newMessage = new Message();
  $receiveMessage = $newMessage -> getAllMessage("r",$self["u_id"]);
  $sendMessage = $newMessage -> getAllMessage("s",$self["u_id"]);

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
                echo "<a href='selfpage.php?email=$email'>$email</a>";
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
            <a href="#UserMessage">Message and Apply</a>
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
          <li>
            <a href="#UserComment">Comment</a>
          </li>
        </ul>
      </div>
    </div>


    <div class="col-md-9">
      <div class="user-info">
        <hr>
        <div id="UserBase">
          <h3>Base Info</h3>
          <div class="panel panel-info">
            <div class="panel-heading">Nickname</div>
              <div class="panel-body">
                <div class="col-md-6">
                  <form method="post" action="../Controller/ChangeUserNicknameAction.php">
                  <div class="input-group">    
                    
                    <?php
                      $nickname = $self["nickname"];
                      echo "<input type='text' class='form-control' value='$nickname' name='name'>";
                    ?>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">Change!</button>
                    </span>
                  </div>
                  </form>
                  <span class="badge">
                    <span class="glyphicon glyphicon-thumbs-up">
                      <?php
                        echo $self["popularity"];
                      ?>
                    </span>
                  </span>
                </div>
              </div>
              <div class="panel-heading">Email</div>
              <div class="panel-body">
                <?php
                  echo $self["email"];
                ?>
              </div>
              <div class="panel-heading">Sign out</div>
              <div class="panel-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <button type="submit" class="btn btn-danger">Sign Out</button>
                  <input type="text" value="signout" name="signout" hidden>
                </form>
                <?php
                  if($_POST["signout"] == "signout"){
                    $newUser -> signOut();
                    header("Location:homepage.php");
                    exit();
                  }
                ?>
              </div>
          </div>
        </div>
      </div>
    

      <div class="user-messagess">
        <hr>
        <div id="UserMessage">
          <h3>Message and Apply</h3>
        </div>
          <div class="panel panel-info">
            <div class="panel-heading">All Messages</div>
              <div class="panel-body">
                <h5>Send</h5>
                <?php
                  
                ?>
              </div>
            <div class="panel-heading">All Applies</div>
              <div class="panel-body">
                <?php
                  
                ?>
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


      <div class="user-comment">
        <hr>
        <div id="UserComment">
          <h3>Comment</h3>
        </div>
          <div class="panel panel-info">
            <div class="panel-heading">All Comment</div>
              <div class="panel-body">
                <?php
                  
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

