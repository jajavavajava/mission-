<?php
session_start();
?>
<?php
//データベース接続
 $dsn='データベース名';
 $user='ユーザー名';
 $password='パスワード';
if(isset($_POST["touroku"])){
    if( $_SESSION["account"]=='' || $_SESSION["mail"]=='' || $_SESSION["pass"]=='' ){
          header("Location:reg_form.php");
          exit();
    }else{

 $account=$_SESSION["account"];
 $mail=$_SESSION["mail"];
 $pass=$_SESSION["pass"];
 //echo $account;
 //echo $mail;
 //echo $pass;
    }
}
 try{
    
  $pdo=new PDO($dsn,$user,$password);
    //echo "接続しました","<br>";
//データベースに登録
  $stmtt=$pdo->prepare("INSERT INTO members (name,mail,password) VALUES (:name,:mail,:password )");
//プレースホルダーへ実際の値を設定する
  $stmtt->bindParam(":name",$account,PDO::PARAM_STR);
  $stmtt->bindParam(":mail",$mail,PDO::PARAM_STR);
  $stmtt->bindParam(":password",$pass,PDO::PARAM_STR);
  if($stmtt->execute() == TRUE){
    //  echo 'complete';
  }
//pre_membersのflagを1にする
  $sql="UPDATE pre_members SET flag=:flag WHERE mail=:mail";
  $stmt=$pdo->prepare($sql);
//プレースホルダーへ実際の値を設定する
  $params=array(':mail' => $_SESSION["mail"],':flag' => '1');
  $stmt->execute($params);
//IDを表示する
  $sqll="SELECT * FROM members  ORDER BY  id  ASC";
  //SQLステートメントを実行し、結果を変数に格納
  $stmtt=$pdo->query($sqll); 

  //foreach文で配列の中身を一行ずつ出力
  foreach ($stmtt  as  $row) {
  //データベースのフィールド名で出力
     echo "IDは".$row['id']."です。";
       echo '<br>';
  }

}catch(PDOException $e){
   echo "データベースにアクセスできません。".$e->getMessage();
     exit;
 }
?>
<html>
<head>
<title>会員登録完了画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>会員登録完了画面</h1>
<span>
 名前:<?php echo $_SESSION['account']; ?><br>
 メールアドレス:<?php echo $_SESSION['mail']; ?><br>
 パスワード:<?php echo $_SESSION['pass']; ?><br>
 <input type="button" value="ログインへ" onclick="location.href='login.php' ">
</span>
</body>
</html>