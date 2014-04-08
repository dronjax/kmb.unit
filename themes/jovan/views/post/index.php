<?php
	$this->breadcrumbs=array(
		'Posts',
	);
	function truncate($text = '', $length = 100, $suffix = 'read more&hellip;', $isHTML = true){
        $i = 0;
        $tags = array();
        if($isHTML){
            preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach($m as $o){
                if($o[0][1] - $i >= $length)
                    break;
                $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                if($t[0] != '/')
                    $tags[] = $t;
                elseif(end($tags) == substr($t, 1))
                    array_pop($tags);
                $i += $o[1][1] - $o[0][1];
            }
        }
       
        $output = substr($text, 0, $length = min(strlen($text),  $length + $i));
		if (strlen($output)==strlen($text))
			$cek = false;
		else
			$cek = true;
			
		$output = $output . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
		
        // Get everything until last space
        if ($cek)
			$one = substr($output, 0, strrpos($output, " "));
		else
			$one = $output;
        // Get the rest
		if ($cek)
			$two = substr($output, strrpos($output, " "), (strlen($output) - strrpos($output, " ")));
		else
			$two = $output;
		// Extract all tags from the last bit
        preg_match_all('/<(.*?)>/s', $two, $tags);
        // Add suffix if needed
        if (strlen($text) > $length) { $one .= '&nbsp;' . $suffix; } else { $one .= ''; }
        // Re-attach tags
        $output = $one . implode($tags[0]);
       
        return $output;
    }
?>

<!--<h1>Posts</h1>-->

<?php 
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate' => false,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>

<script type="text/javascript">

	var clickhandler = 	function()
	{
		cek = 0;
		$("body").css("overflow", "hidden");
		$("#blacktrans").css("top",$(document).scrollTop());
		$("#blacktrans").css("display","inline");
		$("#backimg").attr("src",$(this).attr("src"));
		$("#framebackimg").css("display","block");
		$("#backimg").css("display","block");
		$("#divbackimg").css("display","block");
		$("#closebutton").css("display","block");
		$(".post_image").unbind("click");
	}
</script>