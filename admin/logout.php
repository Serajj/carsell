<?php
  /**
   * Logout
   *
   * @package Business Directory Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: logout.php, v1.00 2012-03-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
?>
<?php
  if ($user->logged_in)
      $user->logout();
	  
  redirect_to("login.php");
?>