<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;

$formData = $_POST['values'];
foreach ($formData as $data) {
  $name  = $data['name'];
  $value = $data['value'];
  if ($name == "grId") {
    $id[] = array($name => $value);
  }
  if ($name == "scFro") {
    $scFro[] = array($name => $value);
  }
  if ($name == "scTo") {
    $scTo[] = array($name => $value);
  }
  if ($name == "scPoint") {
    $scPoint[] = array($name => $value);
  }
  if ($name == "scGrade") {
    $scGrade[] = array($name => $value);
  }
  if ($name == "gpFro") {
    $gpFro[] = array($name => $value);
  }
  if ($name == "gpTo") {
    $gpTo[] = array($name => $value);
  }
  if ($name == "diplomaGrade") {
    $diplomaGrade[] = array($name => $value);
  }
  if ($name == "degreeGrade") {
    $degreeGrade[] = array($name => $value);
  }
}

$total = count($scFro);
for ($i=1; $i < $total + 1 ; $i++) { 
  $fields=array(
    'score_start'   => $scFro[$i-1]['scFro'],
    'score_end'     => $scTo[$i-1]['scTo'],
    'point'         => $scPoint[$i-1]['scPoint'],
    'grade'         => $scGrade[$i-1]['scGrade'],
    'gp_from'       => $gpFro[$i-1]['gpFro'],
    'gp_to'         => $gpTo[$i-1]['gpTo'],
    'remarks'       => $diplomaGrade[$i-1]['diplomaGrade'],
    'remarks2'       => $degreeGrade[$i-1]['degreeGrade'],
  );
  $where = array('id' => $id[$i-1]['grId'],);
  $db->update('tbl_admin_grades',$fields,$where); 
}
echo "success";
?>