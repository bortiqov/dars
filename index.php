<?php
// name = Bunyodjon
include_once "fuction.php";

$value1;
$value2;
$value3;
$value4 = 0;

function engKattasi($value1, $value2, $value3){
  $value4 = $value1;
  if($value4 > $value2){
      if($value4 > $value3){
          echo "$value4 barcha sonlardan katta";
      }else{
          echo "$value3 barcha sonlardan katta";
      }
  }else{
      $value4 = $value2;
      if($value4 > $value3){
          echo "$value4 barcha sonlardan katta"; 
      }else{
          echo "$value3 barcha sonlardan katta";
      }
  } 

echo "my name is Jamshid";
include_once "employees.php";

if ($_POST['select']) {
   echo $_POST['select'];
}
$employees = new Employees();

// $data = [
//     'first_name'=>'Bahodir',
//     'last_name'=>'Ortiqov',
//     'gender'=>'erkak',
// ];
$name = "Bahodir";
$surname = "Ortiqov";
$gender = "M";
$date = "2020-12-03";
$employees->insert(500000,$date,$name,$surname,$gender,$date);
$employees->update(499998,"bahodir","ortiqov","M");
// echo "<pre>";
// print_r($employees->getModel());
// echo "</pre>";
 $model = $employees->getModel();
/*  <-----   Umid   --------> */
function max_3_number($a,$b,$c){
  $max=$a;
  if($max<$b){
    $max = $b;
  }
  if($max<$c){
    $max=$c
  }
  return $max;
}
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

##shoxrux

function katta($a, $b, $c){
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

 ?>


