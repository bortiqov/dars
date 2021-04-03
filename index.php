<?php
// name = Bunyodjon
include_once "fuction.php";

echo "my name is Jamshid";
include_once "employees.php";

if ($_POST['select']) {
   echo $_POST['select'];
}
$employees = new Employees();
$name = "Bahodir";
$surname = "Ortiqov";
$gender = "M";
$date = "2020-12-03";
$employees->insert(500000,$date,$name,$surname,$gender,$date);
$employees->update(499998,"bahodir","ortiqov","M");
 $model = $employees->getModel();

?>

<form action="" method="post">
    <select name="select">
    <option value=""></option>
    <?php foreach ($model as $key => $item):
      ?>
        <option value="<?=$item['emp_no']?>"><?=$item['first_name']?></option>
    <?php endforeach;?>
    </select>
    <input type="submit" value="yuborish">
</form>


<?php
/*  <-----   Bahodir   --------> */
function compare($a,$b,$c){
    if ($a > $b && $a > $c) {
      return $a;
    }
    if ($c > $b && $c > $a) {
      return $c;
    }
    if ($b > $a && $b > $c) {
      return $b;
    }
}
echo compare(10,9,11);


$mas=$_POST['number'];
$katta=max($mas);
print_r($katta);
 ?>


 <html>
 <form action="cherka.php" method="POST">
  <input type="number" name="number[0]" placeholder="sonni kiriting"><br>
  <input type="number" name="number[1]" placeholder="sonni kiriting"><br>
  <input type="number" name="number[2]" placeholder="sonni kiriting"><br>
  <input type="submit">
  </form>
 </html>

