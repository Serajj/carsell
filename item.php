<?php
  /**
   * Content
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: content.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once ("init.php");
  
  $row = $content->renderListing();
?>
<?php include("header.php");?>
<?php if($row):?>
<?php include(THEMEDIR . "/item.tpl.php");?>
<?php else:?>
<?php redirect_to(SITEURL . '/404.php');?>
<?php endif;?>
<?php include("footer.php");?>