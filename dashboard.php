<?php
@session_start();
$page_title = "Dashboad";
if (!isset($_SESSION['loggedin'])) {
	header("Location: index.php");
}?>
	<?php include_once("includes/header.php");?>
		<div class="main_container"></div>
	<?php include_once("includes/footer.php");?>
</body>
</html>