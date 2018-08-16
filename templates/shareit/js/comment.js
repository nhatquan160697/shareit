$(document).ready(function(){
	$(".com-submit").click(function(){
		m = $(".com-mess").val();
		n = $(".com-name").val();
		id = $(".com-submit").attr("data-newsid");
		$.ajax({
			url: "/ajax/xuly_cmt.php",
			type: "POST",
			data: "mess="+m+"&name="+n+"&id="+id,
			async: true,
			success:function(kq){
				if($("#com-list .cmtli").length==0){
					$("#com-list").html(kq);
				} else {
				$(".cmtul .cmtli :eq(0)").before(kq);
				}
				$(".com-mess").val("");
				$(".com-name").val("");
			}
		})
		return false;
	});							
});