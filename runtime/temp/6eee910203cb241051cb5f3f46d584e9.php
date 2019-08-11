<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:41:"C:\www\addons\cms\view\default\index.html";i:1565366474;s:49:"C:\www\addons\cms\view\default\common\layout.html";i:1565460317;s:53:"C:\www\addons\cms\view\default\common\index_list.html";i:1565255701;s:47:"C:\www\addons\cms\view\default\common\item.html";i:1565255701;s:51:"C:\www\addons\cms\view\default\common\sidebar1.html";i:1565358336;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit">
    <title><?php echo \think\Config::get("cms.title"); ?> - <?php echo \think\Config::get("cms.sitename"); ?></title>
    <meta name="keywords" content="<?php echo \think\Config::get("cms.keywords"); ?>"/>
    <meta name="description" content="<?php echo \think\Config::get("cms.description"); ?>"/>

    <link rel="stylesheet" media="screen" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" media="screen" href="/assets/libs/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" media="screen" href="/assets/libs/fastadmin-layer/dist/theme/default/layer.css"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/swiper.min.css">
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/common.css?v=<?php echo \think\Config::get("site.version"); ?>"/>

    <link rel="stylesheet" href="//at.alicdn.com/t/font_1104524_z1zcv22ej09.css">

    {__STYLE__}

    <!--[if lt IE 9]>
    <script src="/libs/html5shiv.js"></script>
    <script src="/libs/respond.min.js"></script>
    <![endif]-->

</head>
<body class="group-page">

<header class="header">
    <!-- S 导航 -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo \think\Config::get("cms.indexurl"); ?>"><img src="/assets/addons/cms/img/logo.png" width="180" alt=""></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <!--如果你需要自定义NAV,可使用channellist标签来完成,这里只设置了2级,如果显示无限级,请使用cms:nav标签-->
                    <?php $__rCLMKwg6I3__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__rCLMKwg6I3__) || $__rCLMKwg6I3__ instanceof \think\Collection || $__rCLMKwg6I3__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__rCLMKwg6I3__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                    <!--判断是否有子级或高亮当前栏目-->
                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">
                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php $__gc8bsUDGCi__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__gc8bsUDGCi__) || $__gc8bsUDGCi__ instanceof \think\Collection || $__gc8bsUDGCi__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__gc8bsUDGCi__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__gc8bsUDGCi__; ?>
                        </ul>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__rCLMKwg6I3__; ?>
                </ul>
                <ul class="nav navbar-right hidden">
                    <ul class="nav navbar-nav">
                        <li><a href="javascript:;" class="addbookbark"><i class="fa fa-star"></i> 加入收藏</a></li>
                        <li><a href="javascript:;" class=""><i class="fa fa-phone"></i> 联系我们</a></li>
                    </ul>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="form-inline navbar-form" action="<?php echo addon_url('cms/search/index'); ?>" method="get">
                            <div class="form-search hidden-sm hidden-md">
                                <input class="form-control typeahead" name="search" data-typeahead-url="<?php echo addon_url('cms/search/typeahead'); ?>" type="text" id="searchinput" placeholder="搜索">
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <?php if($user): ?>
                        <a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;height: 50px;">
                            <span class="avatar-img"><img src="<?php echo cdnurl($user['avatar']); ?>" style="width:30px;height:30px;border-radius:50%;" alt=""></span>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown">社员<span class="hidden-sm">中心</span> <b class="caret"></b></a>
                        <?php endif; ?>
                        <ul class="dropdown-menu">
                            <?php if($user): ?>
                            <li><a href="<?php echo url('index/user/index'); ?>"><i class="fa fa-user fa-fw"></i>社员中心</a></li>
                            <li><a href="<?php echo url('index/cms.archives/my'); ?>"><i class="fa fa-list fa-fw"></i>我发布的文章</a></li>
                            <li><a href="<?php echo url('index/cms.archives/post'); ?>"><i class="fa fa-pencil fa-fw"></i>发布文章</a></li>
                            <li><a href="<?php echo url('index/user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i>注销</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo url('index/user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>登录</a></li>
                            <li><a href="<?php echo url('index/user/register'); ?>"><i class="fa fa-user-o fa-fw"></i>注册</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- E 导航 -->

</header>


<div class="container" id="content-container">

    <!--<div style="margin-bottom:20px;">-->
    <!---->
    <!--</div>-->

    <div class="row">

        <main class="col-md-8">
            <div class="swiper-container index-focus">
                <!-- S 焦点图 -->
                <div id="index-focus" class="carousel slide carousel-focus" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $__itOghnVePF__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"indexfocus","row"=>"5"]); if(is_array($__itOghnVePF__) || $__itOghnVePF__ instanceof \think\Collection || $__itOghnVePF__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__itOghnVePF__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                        <li data-target="#index-focus" data-slide-to="<?php echo $i-1; ?>" class="<?php if($i==1): ?>active<?php endif; ?>"></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__itOghnVePF__; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $__6AFJesEhCq__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"indexfocus","row"=>"5"]); if(is_array($__6AFJesEhCq__) || $__6AFJesEhCq__ instanceof \think\Collection || $__6AFJesEhCq__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__6AFJesEhCq__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                        <div class="item <?php if($i==1): ?>active<?php endif; ?>">
                            <a href="<?php echo $block['url']; ?>">
                                <div class="carousel-img" style="background-image:url('<?php echo cdnurl($block['image']); ?>');"></div>
                                <div class="carousel-caption hidden-xs">
                                    <h3><?php echo $block['title']; ?></h3>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__6AFJesEhCq__; ?>
                    </div>
                    <a class="left carousel-control" href="#index-focus" role="button" data-slide="prev">
                        <span class="icon-prev fa fa-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#index-focus" role="button" data-slide="next">
                        <span class="icon-next fa fa-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- E 焦点图 -->
            </div>

            <div class="panel panel-default index-gallary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span>新闻组图</span>
                        <div class="more">
                            <a href="<?php echo addon_url('cms/channel/index', [':id'=>2, ':diyname'=>'product']); ?>">查看更多</a>
                        </div>
                    </h3>

                </div>
                <div class="panel-body">
                    <div class="related-article">
                        <div class="row">
                            <!-- S 新闻组图 -->
                            <?php $__Cm43Zq2M9x__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>2,"orderby"=>"views","row"=>"4"]); if(is_array($__Cm43Zq2M9x__) || $__Cm43Zq2M9x__ instanceof \think\Collection || $__Cm43Zq2M9x__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Cm43Zq2M9x__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="col-sm-3 col-xs-6">
                                <a href="<?php echo $item['url']; ?>" class="img-zoom">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" class="embed-responsive-item">
                                    </div>
                                </a>
                                <h5><?php echo $item['title']; ?></h5>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Cm43Zq2M9x__; ?>
                            <!-- E 新闻组图 -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span>最近更新</span>

                        <div class="more hidden-xs">
                            <ul class="list-unstyled list-inline">
                                <!-- E 栏目筛选 -->
                                <?php $__tPlr9kNjyb__ = \addons\cms\model\Channel::getChannelList(["id"=>"item","condition"=>"'list'=type","limit"=>"6"]); if(is_array($__tPlr9kNjyb__) || $__tPlr9kNjyb__ instanceof \think\Collection || $__tPlr9kNjyb__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__tPlr9kNjyb__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                <li><?php echo $item['textlink']; ?></li>
                                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__tPlr9kNjyb__; ?>
                                <!-- E 栏目筛选 -->
                            </ul>
                        </div>
                    </h3>
                </div>
                <div class="panel-body p-0">
                    <div class="article-list">
                        <?php $page=request()->get('page/d',1);$offset=($page-1)*10; ?>

<!-- S 首页列表 -->
<?php $__0au8GNopRE__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","cache"=>"false","orderby"=>"weigh","limit"=>"$offset,10"]); if(is_array($__0au8GNopRE__) || $__0au8GNopRE__ instanceof \think\Collection || $__0au8GNopRE__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__0au8GNopRE__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
<article class="article-item">
    <div class="media">
        <div class="media-left">
            <a href="<?php echo $item['url']; ?>">
                <div class="embed-responsive embed-responsive-4by3 img-zoom">
                    <img src="<?php echo $item['image']; ?>">
                </div>
            </a>
        </div>
        <div class="media-body">
            <h3 class="article-title">
                <a href="<?php echo $item['url']; ?>" <?php if($item['style']): ?>style="<?php echo $item['style_text']; ?>"<?php endif; ?>><?php echo $item['title']; ?></a>
            </h3>
            <div class="article-intro hidden-xs">
                <?php echo $item['description']; ?>
            </div>
            <div class="article-tag">
                <a href="<?php echo $item['channel']['url']; ?>" class="tag tag-primary"><?php echo $item['channel']['name']; ?></a>
                <span itemprop="date"><?php echo date("Y年m月d日", $item['publishtime']); ?></span>
                <span itemprop="likes" title="点赞次数"><i class="fa fa-thumbs-up"></i> <?php echo $item['likes']; ?> 点赞</span>
                <span itemprop="comments"><a href="<?php echo $item['url']; ?>#comments" target="_blank" title="评论数"><i class="fa fa-comments"></i> <?php echo $item['comments']; ?></a> 评论</span>
                <span itemprop="views" title="浏览次数"><i class="fa fa-eye"></i> <?php echo $item['views']; ?> 浏览</span>
            </div>
        </div>
    </div>

</article>
<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__0au8GNopRE__; ?>
<!-- E 首页列表 -->

<?php if(!$__LASTLIST__): ?>
    <div class="loadmore loadmore-line loadmore-nodata"><span class="loadmore-tips">暂无更多数据</span></div>
<?php else: ?>
    <div class="text-center">
        <a href="?page=<?php echo $page+1; ?>" data-page="<?php echo $page; ?>" class="btn btn-default my-4 px-4 btn-loadmore">加载更多</a>
    </div>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </main>

        <aside class="col-xs-12 col-sm-4">
            <div class="panel panel-default lasest-update">
                <!-- S 最近更新 -->
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo __('Recently update'); ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <?php $__Q2fGNEI8iq__ = \addons\cms\model\Archives::getArchivesList(["id"=>"new","row"=>"8","orderby"=>"id","orderway"=>"desc"]); if(is_array($__Q2fGNEI8iq__) || $__Q2fGNEI8iq__ instanceof \think\Collection || $__Q2fGNEI8iq__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Q2fGNEI8iq__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?>
                        <li>
                            <span>[<a href="<?php echo $new['channel']['url']; ?>"><?php echo $new['channel']['name']; ?></a>]</span>
                            <a class="link-dark" href="<?php echo $new['url']; ?>" title="<?php echo $new['title']; ?>"><?php echo $new['title']; ?></a>

        <span itemprop="date" style="float:right;vertical-align:top;"><?php echo date("m-d", $item['publishtime']); ?></span>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Q2fGNEI8iq__; ?>
                    </ul>
                </div>
                <!-- E 最近更新 -->
            </div>

            <div class="panel panel-blockimg">

            </div>

            


<!-- S 热门资讯 -->
<div class="panel panel-default hot-article">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Recommend news'); ?></h3>
    </div>
    <div class="panel-body">
        <?php $__4svihPu0tA__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>1,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc"]); if(is_array($__4svihPu0tA__) || $__4svihPu0tA__ instanceof \think\Collection || $__4svihPu0tA__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__4svihPu0tA__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a class="link-dark" href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__4svihPu0tA__; ?>
    </div>
</div>
<!-- E 热门资讯 -->







        </aside>
    </div>
</div>



<script data-render="script">
    $(function () {
        $(document).on("click", ".btn-loadmore", function () {
            var that = this;
            var page = parseInt($(this).data("page"));
            page++;
            CMS.api.ajax({
                url: "<?php echo addon_url('cms/index/get_index_list'); ?>?page=" + page,
            }, function (data, ret) {
                $(data).insertBefore($(that).parent());
                $(that).remove();
                return false;
            }, function (data) {

            });
            return false;
        });
    });
</script>

<!-- <footer>
    <div class="container-fluid" id="footer">
        <div class="container">
            <div class="row footer-inner">
                
            </div>
        </div>
    </div>
</footer> -->

<div id="floatbtn">
    <!-- S 浮动按钮 -->

    <?php if(isset($config['wxapp'])&&$config['wxapp']): ?>
    <a href="javascript:;">
        <i class="iconfont icon-wxapp"></i>
        <div class="floatbtn-wrapper">
            <div class="qrcode"><img src="<?php echo cdnurl($config['wxapp']); ?>"></div>
            <p>微信小程序</p>
            <p>微信扫一扫体验</p>
        </div>
    </a>
    <?php endif; ?>

    <a class="hover" href="<?php echo url('index/cms.archives/post'); ?>" target="_blank">
        <i class="iconfont icon-pencil"></i>
        <em>立即<br>投稿</em>
    </a>

    <?php if($config['qrcode']): ?>
    <a href="javascript:;">
        <i class="iconfont icon-qrcode"></i>
        <div class="floatbtn-wrapper">
            <div class="qrcode"><img src="<?php echo cdnurl($config['qrcode']); ?>"></div>
            <p>微信公众账号</p>
            <p>微信扫一扫加关注</p>
        </div>
    </a>
    <?php endif; if(isset($__ARCHIVES__)): ?>
    <a id="feedback" class="hover" href="#comments">
        <i class="iconfont icon-feedback"></i>
        <em>发表<br>评论</em>
    </a>
    <?php endif; ?>

    <a id="back-to-top" class="hover" href="javascript:;">
        <i class="iconfont icon-backtotop"></i>
        <em>返回<br>顶部</em>
    </a>
    <!-- E 浮动按钮 -->
</div>


<script type="text/javascript" src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/libs/fastadmin-layer/dist/layer.js"></script>
<script type="text/javascript" src="/assets/libs/art-template/dist/template-native.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/bootstrap-typeahead.min.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/swiper.min.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/cms.js?r=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/assets/addons/cms/js/common.js?r=<?php echo $site['version']; ?>"></script>

{__SCRIPT__}

</body>
</html>