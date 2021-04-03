<?php
echo "as"; // komentariya
$k = 0;
$myFile = "files.txt";
if (isset($_POST['submit']) && !empty($_POST['text'])) {
    $text = $_POST['text'] . "<br>";
    
    $file = fopen($myFile,'a+') or die("file ochilmadi");
    if(fwrite($file,$text)){
        fclose($file);
    }
   $file = fopen($myFile,'r'); 
   $myFile = "file.php";
   $line = file_get_contents($myFile);
   echo "<pre>";
   print_r($line);
   echo "</pre>";

   echo "Bu o'zgarishlar ";
//    while(!feof($file)){
//        $line = file($file);
//         echo "<pre>";
//         print_r($line);
//         echo "</pre>";
//         $k++;
//         if ($k > 200) {
//             echo "<br>";
//             $k = 0;
//         }
   }
  
?>

<form action="" method="post">
    <input name="text" type="text">
    <input type="submit" name="submit">
</form>