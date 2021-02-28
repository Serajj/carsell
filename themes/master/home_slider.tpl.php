<?php
  /**
   * Home Slider
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: home_slider.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php if($firsthalf):?>
<div id="featured" class="clearfix">
  <div class="wojo-carousel" 
        data-pagination="true" 
        data-navigation="false" 
        data-single-item="true"
        data-auto-play="false"
        data-transition-style="fadeUp"
        >
    <?php foreach($firsthalf as $frow):?>
    <?php if($frow->featured):?>
    <section>
      <?php if($frow->thumb):?>
      <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/'.$frow->thumb;?>&amp;w=700&amp;h=500" alt="">
      <?php else:?>
      <img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt="">
      <?php endif;?>
      <article>
        <h3 class="wojo header"><a href="<?php echo dourl($frow->idx, $frow->slug, "item");?>"><?php echo $frow->year;?> <?php echo $frow->title;?></a></h3>
        <p><?php echo $frow->milege . $core->odometer;?> <?php echo Lang::$word->LST_ENGINE;?>: <?php echo $frow->engine;?></p>
        <span class="price"><?php echo $core->formatMoney((compareNumbers($frow->price_sale, $frow->price, '<')) ? $frow->price_sale : $frow->price);?></span> </article>
    </section>
    <?php endif;?>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>