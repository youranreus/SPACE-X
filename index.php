<?php
/**
 * 空空荡荡
 *
 *
 * @package SPACE
 * @author YOURAN
 * @version beta
 * @link https://blog.mitsuha.space/
 */

 $this->need('header.php');
 ?>
 <div id="arts">
 <?php while($this->next()): ?>

<?php if (isset($this->fields->feeling)): ?>

  <article>
   <div id="art-feeling" style="<?php if ($this->fields->feeling == "happy"): ?>background-image: linear-gradient(346deg, #FFFE9F 0%, #FCA180 100%);<?php elseif($this->fields->feeling == "sad"): ?>background-image: linear-gradient(135deg, #52E5E7 0%, #130CB7 100%)<?php elseif($this->fields->feeling == "soso"): ?>background-image: linear-gradient(135deg, #A8E6CF 0%, #FFD3B6 100%)<?php endif; ?>">
     <div id="feeling-content">
       <div id="feeling-content-left"><?php echo $this->author->gravatar(200);?></div>
       <div id="feeling-content-right">
         <p><?php $this->title(); ?></p>
         <span><?php $this->date('F j, Y'); ?></span>
       </div>
      </div>
   </div>
 </article>

  <?php else: ?>
    <article>
     <div id="art-box" style="background-image: url('<?php if (isset($this->fields->imgurl)): ?><?php $this->fields->imgurl(); ?><?php else: ?><?php ran_img(); ?><?php endif; ?>');">
       <div id="ab-mask">
         <div id="ab-content">
           <p><a href="<?php $this->permalink() ?>"><?php $this->title(); ?></a></p>
           <center><span><?php $this->date('F j, Y'); ?> · <?php $this->category(','); ?> · <?php $this->commentsNum('%d Comments'); ?></span></center>
         </div>
       </div>
     </div>
   </article>
<?php endif; ?>








 	<?php endwhile; ?>
  <p id="nextpage">
  <?php $this->pageLink('<span id="left-navigator">上一页</span>','prev'); ?>
 	<?php $this->pageLink('<span id="right-navigator">下一页</span>','next'); ?></p>
</div>




<?php
$this->need('footer.php');
?>
