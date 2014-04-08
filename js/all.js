var cek;
$("#blacktrans").click(function()
	{
		if (cek!=1)
		{
			$("body").css("overflow", "auto");
			$("#framebackimg").css("display","none");
			$("#blacktrans").css("display","none");
			$("#backimg").css("display","none");
			$("#closebutton").css("display","none");
			$("#divbackimg").css("display","none");
		}
		else
		{
			cek = 0;
		}
	}
);
$("#framebackimg").click(function()
	{
		cek = 1;
		$("body").css("overflow", "hidden");
		$("#blacktrans").css("top",$(document).scrollTop());
		$("#blacktrans").css("display","inline");
		$("#backimg").attr("src",$(this).attr("src"));
		$("#framebackimg").css("display","block");
		$("#backimg").css("display","block");
		$("#divbackimg").css("display","block");
		$("#closebutton").css("display","block");
	}
);
function close()
{
	$("body").css("overflow", "auto");
	$("#framebackimg").css("display","none");
	$("#blacktrans").css("display","none");
	$("#backimg").css("display","none");
	$("#closebutton").css("display","none");
	$("#divbackimg").css("display","none");
}
$(window).scroll(function () 
{
	$("#menu").css("top", Math.max(118-$("body").scrollTop(), 0)+"px");
});
