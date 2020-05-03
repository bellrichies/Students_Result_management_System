
</div>
</body>


	<script src="app_assets/assets/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="app_assets/assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="app_assets/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="app_assets/assets/js/plugins/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="app_assets/font.js"></script>
	<script src="app_assets/custom.js"></script>

	
	<!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
	<script>
		$(document).ready(function(){
			$(".hamburger").click(function(){
				$(".wrapper").toggleClass('kollapse');
			});

			$(".sidebar ul li a").click(function(){
				$('.sidebar ul li a').each(function() {
					$(this).removeClass('active');
				});
				$(this).addClass('active');
			});
		})

	</script>
</html>
