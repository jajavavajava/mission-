<?php
session_start();

//データベース接続
 $dsn='データベース名';
 $user='ユーザー名';
 $password='パスワード';
 try{
    
  $pdo=new PDO($dsn,$user,$password);
    //echo "接続しました","<br>";
//エラーメッセージ
  if(empty($_GET)){
  }else{
//GETデータを変数に入れる
  $urltoken=isset($_GET["urltoken"]) ? $_GET["urltoken"]:NULL;
  }
//メール入力判定
  if($urltoken==''){
    //echo "もう一度登録をやり直して下さい。";
  }else{
//flagが０の未登録者
   $stmt=$pdo->prepare("SELECT*FROM pre_members WHERE urltoken= :urltoken AND flag=0");
   $stmt->bindValue(':urltoken',$urltoken,PDO::PARAM_STR);
   $stmt->execute();
//レコード件数取得
  $row_count=$stmt->rowCount();
  }
//仮登録され、本登録されていない場合
//  if($row_count==1){
    //$mail_array=$stmt-fetch();
    //$mail=$mail_array[mail];
    $_SESSION["mail"]=$mail;
  //}else{
    //echo "このURLはご利用できません。もう一度登録をやり直して下さい。";
  //}
}catch(PDOException $e){
      echo "データベースにアクセスできません。".$e->getMessage();
      exit;
  }
?>
<html>
<head>
<title>会員登録画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>会員登録画面</h1>
<form action="reg_check.php" method="post">
<p>名前:<input type="text" name="account" ></p>
<p>メールアドレス:<input type="text" name="mail"></p>
<p>パスワード:<input "text" name="pass"></p>
<input type="submit" name="kakunin" value="確認">
</form>
</body>
</html>

  