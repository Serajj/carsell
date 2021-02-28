<?php
  /**
   * Footer
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: footer.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<footer>
  <div class="wojo-grid">
    <div class="wojo-content">
      <div class="columns gutters">
        <div class="screen-70 tablet-50 phone-100">
          <?php if($featured):?>
          <h3 class="wojo header"><span>Featured Listings</span></h3>
          <div class="three columns horizontal-gutters">
          <?php foreach($featured as $frow):?>
          <div class="row"><a href="<?php echo doUrl($frow->idx,$frow->slug, "item");?>"> <i class="icon right angle"></i> <?php echo $frow->title;?></a></div>
          <?php endforeach;?>
          </div>
          <?php endif;?>
        </div>
        <div class="screen-30 tablet-50 phone-100">
          <?php include(THEMEDIR . "/subscribe.tpl.php");?>
        </div>
      </div>
      <div class="wojo inverted divider"></div>
      <div class="content-center">Copyright &copy;<?php echo date('Y').' '.$core->company;?> &bull; Powered by: Car Dealer Pro v<?php echo $core->ver;?></div></div>
  </div>
</footer>
</body></html>