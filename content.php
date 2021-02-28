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
  
  $row = $content->getContent();
?>
<?php include("header.php");?>
<?php if($row):?>
  <?php if($row->contact):?>
  <?php include(THEMEDIR . "/contact.tpl.php");?>
  <?php elseif($row->faq):?>
  <?php include(THEMEDIR . "/faq.tpl.php");?>
  <?php else:?>
  <?php include(THEMEDIR . "/content.tpl.php");?>
  <?php endif;?>
<?php else:?>
<?php redirect_to(SITEURL . '/404.php');?>
<?php endif;?>
<?php include("footer.php");?>