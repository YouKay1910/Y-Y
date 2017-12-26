<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン画面</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>

	<h1>ログイン画面</h1>

	<form method="POST" action="" enctype = "multipart/form-data">
		
		<?php if (isset($errors['login'])&&$errors['login']=='ng') 
 			
 		{ ?>
 			<div class="alert alert-danger">
 				メールアドレスまたはパスワードが違います。
 			</div>
 		

 		<?php } ?>




	</form>

</body>
</html>