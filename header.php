<!DOCTYPE html>
<html>
<head>
	<!--全局-->
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
	<!--编码-->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<!--<meta http-equiv="content-type" content="text/html; charset=<?php $this->options->charset(); ?>" />--><!--自动选择去掉上面的注释-->
	<!-- dnsPrefetch -->
	<?php if ($this->options->dnsPrefetch == 1): ?>
  <meta http-equiv="x-dns-prefetch-control" content="on"/>
  <link rel="dns-prefetch" href="//fonts.googleapis.com"/>
  <link rel="dns-prefetch" href="//secure.gravatar.com"/>
  <link rel="dns-prefetch" href="//cdn.bootcss.com"/>
  <?php endif; ?>
	<!--网站标题-->
	<title><?php $this->archiveTitle(' &raquo; ', '', ' | '); ?><?php $this->options->title(); ?></title>
	<!-- css -->
	<link href="<?php $this->options->themeUrl('css/i.css'); ?>" rel="stylesheet" />
      <link href="https://cdn.bootcss.com/normalize/7.0.0/normalize.min.css" rel="stylesheet" />
	<link href="<?php $this->options->themeUrl('css/prism.css'); ?>" rel="stylesheet" />
	<!-- JS -->
	<?php if ($this->options->enabletoc == 1): ?>
	<script src="<?php $this->options->themeUrl('js/md-toc.min.js'); ?>" charset="utf-8"></script>
	<?php endif; ?>

	<script type="text/javascript" src="https://api.mitsuha.space/apis/hitokoto/?sk=1208944952@qq.com"></script>
	<script src="<?php $this->options->themeUrl('js/modernizr.js'); ?>"></script>

	<!--Favicon-->
	<link rel="icon" type="image/png" href="<?php $this->options->fav(); ?>">
	<link href="/favicon.ico" rel="icon">
	<link rel='dns-prefetch' href='//s.w.org'>
	<link rel="apple-touch-icon-precomposed" href="/favicon.ico">
	<!-- 输出HTML头部信息 -->
	<?php $this->header(); ?>
</head>
<body>
	<div id="welcome" style="height:<?php if ($this->is('post') or $this->is('page')or $this->is('archive')) : ?>60vh<?php elseif($this->is('index')): ?>100vh<?php endif; ?>">
		<?php if ($this->options->enablecover == 1): ?>
			<?php if ($this->is('post')) : ?>
				 <div class="background-img" style="background-image: url(<?php if (isset($this->fields->imgurl)): ?><?php $this->fields->imgurl(); ?><?php else: ?>https://i.loli.net/2017/12/08/5a2a873456a50.jpg<?php endif; ?>);"><div class="bk-mask"></div></div>
		 <?php endif; ?>
		 <?php if ($this->is('page')) : ?>
				 <div class="background-img" style="background-image: url(<?php if (isset($this->fields->imgurl)): ?><?php $this->fields->imgurl(); ?><?php else: ?>https://i.loli.net/2017/12/08/5a2a873456a50.jpg<?php endif; ?>);"><div class="bk-mask"></div></div>
		 <?php endif; ?>
		 <?php if ($this->is('index')) : ?>
				 <div class="background-img" style="background-image: url(https://i.loli.net/2017/12/08/5a2a873456a50.jpg);"></div>
		 <?php endif; ?>
		 <?php if ($this->is('archive')) : ?>
				 <div class="background-img" style="background-image: url(https://i.loli.net/2017/12/08/5a2a873456a50.jpg);"></div>
		 <?php endif; ?>
    <?php endif; ?>
		<?php if ($this->options->enablecover == 0): ?>
			<div class="background-img" style="background-image: url(https://i.loli.net/2017/12/08/5a2a873456a50.jpg);"><div class="bk-mask"></div></div>
		<?php endif; ?>
		<div id="content-w">
				<?php if ($this->is('post')) : ?>
						<h1>
							<?php $this->title() ?>
						</h1>
						<div class="post-meta">
								<p><?php $this->category(','); ?> / <?php $this->date(); ?> / <?php $this->commentsNum('没有评论QAQ', '一个评论', '%d 评论'); ?> / 被围观了<?php get_post_view($this) ?>次</p>
						</div>

				<?php endif; ?>

				<?php if ($this->is('page')) : ?>
						<h1 align="center">「<?php $this->title() ?>」</h1>
						<div class="post-meta">
								<center><p><?php $this->date(); ?></p></center>
						</div>
				<?php endif; ?>

				<?php if ($this->is('archive')) : ?>
						<h1><a style="color:white" href="<?php $this->options->siteUrl(); ?>"><?php $this -> archiveTitle(array('category' => _t('分类「%s」下的文章'), 'search' => _t('包含关键字「%s」的文章'), 'tag' => _t('标签 「%s」 下的文章'), 'author' => _t('「%s」 发布的文章')), '', ''); ?></a></h1>
				<?php endif; ?>

				<?php if ($this->is('index')) : ?>
					<h1 align="center"><?php $this->options->title();?></h1>
					<center><span><script>hitokoto()</script></span></center>
				<?php endif; ?>

		</div>
		<div id="nav">
			<div id="nav-av"><button id="trigger-overlay" type="button"><img id="nav-grav" src="<?php $this->options->describeimg(); ?>"></img></button></div>
		</div>
		</div>

	<div class="overlay overlay-scale">
		<button type="button" class="overlay-close">Close</button>
		<h2><?php $this->author(); ?></h2>
		<p><?php $this->options->describe(); ?></p>
			<nav>
				<ul>
					<li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>

							<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
							<?php while($pages->next()): ?>
								<li><a  href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
							<?php endwhile; ?>
				</ul>
			</nav>
		</div>
<div class="m">
	<div class="content-m">


<!-- end #header -->
