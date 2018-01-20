<?php
		// if (!isset($_POST['select'])) {
		// 	header('Location: ../yoka/login.php');
		// 	exit();
		// }
	$reason = '';

	if (!empty($_POST)) {
		$reason = $_POST['reason'];
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
	<link rel="stylesheet" type="text/css" href="leave.css">
</head>
<body>
	<h1>退会手続き</h1>

	<?php if(isset($errors['select']) && $errors['select'] == 'noSelect'): ?>
		<div class="alert alert-danger">
				退会理由を1つだけ選択してください
		</div>
	<?php endif ?>


	<div>
		<p>退会理由を下記から選択してください</p>
	</div>
	<form method="POST" action="#">
		<div>
			<ul>
				<li><input type="checkbox" name="select">必要ない</li>
				<li><input type="checkbox" name="select">飽きた</li>
				<li><input type="checkbox" name="select">モチベーションがあがらない</li>
				<li><input type="checkbox" name="select">その他</li>
			</ul>
		</div>
		<div>
			<p class="opinion">その他ご意見・ご要望があったら書いてね</p>
			<textarea class="reason" name="reason" value ="<?php echo $reason; ?>"></textarea>
		</div>
		<div style="margin-top: 50px">
			<input type="submit" value="退会申請する">
		</div>
	</form>
</body>
</html>