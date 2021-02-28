<?php
  /**
   * Header
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: header.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  $featured = $content->getHomePageItems();
  $len = count($featured);
  $firsthalf = ($featured) ? array_slice($featured, 0, round($len / 2)) : 0;
  $secondhalf = ($featured) ? array_slice($featured, round($len / 2)) : 0;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php $row = isset($row) ? $row : null;?>
<?php echo $content->getMeta($row);?>
<script type="text/javascript">
var SITEURL = "<?php echo SITEURL;?>";
</script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">
<link href="<?php echo THEMEURL . '/cache/' . Minify::cache(array('css/base.css','css/button.css','css/image.css','css/icon.css','css/form.css','css/input.css','css/table.css','css/label.css','css/segment.css','css/message.css','css/divider.css','css/dropdown.css','css/list.css','css/header.css','css/menu.css','css/breadcrumb.css','css/popup.css','css/utility.css','css/style.css'),'css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/popup.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="<?php echo THEMEURL;?>/js/master.js"></script>
</head>
<body>
<header>
  <div class="wojo-grid">
    <div class="wojo-content">
      <div class="columns">
        <div class="screen-30 tablet-30 phone-50">
          <div class="logo"><a href="<?php echo SITEURL;?>"><?php echo ($core->logo) ? '<img src="'.SITEURL.'/uploads/'.$core->logo.'" alt="'.$core->company.'" />': $core->company;?></a></div>
        </div>
        <div class="screen-50 tablet-60 phone-50">
          <h4><i class="icon phone"></i> <?php echo $core->phone;?></h4>
          <p><i class="icon map marker"></i> <?php echo $core->company;?> <?php echo $core->address;?>, <?php echo $core->city;?>, <?php echo $core->state;?> <?php echo $core->zip;?> </p>
        </div>
        <div class="screen-20 tablet-10 hide-phone">
          <div class="wojo two fluid icon buttons"> <a href="<?php echo $core->fb;?>" class="wojo fluid facebook button"><i class="facebook icon"></i></a> <a href="<?php echo $core->twitter;?>" class="wojo twitter button"><i class="twitter icon"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <div id="menu">
    <div class="wojo-grid">
      <nav class="clearfix">
        <div class="columns">
          <div class="screen-75 tablet-70 phone-100"> <?php echo $content->getMenus();?>
            <?php if($cats):?>
            <div class="wojo inline dropdown">
              <div class="text"><?php echo Lang::$word->ADM_CATS;?></div>
              <i class="dropdown icon"></i>
              <div class="menu">
                <?php foreach($cats as $crow):?>
                <a href="<?php echo doUrl(false,$crow->slug,"category");?>" class="item"><?php echo $crow->name;?></a>
                <?php endforeach;?>
              </div>
            </div>
            <?php endif;?>
          </div>
          <div class="screen-25 tablet-30 hide-phone">
            <div class="wojo icon fluid input">
              <input autocomplete="off" name="search" id="liveSearch" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text">
              <i class="search icon"></i>
              <div id="suggestions"></div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>