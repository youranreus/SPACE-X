<?php $this->need('header.php'); ?>
<div class="post">
	<div class="post-a">
		<div class="post-content" id="post-content">
	<?php echo $this->content ?>
</div>
</div>
</div>
	<?php include('comments.php'); ?>
	<?php $this->need('footer.php'); ?>
