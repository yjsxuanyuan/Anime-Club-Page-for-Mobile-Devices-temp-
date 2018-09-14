<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcom to Poita Anime Club</title>
  <link rel="stylesheet" type="text/css" href="initial.css">
  <link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
        document.querySelector('html').style.fontSize =  window.innerWidth*100/750 + 'px';
        window.onload=()=>{
        var iframe=document.getElementById("ifr");
    	iframe.onload= function () {
        	var bodycontent=iframe.contentDocument.body.innerHTML;
        	console.log(bodycontent);
        //处理获取到的内容；
    	}}

	</script>
</head>
<body>
	<?php
	// 定义变量并默认设置为空值
	$usernameErr = $emailErr = $genderErr  = $IDErr = $nameErr = $passwordErr = $phoneErr = "";
	$username = $email = $gender = $ID  = $password = $name = $phone = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	    if (empty($_POST["username"]))
	    {
	        $usernameErr = "名字是必需的";
	    }
	    else
	    {
	        $username = test_input($_POST["username"]);
	        // 检测名字是否只包含字母跟空格
	        if (!preg_match("/^[a-zA-Z1-9_]*$/",$username))
	        {
	            $usernameErr = "用户名只允许字母、数字、下划线"; 
	        }
	        else if (strlen($username)<6 || strlen($username)>20) {
	        	$usernameErr = "用户名应在6~20位之间";
	        }
	    }
	    
	    if (empty($_POST["password"])) {
	    	$passwordErr = "密码是必需的";
	    }
	    else {
	    	$password = test_input($_POST["password"]);
	    	if (strlen($password)<6 || strlen($password)>16) {
	    		$passwordErr = "密码应在6~16位之间";
	    	}
	    }

	    if (empty($_POST["email"]))
	    {
	      $emailErr = "邮箱是必需的";
	    }
	    else
	    {
	        $email = test_input($_POST["email"]);
	        // 检测邮箱是否合法
	        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
	        {
	            $emailErr = "非法邮箱格式"; 
	        }
	    }
	    
	    if (empty($_POST["name"]))
	    {
	        $nameErr = "姓名是必需的";
	    }
	    else
	    {
	        $name = test_input($_POST["name"]);
	    }
	    
	    if (empty($_POST["ID"]))
	    {
	        $IDErr = "学号是必需的";
	    }
	    else
	    {
	        $ID = test_input($_POST["ID"]);
	        if (!preg_match("/^[0-9]*$/", $ID)) {
	        	$IDErr = "学号只允许数字";
	        }
	    }

	    if (empty($_POST["phone"])) {
	    	$phoneErr = "电话是必需的";
	    }
	    else  {
	    	$phone = test_input($_POST["phone"]);
	    	if (!preg_match("/^[0-9]*$/", $phone)) {
	    		$phoneErr = "手机号格式错误";
	    	}
	    }
	    
	    if (empty($_POST["gender"]))
	    {
	        $genderErr = "性别是必需的";
	    }
	    else
	    {
	        $gender = test_input($_POST["gender"]);
	    }
	}

	function test_input($data)
	{
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
	?>

  <div class="app">
    <div class="sign-up">
      <form method="post" class="sign-up-info" id="sign-up" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" target='ifr'>
        <input class="one-type" type="text" placeholder="Username" name="username" autocomplete="off" value="<?php echo $username;?>">
        <input class="one-type" type="password" placeholder="Password" name="password" autocomplete="off" value="<?php echo $password;?>">
        <input class="one-type" type="text" placeholder="E-mail" name="email" autocomplete="off" value="<?php echo $email;?>">
        <input class="one-type" type="text" placeholder="Student ID" name="ID" autocomplete="off" value="<?php echo $ID;?>">
        <input class="one-type" type="text" placeholder="Phone number" name="phone" autocomplete="off" value="<?php echo $phone;?>">
        <input class="one-type name" type="text" placeholder="Name" name="name" autocomplete="off" value="<?php echo $name?>">
        <div class="two-type"><input class="radio" type="radio" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>><label>男</label></div>
        <div class="two-type"><input class="radio" type="radio" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>><label>女</label></div>
        <input class="submit-button" type="submit" name="submit" value="注 册">
      </form>
      <iframe name='ifr' id="ifr" style='display: none;'></iframe>
    </div>
  </div>
  <?php
  	if ($usernameErr) echo "<script>alert('$usernameErr')</script>";
  	else if ($passwordErr) echo "<script>alert('$passwordErr')</script>";
  	else if ($emailErr) echo "<script>alert('$emailErr')</script>"; 
  	else if ($IDErr) echo "<script>alert('$IDErr')</script>";
  	else if ($phoneErr) echo "<script>alert('$phoneErr')</script>";
  	else if ($nameErr) echo "<script>alert('$nameErr')</script>";
  	else if ($genderErr) echo "<script>alert('$genderErr')</script>";
  	else if ($username) echo "<script>alert('注册成功')</script>";
  ?>
</body>
</html>