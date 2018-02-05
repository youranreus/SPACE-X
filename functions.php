<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 function themeConfig($form) {
    echo "<br><h2>这里是设置啦</h2>";
    $enablecover = new Typecho_Widget_Helper_Form_Element_Radio('enablecover',
    array('1' => _t('开启'),
    '0' => _t('关闭')),
    '0', _t('自动切换封面大图'), _t('开启时，文章页会选取自定义字段中的imgurl的图片作为大图，且会有一层遮罩层，防止背景与标题搭配效果不佳'));
    $form->addInput($enablecover);

    $fav = new Typecho_Widget_Helper_Form_Element_Text('fav', NULL, NULL,
    _t('FAVICON'), _t('填写你网站favicon的路径~'));
    $form->addInput($fav);

    $describeimg = new Typecho_Widget_Helper_Form_Element_Text('describeimg', NULL, NULL,
    _t('导航菜单图标'), _t('导航菜单的图标'));
    $form->addInput($describeimg);

    $describe = new Typecho_Widget_Helper_Form_Element_Text('describe', NULL, NULL,
    _t('介绍'), _t('在导航菜单中的介绍哟'));
    $form->addInput($describe);

    $enabletoc = new Typecho_Widget_Helper_Form_Element_Radio('enabletoc',
    array('1' => _t('开启'),
    '0' => _t('关闭')),
    '0', _t('开启文章目录'), _t('默认为关闭'));
    $form->addInput($enabletoc);

    $BANumber = new Typecho_Widget_Helper_Form_Element_Text('BANumber', NULL, NULL,
    _t('备案号'), _t('如果已经备案，请填写备案号。'));
    $form->addInput($BANumber);

    $dnsPrefetch = new Typecho_Widget_Helper_Form_Element_Radio('dnsPrefetch',
    array('1' => _t('开启'),
    '0' => _t('关闭')),
    '0', _t('DNS Prefetch'), _t('开启后会对Gravatar进行预获取。'));
    $form->addInput($dnsPrefetch);

  }



  //计数
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

function theNext($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);
$content = $db->fetchRow($sql);

if ($content) {
$content = $widget->filter($content);
$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">→</a>';
echo $link;
} else {
echo $default;
}
}

/**
* 显示上一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);
$content = $db->fetchRow($sql);
if ($content) {
$content = $widget->filter($content);
$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">←</a>';
echo $link;
} else {
echo $default;
}
}
/**
* 判断时间区间
*/
function timeZone($from){
$now = new Typecho_Date(Typecho_Date::gmtTime());
return $now->timeStamp - $from < 24*60*60 ? true : false;
}

    function formatTime($time)
    {
        $text = '';
        $time = intval($time);
        $ctime = time();
        $t = $ctime - $time; //时间差
        if ($t < 0) {
            return date('Y-m-d', $time);
        }
        ;
        $y = date('Y', $ctime) - date('Y', $time);//是否跨年
        switch ($t) {
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60://一分钟内
                $text = $t . '秒前';
                break;
            case $t < 3600://一小时内
                $text = floor($t / 60) . '分钟前';
                break;
            case $t < 86400://一天内
                $text = floor($t / 3600) . '小时前'; // 一天内
                break;
            case $t < 2592000://30天内
                if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
                    $text = '昨天';
                } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
                    $text = '前天';
                } else {
                    $text = floor($t / 86400) . '天前';
                }
                break;
            case $t < 31536000 && $y == 0://一年内 不跨年
                $m = date('m', $ctime) - date('m', $time) -1;

                if($m == 0) {
                    $text = floor($t / 86400) . '天前';
                } else {
                    $text = $m . '个月前';
                }
                break;
            case $t < 31536000 && $y > 0://一年内 跨年
                $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
                break;
            default:
                $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
                break;
        }

        return $text;
    }

    function dengji($i){
    $db=Typecho_Db::get();
    $mail=$db->fetchAll($db->select(array('COUNT(cid)'=>'rbq'))->from('table.comments')->where('mail = ?', $i)->where('authorId = ?','0'));
    foreach ($mail as $sl){
    $rbq=$sl['rbq'];}
    if($rbq<1){
    echo '蘭';
    }elseif ($rbq<5 && $rbq>0) {
    echo 'バラ';
    }elseif ($rbq<10 && $rbq>=5) {
    echo '椿';
    }elseif ($rbq<15 && $rbq>=10) {
    echo 'ケシ';
    }elseif ($rbq<20 && $rbq>=15) {
    echo '槿';
    }elseif ($rbq<25 && $rbq>=20) {
    echo '蓮';
    }elseif ($rbq>=25) {
    echo '桜';
    }}
    function getCommentAt($coid){
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('author')
                ->from('table.comments')
                ->where('coid = ? AND status = ?', $parent, 'approved'));
            $author = $arow['author'];
            if($author){
            	$href   = '<a class="at" href="#comment-'.$parent.'">@'.$author.'</a>';
        	}else{
        		$href   = '<a href="javascript:void(0)">评论审核中···</a>';
        	}
            echo $href;
        } else {
            echo "";
        }
    }
    function getGravatar($i){
    if(preg_match('|^[1-9]\d{4,10}@qq\.com$|i',$i)){
    	echo 'https://q.qlogo.cn/g?b=qq&nk='.$i.'&s=100';
    }else{
        $host = 'https://secure.gravatar.com';
        $url = '/avatar/';
        $size = '80';
        $rating = Helper::options()->commentsAvatarRating;
        $hash = md5(strtolower($i));
        $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=https://secure.gravatar.com/avatar/533cfdfce09a1cdedb785aaf5c3df7b4?s=30&r=X';
        echo $avatar;
    	}
    }
    function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);
if($since < 2592000){
for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';
}else{
$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
}
return $output;
}

function ran_img(){
    $random = rand(0,18);
    $pic_bj=array(
      "https://i.loli.net/2017/11/11/5a06dbc622beb.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc642df7.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc65063e.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc658f3e.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc65f310.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc66fc50.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc67a5a2.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc6817fe.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc690aeb.jpg",
      "https://i.loli.net/2017/11/11/5a06dbc69461d.jpg",
      "https://i.loli.net/2017/11/11/5a06dc277b1e6.jpg",
      "https://i.loli.net/2017/11/11/5a06dc277fa61.jpg",
      "https://i.loli.net/2017/11/11/5a06dc2780ff3.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27b7753.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27b9d01.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27bec39.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27c2f93.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27ccfb5.jpg",
      "https://i.loli.net/2017/11/11/5a06dc27cef2d.jpg"
  );
  echo $pic_bj[$random];
    }

function img_postthumb($cid) {
       $db = Typecho_Db::get();
       $rs = $db->fetchRow($db->select('table.contents.text')
           ->from('table.contents')
           ->where('table.contents.cid=?', $cid)
           ->order('table.contents.cid', Typecho_Db::SORT_ASC)
           ->limit(1));

       preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $rs['text'], $thumbUrl);  //通过正则式获取图片地址
       $img_src = $thumbUrl[1][0];  //将赋值给img_src
       $img_counter = count($thumbUrl[0]);  //一个src地址的计数器

       switch ($img_counter > 0) {
           case $allPics = 1:
               echo $img_src;  //当找到一个src地址的时候，输出缩略图
               break;
           default:
               echo "";  //没找到(默认情况下)，不输出任何内容
       };
    }


  function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}
function prev_post($archive)
{
  $db = Typecho_Db::get();
  $content = $db->fetchRow($db->select()
                              ->from('table.contents')
                              ->where('table.contents.created < ?', $archive->created)
                              ->where('table.contents.status = ?', 'publish')
                              ->where('table.contents.type = ?', $archive->type)
                              ->where('table.contents.password IS NULL')
                              ->order('table.contents.created', Typecho_Db::SORT_DESC)
                              ->limit(1));
  if ($content)
  {
    $content = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($content);
    echo '<a class="prev" href="' . $content['permalink'] . '" rel="prev"><span>上一篇</span><br/>' . $content['title'] . '</a>';
  } else {
    echo "<a class=\"prev\"><span>\xf0\x9F\x98\xb6</span><br/>没有更多了</a>";
  }
}

function next_post($archive)
{
  $db = Typecho_Db::get();
  $content = $db->fetchRow($db->select()
                              ->from('table.contents')
                              ->where('table.contents.created > ? AND table.contents.created < ?', $archive->created, Helper::options()->gmtTime)
                              ->where('table.contents.status = ?', 'publish')
                              ->where('table.contents.type = ?', $archive->type)
                              ->where('table.contents.password IS NULL')
                              ->order('table.contents.created', Typecho_Db::SORT_ASC)
                              ->limit(1));

  if ($content)
  {
    $content = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($content);
    echo '<a class="next" href="' . $content['permalink'] . '" rel="next"><span>下一篇</span><br/>' . $content['title'] . '</a>';
  } else {
    echo "<a class=\"next\"><span>\xf0\x9F\x98\xb6</span><br/>没有更多了</a>";
  }
}

function bili2post($content){
  $str = $content;

  preg_match_all ("/<bili>(.*)<\/bili>/U", $str, $av);
  $i = count($av[0]);

  $x = 0;
  for ($x; $x<$i; $x++)
  {
    $ex = "/<bili>(.*)<\/bili>/U";

    $avnum = ltrim($av[0][$x],"<bili>");
    $avnum = rtrim($avnum,"</bili>");

    $bili1 = "<embed height='415' width='544' quality='high' allowfullscreen='true' type='application/x-shockwave-flash' src='https://static.hdslb.com/miniloader.swf' flashvars='aid=";
    $bili2 = "&page=1' pluginspage='https://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash'></embed><br>";
    $ex2 = $bili1.$avnum.$bili2;

    $str = preg_replace($ex,$ex2,$str);
  }
  echo $str;
}
