<html>
<head>
<menta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>簡易掲示板の作成</title>
</head>
<body>
<?php
  if(isset($_POST["hensyu"])){
	   $filename="kadai2-6.txt";
	   $file_edit=file($filename);
    for($l=0;$l<count($file_edit);++$l){
	$editdata=explode("<>",$file_edit[$l]);
	 if( $editdata[0]==$_POST["name3"] && str_replace(PHP_EOL,'',$editdata[4])==$_POST["epass"]){
		$editedit=1;     echo 2;
		break;    
         }else{ $editdata="";
	      
	        echo 1;
		
         }       
    }//str_replace(PHP_EOL,'',$editdata[4])
	echo $_POST["epass"];
        echo '<br/>';
        echo $editdata[4];
	
//パスワードが一致するなら
//	if($_POST["epass"]==$editdata[4]){
            
	
     
   // echo $_POST["name3"];
  }  
if(isset($_POST["delete"])){
//print_r($filemake);
   $filename="kadai2-6.txt";
   $filemake=file($filename);
   $fp2=fopen($filename,'a');
    for($j=0;$j<count($filemake);++$j){
        $deletedata=explode("<>",$filemake[$j]);
        $num=$_POST["name2"];
       if($deletedata[0]==$_POST["name2"]&&str_replace(PHP_EOL,'',$deletedata[4])==$_POST["dpass"]){
          array_splice($filemake,$j,1);
          $filename="kadai2-6.txt";
          file_put_contents($filename,$filemake);//str_replace(PHP_EOL,'',$deletedata[4])
          echo $num."は削除されました。";
       }
    }
}
?>
<form action="mission_2-1.php" method="post">
番号:
<input type="number" name="name4" value="<?php echo $editdata[0]; ?>">
<br/>
名前：
<input type="text" name="name" size="30" value="<?php echo $editdata[1]; ?>">

コメント：
<input type="text" name="comment" size="30" value="<?php echo $editdata[2]; ?>">
パスワード:
<input type="text" name="password" size="30" value="<?php echo $editdata[4]; ?>"/>

<input type="hidden" name="editedit" value="<?php echo $editedit; ?>"/> 
<input type="submit"  name="soushin" value="送信"/>
</form>
<hr/>
<?php
$date=date("Y/n/j G:i:s", time());
if(isset($_POST["soushin"])){

 
    if($_POST["editedit"]==1){
        $filename="kadai2-6.txt";
	$fileedit=file($filename);
	$edit_data=$_POST["name4"]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$date."<>".$_POST["password"]."\r\n";
	$fp3=fopen($filename,'a');
      for($g=0;$g<count($fileedit);++$g){
	  $editdata=explode("<>",$fileedit[$g]);	
	
	
	    if($editdata[0]==$_POST["name4"]){
	       //$fileeditの$g番目の１行を$edit_dataに置き換える
	       array_splice($fileedit,$g,1,$edit_data);
	       
	       
	    } 
              //$fp3=fopen($filename,'a');
	       //fwrite($fp3,$fileedit);
	}
	       //print_r($editdata);
	//echo $_POST["name"],"\n",$_POST["comment"],"\n",$date;
	       //$filename="kadai2-6.txt";
       //	file_put_contents($filename,$fileedit);
	       //file_put_contents($filename,implode("<>",$editdata));
	//print_r($fileedit);
	file_put_contents($filename,$fileedit);
              
     
   }else{
	$filename="kadai2-6.txt";
	$fp=fopen($filename,'r+');
	//$num=0;
	//$num=fgets($fp);
	$num=(sizeof(file($filename))+1);
	fclose($fp);
	$writedata=$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$date."<>".$_POST["password"]."\n";
	$fp1=fopen($filename,'a');
	fwrite($fp1,$writedata);
	fclose($fp1);
   }
}
?>
<?php
//表示
	$filename="kadai2-6.txt";
 	$ret_array=file($filename);
	  for($i=0;$i<count($ret_array);++$i){
	      $write_data=explode("<>",$ret_array[$i]);
	      $datadata=$write_data[0]."\r\n".$write_data[1]."\r\n".$write_data[2]."\r\n".$write_data[3];
	      echo $datadata;
	      echo '<br>';

          }
?>
<hr/>
<form action="mission_2-1.php" method="post">
編集対象番号:<input type="text" name="name3" size="30" value=""/>
コメント:<input type="text" name="ecomment" size="30" value=""/>
パスワード:<input type="password" name="epass" size="30" value=""/>
<input type="submit" name="hensyu" value="編集"/>
<br/>
削除対象番号:<input type="text" name="name2" size="30" value=""/>
パスワード:<input type="password" name="dpass" size="30" value=""/>
<input type="submit" name="delete" value="削除" />
</form>


</body>
</html>