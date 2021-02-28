<?php
  /**
   * Content
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: content.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!-- Start Content-->
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="wojo breadcrumb">
      <div class="section"><?php echo Lang::$word->ADM_CONTENT;?></div>
      <div class="divider"> / </div>
      <a class="active section"><?php echo $row->title;?></a></div>
    <div class="wojo divider"></div>
    <div class="wojo segment">
      <h2 class="wojo header"> <?php echo $row->title;?></h2>
      <div class="wojo fitted divider"></div>
      <section id="content"><?php echo cleanOut($row->body);?></section></div>
  </div>
</div>