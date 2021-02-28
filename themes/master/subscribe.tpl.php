<?php
  /**
   * Subscribe
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: subscribe.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo inverted segment">
  <h4 class="header"><?php echo Lang::$word->STAY_TUNED;?></h4>
  <div class="wojo inverted fitted divider"></div>
  <div class="wojo small form">
    <div class="field">
      <div class="wojo small action input">
        <input name="email_subscribe" type="text" placeholder="<?php echo Lang::$word->EMAIL;?>">
        <a id="doNewsletter" class="wojo positive button"><?php echo Lang::$word->GO;?></a> </div>
    </div>
    <div class="field">
      <div class="inline-group">
        <label class="radio">
          <input name="subscribe" type="radio" value="y" checked="checked">
          <i></i><?php echo Lang::$word->SUBSCRIBE;?></label>
        <label class="radio">
          <input name="subscribe" type="radio" value="n">
          <i></i><?php echo Lang::$word->UNSUBSCRIBE;?></label>
      </div>
    </div>
  </div>
 <div id="scsmsg"></div> 
</div>