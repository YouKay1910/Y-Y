<?php
	if (!isset($_POST['select'])) {
		header('Location: ../yoka/login.php');
		exit();
	}

	if (!empty($_POST)) {
		$errors = array();
		if (!isset($_POST['select'])) {
			$errors['select'] = 'noSelect';
		}

		// チェックできる数を制限ー＞JS jQuery

		//  elseif (isset($_POST['select'])) {
		// 	$select = $_POST['select'];
		// 	if (is_array($select) && count($select) >= 2 ) {
		// 		echo "退会理由は1つだけ選択してください";
		// 	}
		// }
	}








?>





<!DOCTYPE html>

<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>退会手続き画面</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
</head>
<body>
	<h1 style="text-align: center; padding-top:30px;">退会手続き</h1>

	<?php if(isset($errors['select']) && $errors['select'] == 'noSelect'): ?>
		<div class="alert alert-danger" style="text-align: center;">
				退会理由を1つだけ選択してください
		</div>
	<?php endif ?>


	<div style="text-align: center; margin-top: 100px;">
		<p>退会理由を下記から選択してください</p>
	</div>
	<form method="POST" action="#">
		<div>
			<ul style="display: table; padding: 0; margin: 20px auto;">
				<li style="display: table;"><input type="checkbox" name="select">必要ない</li>
				<li style="display: table;"><input type="checkbox" name="select">飽きた</li>
				<li style="display: table;"><input type="checkbox" name="select">モチベーションがあがらない</li>
			</ul>
		</div>
		<div style="text-align: center;">
			<p style="margin-bottom: 20px;">その他ご意見・ご要望があったら書いてね</p>
			<textarea style="width: 200px; height: 100px;" name="reason"></textarea>
		</div>
		<div style="text-align: center; margin-top: 50px">
			<input type="submit" name="leave" value="退会申請する">
		</div>
	</form>
</body>
</html>