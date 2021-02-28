<?php
  /**
   * Search
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: search.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!-- Start Search -->
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="wojo breadcrumb">
      <div class="section"><a href="<?php echo SITEURL;?>/"><?php echo Lang::$word->PAG_HOME;?></a></div>
      <div class="divider"> / </div>
      <div class="active section"><?php echo Lang::$word->FRONT_SEARCH;?></div>
    </div>
    <div class="wojo divider"></div>
    <div class="columns horizontal-gutters">
      <div class="screen-70 tablet-50 phone-100">
        <div class="wojo secondary small form segment">
          <div class="four columns small-horizontal-gutters">
            <div class="row"> <span class="wojo large fluid button"><?php echo Lang::$word->TOTAL.': '.$pager->items_total;?></span></div>
            <div class="row"><span class="wojo large fluid button"><?php echo Lang::$word->CURPAGE.': '.$pager->current_page.' '.Lang::$word->OF.' '.$pager->num_pages;?></span></div>
            <div class="row"> <?php echo $pager->items_per_page();?> </div>
            <div class="row"> <?php echo $pager->jump_menu();?> </div>
          </div>
        </div>
        <?php if(!$search):?>
        <?php echo Filter::msgSingleAlert(Lang::$word->NO_LIST);?>
        <?php else:?>
        <?php foreach($search as $crow):?>
        <div class="wojo fitted segment">
          <?php if($crow->featured):?>
          <div class="wojo ribbon">
            <div class="ribbon"><?php echo Lang::$word->FEATURED;?></div>
          </div>
          <?php endif;?>
          <section class="category"> <a href="<?php echo dourl($crow->idx, $crow->slug, "item");?>">
            <?php if($crow->thumb):?>
            <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/' . $crow->thumb;?>&amp;w=400&amp;h=260" alt="">
            <?php else:?>
            <img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt="">
            <?php endif;?>
            </a> </section>
          <aside class="category">
            <div class="wojo-content">
              <h4><a href="<?php echo dourl($crow->idx, $crow->slug, "item");?>"><?php echo $crow->year;?> <?php echo $crow->title;?></a></h4>
              <div class="wojo divider"></div>
              <p><?php echo cleanSanitize($crow->body,150);?></p>
              <div class="wojo divider"></div>
              <div class="wojo three cols horizontal divided list">
                <div class="item"> <i class="icon dashboard"></i> <?php echo $crow->milege . $core->odometer;?> </div>
                <div class="item"> <i class="icon calendar"></i> <?php echo Filter::doDate("short_date",$crow->created);?> </div>
                <div class="item"> <span<?php if(compareNumbers($crow->price_sale, $crow->price, '<')):?> class="strike"<?php endif;?>><?php echo $core->formatMoney($crow->price);?></span> </div>
              </div>
              <?php if(compareNumbers($crow->price_sale, $crow->price, '<')):?>
              <div class="wojo top left negative attached label"><?php echo $core->formatMoney($crow->price_sale);?></div>
              <?php endif;?>
            </div>
          </aside>
        </div>
        <?php endforeach;?>
        <div class="content-center"><?php echo $pager->display_pages();?></div>
        <?php endif;?>
      </div>
      <div class="screen-30 tablet-50 phone-100">
        <?php include(THEMEDIR . "/full_search.tpl.php");?>
      </div>
    </div>
  </div>
</div>
<!-- End Search /-->