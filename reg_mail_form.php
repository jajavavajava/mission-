<?php
session_start();
header("Content-type:text/html;charset=utf-8"); 
//クロスサイトリクエストフォージェリ(CSRF)対策
 // $_SESSION["token"]=base64_encode(openssl_random_pseudo_bytes(32));
  $token=$_SESSION["token"];
//クリックジャッキング対策
  header('X-FRAME-OPTIONS:SAMEORIGEN');
//現在のページ、ホスト名、プロトコルを取得する場合
//echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

?>
<html>
<head>
<title>メール登録画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>メール登録画面</h1>
<form action="reg_mail_check.php" method="post">
<p>名前:<input type="text" name="username" ></p>
<p>メールアドレス:<input type="text" name="mail" size="50"></p>
<p>パスワード:<input type="password" name="password" ></p>
<input type="submit" value="登録" >
</form>
</body>
</html>
