<?php
session_start();

  
//POSTされたデータをセッション変数に受け渡す
    if(isset($_POST["account"])){
       $_SESSION["account"]=$_POST["account"];
    }
    if(isset($_POST["mail"])){
       $_SESSION["mail"]=$_POST["mail"];
    }
    if(isset($_POST["pass"])){
       $_SESSION["pass"]=$_POST["pass"];
    }
    if(empty($_SESSION["account"])){
       echo "名前を入力して下さい。";
    }else{
  //名前を取り出す
      $name=trim($_SESSION["account"]);
    }
     if(empty($_SESSION["mail"])){
       echo "メールアドレスを入力して下さい。";
    }else{
  //メールアドレスを取り出す
      $mail=trim($_SESSION["mail"]);
    }
    if(empty($_SESSION["pass"])){
       echo "パスワードを入力して下さい。";
    }else{
  //パスワードを取り出す
      $pass=trim($_SESSION["pass"]);
    }
  
?>
<html>
<head>
<title>会員登録確認画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>会員登録確認画面</h1>
<form action="reg_insert.php" method="post" >
<p>名前:<?php echo $_SESSION['account']; ?></p>
<p>メールアドレス:<?php echo $_SESSION['mail']; ?></p>
<p>パスワード:<?php echo $pass; ?></p>
<input type="button" value="戻る" onClick="location.href='reg_form.php' ">
<input type="hidden" name="token" value="<?=$_POST["token"]?>">
<input type="submit" name="touroku" value="登録" >
</form>
</body>
</html>

