<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/portal/app_dbase/connection.php");
$db = new Databases;
?>
<div class="row">
	<div class="col-md-8">
		<div class="header">
			<h5  class="text-dark text-primary">Dashboard</h5>
			<div class="header-tabs"></div>
			<div class="header-forms"></div>
			<div id="message"></div>
		</div>
		<div class="contents">
			<div class="row">
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header card-header-success text-center">
				      <strong>Total student</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5 class="text-success"><strong>
				          <?php
				            $totStudent = $db->selectAll('tbl_student_admin');
				            echo $totStudent = count($totStudent);
				          ?></strong>

				      </h5>
				    </div>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header card-header-primary text-center">
				      <strong>Total Teacher</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5 class="text-primary"> <strong>
				        <?php
				            $totTeachers = $db->selectAll('tbl_update_teachers');
				            echo $totTeachers = count($totTeachers);
				          ?></strong>
				      </h5>
				    </div>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header card-header-warning text-center">
				      <strong>Total Course Class</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5 class="text-warning"><strong>
				      <?php
				            $totClasses = $db->selectAll('tbl_admin_class');
				            echo $totClasses = count($totClasses) -1;
				          ?></strong>
				        
				      </h5>
				    </div>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header card-header-info text-center">
				      <strong>Lifetime Due Income</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5 class="text-info">
				        <?php
				        
				            $dueIncome = 0;
				            $Income = $db->selectAll('tbl_admin_account');
				            foreach ($Income as $value) {
				              $dueIncome += $value['payment_due'] + $value['payment_late'];
				            }
				            echo number_format($dueIncome,2);
				          ?>
				      
				       </h5>
				    </div>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header card-header-rose text-center">
				      <strong>Current Income</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5 class="text-danger"><?php 
				      
				            $totIncome = 0;
				            $Income = $db->selectAll('tbl_admin_account');
				            foreach ($Income as $value) {
				              $totIncome += $value['payment_amount'];
				            }
				            echo number_format($totIncome,2);
				          ?>
				      
				      </h5>
				    </div>
				  </div>
				</div>
				<div class="col-md-4">
				  <div class="card">
				    <div class="card-header text-center">
				      <strong>Outstanding Balance</strong>
				    </div>
				    <div class="card-body" align="center">
				      <h5><?php
				           echo number_format($dueIncome-$totIncome,2);
				          ?>
				      </h5>
				    </div>
				  </div>
				</div>
			</div>	
		</div>
	</div>		
</div>
