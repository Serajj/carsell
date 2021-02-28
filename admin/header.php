<?php
  /**
   * Header
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: header.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $core->site_name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">
<link href="<?php echo THEMEU . '/cache/' . Minify::cache(array('css/base.css','css/button.css','css/image.css','css/icon.css','css/breadcrumb.css','css/popup.css','css/form.css','css/input.css','css/table.css','css/label.css','css/segment.css','css/message.css','css/divider.css','css/dropdown.css','css/list.css','css/header.css','css/menu.css','css/datepicker.css','css/editor.css','css/utility.css','css/style.css'),'css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../assets/jquery.js"></script>
<script type="text/javascript" src="../assets/jquery-ui.js"></script>
<script type="text/javascript" src="../assets/global.js"></script>
<script type="text/javascript" src="../assets/popup.js"></script>
<script type="text/javascript" src="assets/js/editor.js"></script>
<script type="text/javascript" src="../assets/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="assets/master.js"></script>
</head>
<body>
<div class="wojo wide floating red right sidebar"></div>
<div id="top-nav">
  <div class="wojo-grid">
    <div class="wojo-content">
      <div class="columns horizontal-gutters">
        <div class="screen-50 tablet-50 phone-100">
          <div class="logo"><a href="index.php"><?php echo ($core->logo) ? '<img src="'.SITEURL.'/uploads/'.$core->logo.'" alt="'.$core->company.'" />': $core->company;?></a></div>
        </div>
        <div class="screen-50 tablet-50 phone-100">
          <div class="user-info push-right">
            <div class="wojo buttons">
              <div class="wojo button"><?php echo Lang::$word->WELCOME;?> <?php echo $user->username;?>!</div>
              <div class="wojo top right pointing dropdown icon button"> <i class="dropdown icon"></i>
                <div class="menu"> <a href="index.php?do=language" class="item"><i class="chat icon"></i><?php echo Lang::$word->ADM_LANG;?></a> <a href="index.php?do=system" class="item"><i class="desktop icon"></i><?php echo Lang::$word->ADM_SYSTEM;?></a> <a href="index.php?do=backup" class="item"><i class="hdd icon"></i><?php echo Lang::$word->ADM_BACKUP;?></a> <a href="index.php?do=sitemap" class="item"><i class="sitemap icon"></i><?php echo Lang::$word->ADM_SITEMAP;?></a> <a class="item" href="logout.php"><i class="icon sign out"></i><?php echo Lang::$word->LOGOUT;?></a>
                  <div class="item"><i class="icon calendar"></i> <?php echo Lang::$word->USR_LASTLOGIN;?>: <?php echo Filter::doDate("short_date", $user->last);?> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<header>
  <div class="wojo-grid">
    <div class="wojo-content">
      <ul id="nav" class="clearfix">
        <li class="wojo pointing dropdown <?php echo (Filter::$do == 'pages' or Filter::$do == 'menus' or Filter::$do == 'faq') ? "active" : "normal";?>"><a ><i class="icon list layout"></i><?php echo Lang::$word->ADM_CONTENT;?><span><i class="angle down icon"></i></span></a>
          <div class="menu">
            <div class="item"><i class="sitemap icon"></i><a href="index.php?do=menus"><?php echo Lang::$word->ADM_MENUS;?></a></div>
            <div class="item"><i class="mail icon"></i><a href="index.php?do=etemplates"><?php echo Lang::$word->ADM_ETPL;?></a></div>
            <div class="item"><i class="copy icon"></i><a href="index.php?do=pages"><?php echo Lang::$word->ADM_PAGES;?></a></div>
            <div class="item"><i class="help icon"></i><a href="index.php?do=faq"><?php echo Lang::$word->ADM_FAQ;?></a></div>
            <div class="item"><i class="mail reply icon"></i><a href="index.php?do=newsletter"><?php echo Lang::$word->ADM_NLETTER;?></a></div>
          </div>
        </li>
        <li class="wojo pointing dropdown"> <a class="<?php echo (Filter::$do == 'category' or Filter::$do == 'makes' or Filter::$do == 'models' or Filter::$do == 'features' or Filter::$do == 'conditions' or Filter::$do == 'transmissions' or Filter::$do == 'fuel') ? "active" : "normal";?>"><i class="icon briefcase"></i><?php echo Lang::$word->ADM_INVENTORY;?><span><i class="angle down icon"></i></span></a>
          <div class="menu">
            <div class="item"><i class="ellipsis horizontal icon"></i><a href="index.php?do=category"><?php echo Lang::$word->ADM_CATS;?></a></div>
            <div class="item"><i class="book icon"></i><a href="index.php?do=makes"><?php echo Lang::$word->ADM_MAKES;?></a></div>
            <div class="item"><i class="book icon"></i><a href="index.php?do=models"><?php echo Lang::$word->ADM_MODELS;?></a></div>
            <div class="item"><i class="reorder icon"></i><a href="index.php?do=features"><?php echo Lang::$word->ADM_FEATURES;?></a></div>
            <div class="item"><i class="road icon"></i><a href="index.php?do=conditions"><?php echo Lang::$word->ADM_COND;?></a></div>
            <div class="item"><i class="settings icon"></i><a href="index.php?do=transmissions"><?php echo Lang::$word->ADM_TRANS;?></a></div>
            <div class="item"><i class="fire icon"></i><a href="index.php?do=fuel"><?php echo Lang::$word->ADM_FUEL;?></a></div>
          </div>
        </li>
        <li><a href="index.php?do=listings" class="<?php echo (Filter::$do == 'listings' or Filter::$do == 'gallery' or Filter::$do == 'preview') ? "active" : "normal";?>"><i class="icon tasks"></i><?php echo Lang::$word->ADM_LISTINGS;?></a></li>
        <li><a href="index.php?do=locations" class="<?php echo (Filter::$do == 'locations') ? "active" : "normal";?>"><i class="icon map marker"></i><?php echo Lang::$word->ADM_LOCS;?></a></li>
        <li><a href="index.php?do=users" class="<?php echo (Filter::$do == 'users') ? "active" : "normal";?>"><i class="icon user"></i><?php echo Lang::$word->ADM_USERS;?></a></li>
        <li><a href="index.php?do=config" class="<?php echo (Filter::$do == 'config') ? "active" : "normal";?>"><i class="icon laptop"></i><?php echo Lang::$word->ADM_CONFIG;?></a></li>
      </ul>
    </div>
  </div>
</header>