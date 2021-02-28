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

  $home = $content->getHomePage();
?>
<?php include("header.php");?>
<?php include(THEMEDIR . "/index.tpl.php");?>
<?php include("footer.php");?>