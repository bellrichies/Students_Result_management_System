function dashboard(){
	$.ajax({
		url:"app_views/dashboard.php",
		method:"POST",
		success:function(data){
			$(".main_container").html(data);
		}
	});
}
	
dashboard();

$(".menu-item").on("click", function(e){
	var page = $(this).data("menu") + '.php';

	if (page == "logout.php") {
		window.location.replace(page);
	}else{
		$(".main_container").load("app_views/" + page);	
	}
});

$(".settings").click(function(){
	alert("settings");
});
