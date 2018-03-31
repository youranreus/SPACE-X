<?php
$this->need('header.php');
 ?>

    <div id="arts">
        <?php if ($this->have()): ?>
          <?php while($this->next()): ?>
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
          	<?php endwhile; ?>
           <p id="nextpage">
           <?php $this->pageLink('<span id="left-navigator">上一页</span>','prev'); ?>
          	<?php $this->pageLink('<span id="right-navigator">下一页</span>','next'); ?></p>

        <?php else: ?>
        	<div class="a-item" itemscope itemtype="http://schema.org/BlogPosting">
    			<h2 class="title nf-title" itemprop="name headline"><?php _e('没有找到内容 (╯‵□′)╯︵┻━┻'); ?></h2>
    			<form method="post">
			        <p class="search"><input type="text" name="s" class="text" placeholder="关键字" autofocus /><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
			    </form>
    		</div>
        <?php endif; ?>

        <!-- <?php $this -> pageNav('上', ' 下'); ?> -->
     </div>
<?php $this -> need('footer.php'); ?>
