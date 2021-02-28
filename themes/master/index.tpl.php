<?php
  /**
   * Index
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: index.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="columns horizontal-gutters">
      <div class="screen-60 tablet-50 phone-100">
        <?php include(THEMEDIR . "/home_slider.tpl.php");?>
      </div>
      <div class="screen-40 tablet-50 phone-100">
        <?php include(THEMEDIR . "/home_search.tpl.php");?>
      </div>
    </div>
    <div class="wojo section divider"></div>
    <div class="two columns horizontal-gutters">
      <div class="row">
        <?php if($home):?>
        <div class="wojo segment">
          <h2 class="wojo header"><?php echo $home->title;?></h2>
          <?php echo cleanOut($home->body);?></div>
        <?php endif;?>
      </div>
      <div class="row">
        <?php if($secondhalf):?>
        <div class="clearfix">
          <div class="wojo-carousel" 
        data-pagination="false" 
        data-navigation="true" 
        data-single-item="true"
        data-auto-play="false"
        data-auto-height="false"
        data-transition-style="fade"
        >
            <?php foreach($secondhalf as $frow):?>
            <div class="wojo fitted segment">
              <section>
                <?php if($frow->thumb):?>
                <img src="<?php echo UPLOADURL.'/listings/'.$frow->thumb;?>" alt="">
                <?php else:?>
                <img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt="">
                <?php endif;?>
              </section>
              <aside>
                <div class="wojo-content">
                  <h4 class="content-center"><a href="<?php echo dourl($frow->idx, $frow->slug, "item");?>"><?php echo truncate($frow->title,25);?></a></h4>
                  <div class="wojo half divider"></div>
                  <?php echo Lang::$word->LST_YEAR;?>: <?php echo $frow->year;?>
                  <div class="wojo half divider"></div>
                  <?php echo Lang::$word->MILEAGE;?>: <?php echo $frow->milege . $core->odometer;?>
                  <div class="wojo half divider"></div>
                  <?php echo Lang::$word->LST_ENGINE;?>: <?php echo $frow->engine;?>
                  <div class="wojo half divider"></div>
                  <div class="content-center"><span class="wojo success label"><?php echo $core->formatMoney((compareNumbers($frow->price_sale, $frow->price, '<')) ? $frow->price_sale : $frow->price);?></span></div>
                </div>
              </aside>
            </div>
            <?php endforeach;?>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<div class="sub-footer">
  <div class="wojo-grid">
    <div class="wojo-content">
      <?php if($cats):?>
      <div class="content-center">
        <h3 class="wojo shadow header"><?php echo Lang::$word->HEAD_CHOOSE;?></h3>
      </div>
      <div class="wojo section divider"></div>
      <div class="four columns small-gutters">
        <?php $color = array("positive","info","warning","negative","purple","black","teal","linkedin","positive","info","warning","negative","purple","black","teal","linkedin");?>
        <?php foreach($cats as $i => $crow):?>
        <div class="row">
          <div class="wojo <?php echo $color[$i];?> fluid button"><a href="<?php echo doUrl(false,$crow->slug,"category");?>"> <img src="<?php echo SITEURL;?>/assets/images/catico/<?php echo $crow->image;?>" alt=""></a>
            <p><?php echo $crow->name;?> (<?php echo $crow->total;?>)</p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>