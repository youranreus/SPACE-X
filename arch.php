<?php
/**
* ARCHIVE
*
* @package custom
*/
?>

<?php $this->need('header.php'); ?>
  <div class="post">
    <div class="post-a">
      <div class="post-content" id="post-content">
        <div class="GD">
          <div class="time">
            <h2>时光机</h2>
            <ul class="gd-list">
                <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
                ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
            </ul>
      </div>
    </div>
  </div>
</div>
</div>
  <div id="white"></div>
  <?php $this->need('footer.php'); ?>
