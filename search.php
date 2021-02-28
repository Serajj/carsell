<?php
  /**
   * Search
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: search.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once ("init.php");
  
  $search = $content->getSearchResults();
?>
<?php include("header.php");?>
<?php include(THEMEDIR . "/search.tpl.php");?>
<?php include("footer.php");?>