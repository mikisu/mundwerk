<?php 
$my_theme = wp_get_theme(); 

// $url  = "?theme=" . $my_theme->get('Name');
// $url .= "&url=" . $_SERVER['SERVER_NAME'];

$url = strtolower($my_theme->get('Name'));

?>
<div class="wrap">
	<div class="documentation_iframe_wrapper">
		<iframe class="documentation_iframe" src="http://<?php echo $url;?>.pixelthrone.it/docs/" frameborder="0" style="" height="100%" width="100%"></iframe>
	</div>
</div>
