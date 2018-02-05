<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<div class="post">
		<?php if ($this->options->enabletoc == 1): ?><aside id="toc"></aside><?php endif; ?>
		<div class="post-a">

			<div class="post-content" id="post-content">

		<?php bili2post($this->content); ?>


			<hr>


		</div>
		</div>
		<?php if ($this->options->enabletoc == 1): ?>
			<script>
			new Toc( 'post-content',{
				'level':3,
				'top':1000,
				'class':'toc',
				'targetId':'toc'
		} );
			</script>
		<?php endif; ?>
  </div>
	<div class="blog-bottom-bar">
      <div class="blog-container">
        <?php prev_post($this); next_post($this); ?>

      </div>
    </div>





	<?php include('comments.php'); ?>

	<?php $this->need('footer.php'); ?>
