<?php
session_start();

//データベース接続
 $dsn='データベース名';
 $user='ユーザー名';
 $password='パスワード';
 try{
    
  $pdo=new PDO($dsn,$user,$password);
  //  echo "接続しました","<br>";
//エラーメッセージの初期化
  $errors=array();
    if(empty($_POST)){
      header("Location:reg_mail_form.php");
       exit();
     }else{
//postされたデータを変数に入れる
       $mail=isset($_POST["mail"])?$_POST["mail"]:NULL;
     }
//メール入力判定
       if($mail==''){
         $errors["mail"]="メールが入力されていません。";
       }
   $urltoken=hash('sha256',uniqid(rand(),1));
   $url="http://co-930.it.99sv-coco.com/reg_form.php"." ?urltoken=".$urltoken;
//データベースに登録
   $stmt=$pdo->prepare("INSERT INTO pre_members (urltoken,name,mail,password,date) VALUES(:urltoken,:name,:mail,:password,now())");
//プレースホルダーへ実際の値を設定する
   $stmt->bindValue(':urltoken',$urltoken,PDO::PARAM_STR);
   $stmt->bindValue(':name',$_POST["username"],PDO::PARAM_STR);
   $stmt->bindValue(':mail',$_POST["mail"],PDO::PARAM_STR);
   $stmt->bindValue(':password',$_POST["password"],PDO::PARAM_STR);
   $stmt->execute();
 }catch(PDOException $e){
    echo "データベースにアクセスできません。".$e->getMessage();
    exit;
}
//メールの宛先
   $mailTo=$_POST["mail"];
   
  mb_language('japanese');
  mb_internal_encoding('UTF-8');
   $subject="メール登録について";
   $body="http://co-930.it.99sv-coco.com/reg_form.php"." ?urltoken=".$urltoken;
//Fromヘッダーを作成
  $header='From:' .mb_encode_mimeheader("メール登録").'<'.$mail.'>';
    if(mb_send_mail($_POST["mail"],$subject,$body) == TRUE ) {
//セッション変数を全て解除
       $_SESSION=array();
//セッションを破棄する
       session_destroy();
         echo  "メールをお送りしました。メールに記載されたURLからご登録下さい。";
     }else{
         echo "メールの送信に失敗しました。";    
}
?>
<html>
<head>
<title>メール確認画面</title>
<meta charset="utf-8" >
</head>
<body>
<input type="button" value="戻る" onClick="history.back()">
</body>
</html>