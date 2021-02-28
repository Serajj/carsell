<?php
  /**
   * Index
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: index.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once ("init.php");
  
  $row = $content->getSingleCategory();
?>
<?php include("header.php");?>
<?php if($row):?>
<?php $catrow = $content->getItemsByCategory($row->id);?>
<?php $filterLink = doUrl(false, $row->slug, "category");?>
<?php list($sort_by, $orders, $types) = Content::renderCategoryFilter($filterLink, "category.php");?>
<?php include(THEMEDIR . "/category.tpl.php");?>
<?php else:?>
<?php redirect_to(SITEURL . '/404.php');?>
<?php endif;?>
<?php include("footer.php");?>