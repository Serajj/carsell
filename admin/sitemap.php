<?php
  /**
   * Sitemap
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: sitemap.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>

<h1 class="main-header"><?php echo Lang::$word->MAP_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_SITEMAP;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="sitemap icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->MAP_SUB;?> </div>
    <p><?php echo Lang::$word->MAP_INFO;?></p>
  </div>
</div>
<div class="wojo segment">
  <form id="wojo_form" name="wojo_form" method="post">
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->MAP_CREATE;?></button>
    <input name="processSitemap" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>