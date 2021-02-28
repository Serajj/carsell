<?php
  /**
   * Print
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: print.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once ("init.php");
  
   $row = (Filter::$id) ? $content->getListingPreview() : Filter::error("You have selected an Invalid Id", "Content::getListingPreview()");
   $galdata = $content->getGallery();
?>
<?php include(THEMEDIR . "/print_header.tpl.php");?>
<?php if($row):?>
<?php include(THEMEDIR . "/print.tpl.php");?>
<?php else:?>
<?php redirect_to(SITEURL . '/404.php');?>
<?php endif;?>
<?php include(THEMEDIR . "/print_footer.tpl.php");?>