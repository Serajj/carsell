<?php
  /**
   * 404
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: 404.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  $faqrow = $content->getFaq();
?>
<div class="wojo-grid">
  <div class="wojo-double-content">
    <div class="foferror"><span>404</span>
      <p><?php echo Lang::$word->ER_404;?></p>
      <div class="wojo divider"></div>
      <p><?php echo Lang::$word->ER_404_1;?></p>
    </div>
  </div>
</div>