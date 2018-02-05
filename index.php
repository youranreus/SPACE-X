<?php
/**
 * 空空荡荡
 *
 *
 * @package SPACE
 * @author YOURAN
 * @version beta 1.0
 * @link https://blog.mitsuha.space/
 */

 $this->need('header.php');
 ?>
 <div id="arts">
 <?php while($this->next()): ?>

   <article id="art-post">
     <?php if (isset($this->fields->imgurl)): ?><a href="<?php $this->permalink() ?>"><img id="ab-img" src="<?php $this->fields->imgurl(); ?>"></img></a><hr><?php endif; ?>
     <div id="ab-post-content">
       <h2><a href="<?php $this->permalink() ?>"><?php $this->title(); ?></a></h2>
       <span><?php $this->date('F j, Y'); ?> · <?php $this->category(','); ?></span>
     </div>
   </article>


 	<?php endwhile; ?>
  <p id="nextpage">
  <?php $this->pageLink('<span id="left-navigator">上一页</span>','prev'); ?>
 	<?php $this->pageLink('<span id="right-navigator">下一页</span>','next'); ?></p>
</div>




<?php
$this->need('footer.php');
?>
