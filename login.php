<?php
 session_start(); //セッション開始
 //ログインボタンが押されたとき

  if(isset($_POST["login"])){
   if(empty($_POST["id"])){
     echo "IDが未入力です。";
   }
 if($_POST["id"] && $_POST["pass"]){
 //入力したIDを格納
  $id=$_POST["id"];
 
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";

//IDとパスワードが入力されていたら認証する
  try{
     $pdo=new PDO($dsn,$user,$password);
      //  echo "接続";
     $stmt=$pdo->prepare("SELECT*FROM members WHERE id= ? ");
     $stmt->execute(array($id));
   if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
     if($_POST["pass"] == $row["password"]){
 //入力したIDのユーザ名を取得
  $id=$row["id"];
  $sql="SELECT*FROM members WHERE id=$id";
  $stmtt=$pdo->query($sql);
    foreach($stmtt as $row){
       $row["name"];
    }
  //$_SESSION["account"]=$row["name"];
   // header("Location:toukou.php");
    //exit();
 //pre_members(テーブル名)のflagが1であるか
    //$stmtt=$pdo->prepare("SELECT*FROM pre_membersWHERE flag=1 " );
      if($pdo->prepare("SELECT*FROM pre_members WHERE flag=1 " )==TRUE){
        
//if($stmtt->execute() == TRUE){
         header("Location:toukou.php");
          
 
      }else{
          echo "仮登録されていません。";
      } 
   }else{
 //認証失敗
   echo "IDあるいはパスワードに誤りがあります。";
   }
  }else{ 
   echo "IDあるいはパスワードに誤りがあります。";
  }
 }catch(PDOException $e){
        echo "データベースにアクセスできません。".$e->getMessage();
        exit;
  } 
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>掲示板ログイン画面</title>
</head>
<body>
<h1>投稿サイト</h1>
<h2>ログイン</h2>
<form action="" method="post">
<p>ID:<input type="text" name="id" ></p>
<p>パスワード:<input type="password" name="pass" ></p>
<p><input type="submit" name="login" value="ログイン" ></p>
</form>
  <a href="http://co-930.it.99sv-coco.com/reg_mail_form.php">新規登録はこちらから</a>
</body>
</html>