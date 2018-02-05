<?php
/**
* LINK
*
* @package custom
*/
?>
<?php $this -> need('header.php'); ?>
		<div class="friends">
    	<ul class="links">
				<p style="font-size:2em;">我</p>
				<?php Links_Plugin::output("SHOW_MIX", 0, "我的"); ?>
				<p style="font-size:2em;">朋友们</p>
				<?php Links_Plugin::output("SHOW_MIX", 0, "好朋友"); ?>
			</ul>
		</div>

<?php $this -> need('footer.php'); ?>
