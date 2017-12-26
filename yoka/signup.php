<?php 
	//signup.phpで実装すること
	//$_SESSIONというスーパーグローバルhrん数が使えるようになる
	//おまじない、として使う場合は記載しておく
	//session_start();がないと$_SESSIONは使えない
	//session_start();は複数回呼んではいけない
session_start();
if (!isset($_SESSION['user_info'])) {
	//$_SESSIONが存在しない、つまり前の画面から飛んで来てない！
	//$_SESSIONがない状態だとエラーが発生するので、強制的に、前の画面に戻してあげる
	//headerとexitはセットで使います
	// header('Location: singup.php');
	// exit();
}


//①バリデーション（検証すること）
//②プロフィール画像をアップロードする
//③セッションデータを使用して、データを一時的に保持する
//④次のページへ移動する

//POST送信されたかどうかを確認する
// var_dump($_POST);//デバック関数（本番では使用しない）

//初期値(inputタグのvalueの値)
$username = '';
$email = '';
$password = '';


//画像のアップロードに関して
//$_FILES というスーパーグローバル変数を用意する
//「注意点」
// $_FILESを使用するには
// <form>のタグに
// enctype = "multipart/form-data"という記述が必要



// var_dump($_POST);

if (!empty($_POST)) {
	// isset()とempty()
	// isset() -> 存在するとTRUEを出力する
	// empty() -> 存在しないとTRUEを出力する
	// !isset() -> isset()の結果と逆を出力する
	// !isset() -> empty()の結果と逆を出力する


	//登録確認というボタンを押した時のみ動作するプログラム
	echo '登録確認ボタンを押した！ <br>';

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	//エラー件数チェック
	$errors = array ();

	//バリデーション（検証）
	if ($username== '') {
		//echo 'ユーザー名が入力されておりません。<br>';
		//通常の配列の追加
		// $errors['']='blank';
		//array('username'=>'blank');
		$errors['username']='blank';
	}
	if ($email== '') {
		//echo 'ユーザー名が入力されておりません。<br>';
		//通常の配列の追加
		// $errors['']='blank';
		//array('username'=>'blank');
		$errors['email']='blank';
	}
	if ($password== '') {
		//echo 'ユーザー名が入力されておりません。<br>';
		//通常の配列の追加
		// $errors['']='blank';
		//array('username'=>'blank');
		$errors['password']='blank';
	}elseif (strlen($password)<6) {
		// strlen()関数 文字数をカウントする(半角)
		//mb_strlen()関数　文字数をカウントする(日本語対応)(全角)
		// strlen('ここの文字')=>数字で文字の数になる
		$errors['password']='length';
	}

	// 画像のバリデーション
	if (!empty($_FILES['profile_image']['name'])) {
		//ファイル名があったらここの処理が動く
		//画像の拡張子チェック
		//プログラムは拡張子により挙動が変化します
		//後ろから3文字抜き出す

		$filename = $_FILES['profile_image']['name'];
		//後ろから３文字抜き出す
		$ext = substr($filename, -3);
		//echo $filename . 'の拡張子は' . $ext;
		// exit(); //処理を止めるプログラム
		if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
			//ここのIF文に入ったら拡張子が[jpg,png,gif]以外
			$errors['profile_image'] = 'extention';
		}



	}else {
		//ファイル名がなかったら == ファイルをアップロードしてない
		$errors['profile_image'] = 'blank';
	}





	if (empty($errors)) {
		echo 'エラーがありませんでした。確認画面へ移動します。<br>';

		//エラーがなかったら「画像を保存」をしましょう
		// move_uploaded_file(設定１,設定２ );
		//画像アップロードするために用意されている関数
		//設定１の部分
		//画像のパス（場所/ファイル）を設定
		//設定２の部分
		//保存するパスを設定
		//フォルダの書き込み権限を「読み書き」可能な状態にする！
		move_uploaded_file($_FILES['profile_image']['tmp_name'],'../profile _image/'. $_FILES['profile_image']['name']);
		//これで画像を保存することができる！
		
		//エラーがない場合はセッションにもデータを保存してあげる
		$_SESSION['user_info']['username']=$username;
		$_SESSION['user_info']['email']=$email;
		$_SESSION['user_info']['password']=$password;
		$_SESSION['user_info']['profile_image']=$filename;

		//($_SESSIONはこのページでは定義されていないが、check.phpで定義されているからundifined valuableにならない)
		
		//リダイレクト　（ポスト送信を破棄してリンクを飛ばす）
		header('Location: check.php');
		exit;





	}

}



 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
 	<meta charset="utf-8">
 	<title>ユーザー登録</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
 </head>
 <body>
 	<div class="header-container">
	 	<div class="heading">
	 		<h1>まずはユーザー登録をしましょう！</h1>
	 	</div>
 	
 	<form method="POST" action="" enctype = "multipart/form-data"> <!-- actionが空の場合、自分自身にデータが帰ってくる（今いるページに戻る、画面は変わらない） -->
 		<!-- ユーザー名のデータ -->
 		<label>ユーザー名</label><br>
 		<input type="text" name="username" placeholder="例: たろう" value="<?php echo $username; ?>">
 		<br>

 		<!-- $errors['username']が存在する且つ$errorsが['username']==blankだったらエラーの文字を表示してあげる -->

 		<?php if (isset($errors['username'])&&$errors['username']=='blank') 
 			
 		{ ?>
 			<div class="alert alert-danger">
 				ユーザー名を入力してください
 			</div>
 		

 		<?php } ?>

 		<!-- メールアドレスのデータ -->
 		<label>メールアドレス</label><br>
 		<input type="text" name="email" placeholder="例: nex@seed" value="<?php echo $email; ?>">
 		<br>

 		<?php if (isset($errors['email'])&&$errors['email']=='blank') 
 			
 		{ ?>
 			<div class="alert alert-danger">
 				メールアドレスを入力してください
 			</div>
 		

 		<?php } ?>

 		<!-- パスワードのデータ -->
 		<label>パスワード</label><br>
 		<input type="password" name="password">
 		<br>

 		<?php if (isset($errors['password'])&&$errors['password']=='blank') 
 			
 		{ ?>
 			<div class="alert alert-danger">
 				パスワードを入力してください
 			</div>
 		

 		<?php } ?>
 		<?php if (isset($errors['password'])&&$errors['password']=='length') 
 			
 		{ ?>
 			<div class="alert alert-danger">
 				パスワードは6文字以上設定してください
 			</div>
 		

 		<?php } ?>

 		<!-- プロフィール画像のアップロード部分 -->
 		<label>プロフィール画像</label>
 		<input type="file" name="profile_image" accept="image/*">
 		<br>
 		<?php if (isset($errors['profile_image'])&&$errors['profile_image']=='blank') {?>

 		<div class="alert alert-danger">画像を選択してください。
 		</div>
 		<?php  } ?>

 		<?php if (isset($errors['profile_image'])&&$errors['profile_image']=='extention') {?>

 		<div class="alert alert-danger">使用できる拡張子は「jpg」,「png」, 「gif」のみです。
 		</div>
 		<?php  } ?>

 		<!-- 送信ボタン -->
 		<input type="submit" value="登録確認">


 	</form>
 	<br>
 	<br>
 	ログインは <a href="../login.php">こちら</a>
 	</div>
 	
 </body>
 </html>