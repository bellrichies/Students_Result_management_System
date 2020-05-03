<?php
//
function cgpa($student,$level){
	$where = array('rank'=>$level);
	if ($rows  = $db->selectwhere('tbl_admin_class',$where)) {
		$begin = $rows[0]['rank'];
		$stop  = $begin ;
	}

	switch ($course) {
		case 'bachelor':
		$class_start = 5;
		$class_stop = ($class_start + $cn) -1;
		break;

		case 'diploma':
		$class_start = 3;
		$class_stop = ($class_start + $cn) - 1;
		break;

		default:
		$class_start = 1;
		$class_stop = ($class_start + $cn) -1;
		break;
	}
	for ($i=$class_start; $i < $class_stop +1 ; $i++) {  
		for ($j=1; $j <3 ; $j++) { //semester iteration
			$total_unit = 0;
			$total_gp = $gp= 0;
			$table ='tbl_admin_subject';
			$where = array('class_id'=>$i, 'semester_id'=>$j);
			if ($subjects = $db->selectWhere($table,$where)) {
			    foreach ($subjects as $subject) {
			      $subject_id   = $subject['id'];

			      $table = 'tbl_student_result';
			      $where = array('student_id'=>$student_id,'subject_id'=>$subject_id,);
			      if ($results = $db->selectWhere($table,$where)) {
			        foreach ($results as $result) {                                   
						$ca_score    = $result['ca_score'];
						$exam_score  = $result['exam_score'];
						$total_score = $result['ca_score']  + $result['exam_score'];

						$total_unit += $subject_unit;
						$total_gp += $gp;
			         }
			      }
			    }
			}
		}
	}
}

function pin_no(){
	$chars1 = str_shuffle("QWRTYUPASDFGHJKLZXCVBNM");
	$chars2 = str_shuffle("QWEU23PAD45HJK67ZXC89NM");
	$chars3 = str_shuffle("QWERTYUPASDFGHJKLZXCVBNM23456789qwertyupasdfghjkzxcvbnm");
	$pin_no= substr($chars1, 0,4). substr($chars2, 0,6).substr($chars3, 0,6);
    return $pin_no;
}


function isDuplicate($db, $table, $where){
    if ($db->selectWhere($table,$where)) {
        return true;
    }else {
        return false;
    }
}

function scratchedCard($pin_no,$seria){
    $card =  "Pin: ". $pin_no . "<br>".
             "S/No: " . $seria . "<br>". 
             "Date: " . date("d-m-Y H:i:s")."<br>";
    return $card;
}

function printTicket($ticket){
	echo '<div class="col-md-3" style="margin-bottom: 5px;">
                        <div style="border:1px solid #eee; padding:5px;">
                            <img src="images/logo.png" style="width:100px;"><br>
                            ' . $ticket. '
                        </div> </div>';
}

function get_grade($db, $data){
	$grades = $db->selectAll('tbl_admin_grades');
	foreach ($grades as $grade) {
	  $start = $grade["score_start"];
	  $stop  = $grade["score_end"];
	  $point = $grade["point"];
	  if ($data >= $start && $data<= $stop) {
	    $remark = $grade["grade"];
	  }
	}
	return $remark;
}

function is_record_exist($db, $data){
	if ($result=$db->selectWhere("tbl_student_applications",$data)) {
		return $result;
	}

	return $result;


}

function convert_to_array($data){
	
	$array_set = array();
	$numbers   = count($data);
	foreach ($data as $value) {
		if ($value!="") {
			$array_set[] = $value;
		}
	}

	return $array_set;
}