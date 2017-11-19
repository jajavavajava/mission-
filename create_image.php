<?php
  
  $dsn='データベース名';
  $user='ユーザー名';
  $password='パスワード';

  if(isset($_FILES["image"]["tmp_name"])){
 
 //バイナリデータ
  
   $upFile=$_FILES["image"]["tmp_name"];
   $upFileData=file_get_contents($upFile);
   header('Content-type: image/jpeg');
   mb_language("Japanese");
   echo $upFileData ;
 //拡張子
   $dat=pathinfo($_FILES["image"]["name"]);
   $extension=$dat['extension'];
 //MIMEタイプ
   if($extension == "jpg" || $extension == "jpeg" ) $mime="image/jpeg";
  else if($extension == "gif" )$mime="image/gif";
  else if($extension == "png" )$mime="image/png";
 //MySQL登録
try{
    
   $pdo=new PDO($dsn,$user,$password);
      echo "接続しました" ,"<br>";
  // $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $FileData=$pdo->quote(file_get_contents($_FILES["image"]["tmp_name"]));
 //画像を保存するSQL文の実行
   $stmt=$pdo->prepare("INSERT INTO images (gazou,mime) values (:gazou,:mime)");
   $stmt->bindValue(':gazou', $FileData,PDO::PARAM_LOB);
   $stmt->bindValue(':mime',$mime,PDO::PARAM_LOB);
   if($stmt->execute() == TRUE){
     echo 'complete';
   }else{
     echo "保存できませんでした。";
   }
    echo $upFileData ;


 }catch (PDOException $e){
 
   exit;
}
}
?>

