<?php
  /**
   * Header
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: header.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  $cats = $content->getCategories();
?>
<?php include(THEMEDIR . "/header.tpl.php");?>