<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    $commentAuthor = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= 'comment-by-author';
            $commentAuthor .= 'comment-py-author';
        } else {
            $commentClass .= 'comment-by-user';
            $commentAuthor .= 'ym';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? 'comment-child' : 'comment-parent';
?>
<?php if($commentAuthor==""){
      $commentAuthor .= 'rbq';
      $commentClass .= 'comment-by-user';
    }else{};?>
<li id="li-<?php $comments->theId(); ?>">
    <div id="<?php $comments->theId(); ?>" class="gf">
        <img class="avatar" src="<?php getGravatar($comments->mail); ?>">
      <div class="comment-border"><span class="<?php echo $commentAuthor; ?>"><?php $comments->author(); ?></span><p class="size">(<?php echo timesince($comments->created); ?>)</p><b class="dengji"><?php dengji($comments->mail); ?></b><span class="comment-reply"><a onclick="return TypechoComment.reply('comment-<?php $comments->coid();?>', <?php $comments->coid();?>);" href="javascript:void(0)" rel="nofollow" data-theid="comment-<?php $comments->coid();?>">@Ta</a></span><br><?php getCommentAt($comments->coid); ?><?php $comments->content(); ?>
    </div></div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
<div id="comments">
    <h2><?php $this->commentsNum(_t('目前尚无任何评论.<br>コメントはまだありません。'), _t('仅有 1 条咸鱼'), _t(' %d 条咸鱼在这里躺着')); ?></h2>
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply"><a href="javascript:void(0)" id="cancel-comment-reply-link" style="display:none" rel="nofollow" onclick="return TypechoComment.cancelReply();">取消回复</a></div>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
<?php if($this->user->hasLogin()): ?>
<p><?php _e('已登入: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p><?php else: ?>
  <div class="URE_015" id="Suck my disk">

            <div>
                <input type="text" name="author" maxlength="12" id="author" class="text" placeholder="<?php _e('名字(昵称) *'); ?>" value="<?php $this->remember('author'); ?>" required><input type="email" name="mail" id="mail" class="text" placeholder="<?php _e('@sa.bi *'); ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>><input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
            </div>
  </div>
<?php endif; ?>
          <div class="comment-box">
            <div class="comment-text">
              <textarea name="text" id="textarea" tabindex="4" placeholder="說說你想對我說的話..." required><?php $this->remember('text'); ?></textarea>
            </div>
            <div class="comment-sub">
              <input name="submit" type="submit" id="submit" tabindex="5" value="寄出">
            </div>
          </div>
        </form>
    </div>
<?php if ($comments->have()): ?>
    <?php $comments->listComments(); ?>
<?php endif; ?>
    <?php else: ?>
    <br><h3><?php _e('> 啊嘞,关闭评论了噢!'); ?></h3>
    <?php endif; ?>
</div>
