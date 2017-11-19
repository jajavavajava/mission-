<?php
 session_start();

 header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ (CSRF) 対策
 //$_SESSION["token"] = base64_encode(openssl_random_pseudo_bytes(32));
 $token = $_SESSION["token"];

 //クリックジャッキング対策
  header('X-FRAME-OPTIONS: SAMEORIGIN' );
?>

 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>投稿画面</title>
<body>
<h1>投稿</h1>
<form action="toukou.php" method="post">
<p>名前:<input type="text" name="namae" value="<?php echo $_SESSION['account']; ?>"/></p>
<p>コメント:<input type="text" name="comment"></p>
<input type="submit" value="投稿"></p>
</form>
<form action="create_image.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="300000" /> 
<input type="file" name="image"/ ><br/><br/>
<input type="submit" value="アップロード" >
</form>
<a href="http://co-930.it.99sv-coco.com/logout.php">ログアウト</a>
<hr/>
<?php
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
 try{
     $pdo=new PDO($dsn,$user,$password);
   //echo "接続しました" ,"<br>";
  echo "コメント";
  echo '<br>';
 $name=$_POST["namae"];
 $comment=$_POST["comment"];
 $stmt=$pdo->prepare("INSERT INTO posts (name,comment,created) VALUES (:name,:comment,now())");
 //パラメーターを割り当て
 $stmt->bindParam(":name",$_POST["namae"] );
 $stmt->bindParam(":comment",$_POST["comment"] );
 //クエリの実行
 if($stmt->execute() == TRUE ){
    //echo "投稿しました。";
 }
//SELECT文を変数に格納
  $sqll="SELECT * FROM posts  ORDER BY  id  ASC";
  //SQLステートメントを実行し、結果を変数に格納
  $stmtt=$pdo->query($sqll); 
 //foreach文で配列の中身を一行ずつ出力
  foreach ($stmtt  as  $row) {
  //データベースのフィールド名で出力
     echo $row["id"].":".$row["name"].":".$row["comment"].":".$row["created"];
     echo "<br/>";
  }


}catch(PDOException $e){
        echo "データベースにアクセスできません。".$e->getMessage();
        exit;
  }
?>
</body>
</html>
