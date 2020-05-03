<?php
require_once(__DIR__ . "../../app_dbase/connection.php");
$db = new Databases;

if (isset($_POST['class_name'])) {
	$class_id   = $_POST['class_id'];
	$class_name = $_POST['class_name'];
	$semester_name = $_POST['semester_name'];
	$subject_name = $_POST['subject_name'];

	header('Content-Type: application/vnd.ms-excel');
	header('Content-disposition: attachment; filename='.$class_name.'.xls');
	$output = "<h5>CACTS LAGOS CAMPUS >>>>  <strong>".$class_name." - Broadsheet </strong></h5>";
	$output .= "<hr>";
	$output .="<div class='table table-responsive'> <table style='width:100%'><tr>
					<th>S/N</th>
					<th>Matric #</th>
					<th>Student Names</th>
					<th></th>";
	//fetch all subjets for table heading
	if ($subjets = $db->selectWhere('tbl_admin_subject',array('class_id'=>$class_id))) {
		foreach ($subjets as $subject) {
			$output .= '<th>'.$subject['subject_title'].'</th>';
		}
		$output .='<th>CGPA</th></tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			';
		// retrieve the unit of the subject(s)
		if ($subjets = $db->selectWhere('tbl_admin_subject',array('class_id'=>$class_id))) {
			foreach ($subjets as $subject) {
				$output .= '<th class="text-center">'.$subject['subject_unit'].'</th>';
			}
			$output .=' <td></td>
					</tr><tr>';
		}

		$where=array('student_level'=>$class_id,);
		if ($rows = $db->selectWhereby('tbl_student_admin',$where)) {
			$serial_no = 0;
			foreach ($rows as $row) {
				$serial_no++;
				$student_id= $row['id'];
				$stuMatric = $row['student_matric'];
				$stuName   = $row['student_surname'].' '.$row['student_firstname'].' '.$row['student_othernames'];

				$output .= "<td>".$serial_no ."</td>";
				$output .= "<td>".strtoupper($stuMatric) ."</td>";
				$output .= "<td>".strtoupper($stuName)   ."</td>";
				$output .= "<td>SCORE <br> GP</td>";

				$where =array('class_id'=>$class_id);
				if ($subjets=$db->selectWhere('tbl_admin_subject',$where)) {
					$cum_unit =0;
					$cum_score=0;
					foreach ($subjets as $subjet) {
						$id   = $subjet['id'];
						$unit = $subjet['subject_unit'];
						$where = array('student_id'=>$student_id, 'subject_id'=>$id);
						
						if ($result = $db->selectWhere('tbl_student_result',$where)) {
							$ca    = $result[0]['ca_score'];
							$score = $result[0]['exam_score'];

							$ts = $ca + $score;

							$score_point = 0 ;
							$points = $db->selectAll('tbl_admin_grades');
							foreach ($points as $point) {
								$score_start = $point['score_start'];
								$score_end = $point['score_end'];
					            if ($ts >= $score_start && $ts<= $score_end) {
					              $score_point = $point['point'];
					            }
					        }
					        
					        $gp = $score_point * $unit;
					        if ($ts!=0) {
					        	$cum_unit += $unit;
					        	$cum_score += $gp;
					        }
							$output .= '<td style="text-align:center">'.$ts.'<br>'.$gp.'</td>';
						}else {
							$gp =0;
							$output .= '<td style="text-align:center">0<br>'.$gp.'</td>';
						}
					}
					if ($cum_unit!=0) {
						$cgpa = number_format(($cum_score/$cum_unit),2);
					}else {
						$cgpa = number_format(0,2) ;
					}
					$output .='<td> <br>'.$cgpa.'</td></tr><tr>';
				}
			}
		}
		$output .= "</table>";
	}


}



		
		
		
		
		
		
		
		echo $output;
	

?>

