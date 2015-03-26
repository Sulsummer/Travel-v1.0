<?php
	include_once("../Configuration/MySQL.php");
	use Configuration\MySQL;
	include_once("../Configuration/MyArray.php");
	use Configuration\MyArray;
	include_once("../Demo/Group.php");
	use Demo\Group;
	include_once("../Demo/Tourist.php");
	use Demo\Tourist;
	include_once("../Demo/User.php");
	use Demo\User;
	include_once("../Demo/Captain.php");
	use Demo\Captain;
	include_once("../Demo/Message.php");
	use Demo\Message;
	include_once("../Demo/Apply.php");
	use Demo\Apply;
	include_once("../Demo/Picture.php");
	use Demo\Picture;

?>
<html>
<body>

<form action="test3.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="text" name="filename"/>
<input type="submit" name="submit" value="Submit" />
</form>
<form action="test3.php" method="post">
	<textarea name="note"></textarea>
	<input type="submit" name="sub" value="sub"/>
</form>
</body>
</html>
<?php

?>