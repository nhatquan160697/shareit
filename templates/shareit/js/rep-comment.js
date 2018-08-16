$(document).ready(function(){
	$(".cl-reply").click(function(){
		// lấy com_id của bl đó
		id = $(this).attr("data-setid");
		$(".cl-rep-form"+id).slideToggle();
	});
	$(".rep-submit").click(function(){
		id = $(this).attr("data-comid");
		m = $(".rep-mess"+id).val();
		n = $(".rep-name"+id).val();
		$.ajax({
			url: "/ajax/xuly_rep.php",
			type: "POST",
			data: "mess="+m+"&name="+n+"&com_id="+id,
			async: true,
			success:function(kq){
				$('.rep-ul'+id).append(kq);
				$(".rep-mess"+id).val("");
				$(".rep-name"+id).val("");
			}
		});
		return false;
	});							
});