<?php
  /**
   * Category
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: category.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!-- Start Category-->
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="wojo breadcrumb">
      <div class="section"><?php echo Lang::$word->LST_CAT;?></div>
      <div class="divider"> / </div>
      <a href="<?php echo doUrl(false, $row->slug, "category");?>" class="active section"><?php echo $row->name;?></a></div>
    <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo SITEURL.'/assets/images/catico/'.$row->image;?>&amp;w=60&amp;h=40" alt="" class="push-right">
    <div class="wojo divider"></div>
    <div class="wojo fitted secondary segment">
      <div class="sorting-methodes">
        <div class="head hide-mobile hide-phone"><?php echo Lang::$word->SORT_BY;?></div>
        <div class="sortby">
          <ul class="option-set">
            <?php foreach($sort_by as $val) : ?>
            <li<?php if($val['is_selected']) echo ' class="active"';?>> <a href="<?php echo $val['href']; ?>" data-option-value="<?php echo $val['name']; ?>" <?php if($val['is_selected']) echo ' class="active"';?>><?php echo $val['name']; ?></a> </li>
            <?php endforeach;?>
            <?php unset($val);?>
          </ul>
        </div>
        <div class="sort-asc-desc hide-phone">
          <ul class="option-set">
            <li<?php if($orders[0]['is_selected']) echo ' class="active"';?>> <a href="<?php echo $orders[0]['href']; ?>" data-option-value="true"><?php echo $orders[0]['name']; ?><i class="down triangle icon"></i></a> </li>
            <li<?php if($orders[1]['is_selected']) echo ' class="active"';?>> <a href="<?php echo $orders[1]['href']; ?>" data-option-value="true"><?php echo $orders[1]['name']; ?><i class="up triangle icon"></i></a> </li>
          </ul>
        </div>
        <div class="layout-option">
          <ul>
            <li<?php if($types[0]['is_selected']) echo ' class="active"';?> data-content="<?php echo Lang::$word->GRID;?>"> <a href="<?php echo $types[0]['href']; ?>" data-option-value="<?php echo $types[0]['name']; ?><"><i class="grid layout icon"></i></a></li>
            <li<?php if($types[1]['is_selected']) echo ' class="active"';?> data-content="<?php echo Lang::$word->LIST;?>"> <a href="<?php echo $types[1]['href']; ?>" data-option-value="<?php echo $types[1]['name']; ?><"><i class="list layout icon"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="columns horizontal-gutters">
      <?php if(isset($_GET['type']) and $_GET['type'] == "grid"):?>
      <!-- Start Category Grid -->
      <div class="screen-70 tablet-50 phone-100">
        <div class="two columns small-gutters">
          <?php if(!$catrow):?>
          <?php echo Filter::msgSingleAlert(Lang::$word->NO_LIST);?>
          <?php else:?>
          <?php foreach($catrow as $crow):?>
          <div class="row">
            <div class="wojo fitted grid segment">
            <?php if($crow->featured):?><div class="wojo ribbon"><div class="ribbon success inverted"><?php echo Lang::$word->FEATURED;?></div></div><?php endif;?>
              <section> <a href="<?php echo dourl($crow->idx, $crow->slug, "item");?>">
                <?php if($crow->thumb):?>
                <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/' . $crow->thumb;?>&amp;w=400&amp;h=200" alt="">
                <?php else:?>
                <img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt="">
                <?php endif;?>
                </a> </section>
              <aside>
                <h4><a href="<?php echo dourl($crow->idx, $crow->slug, "item");?>"><?php echo $crow->year;?> <?php echo $crow->title;?></a></h4>
                <div class="wojo double fitted divider"></div>
                <?php echo cleanSanitize($crow->body,140);?>
                <div class="wojo section fitted double divider"></div>
                <div class="wojo bottom attached label">
                  <div class="wojo two cols horizontal divided list">
                    <div class="item"> <i class="icon calendar"></i> <?php echo Filter::doDate("short_date",$crow->created);?> </div>
                    <div class="item"> <span<?php if(compareNumbers($crow->price_sale, $crow->price, '<')):?> class="strike"<?php endif;?>><?php echo $core->formatMoney($crow->price);?></span> </div>
                  </div>
                </div>
                <?php if(compareNumbers($crow->price_sale, $crow->price, '<')):?>
                <div class="wojo top left negative attached label"><?php echo $core->formatMoney($crow->price_sale);?></div>
                <?php endif;?>
              </aside>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        <div class="content-center"><?php echo $pager->display_pages();?></div>
        <?php endif;?>
      </div>
      <?php else:?>
      <!-- End Category Grid/--> 
      <!-- Start Category List -->
      <div class="screen-70 tablet-50 phone-100">
        <?php if(!$catrow):?>
        <?php echo Filter::msgSingleAlert(Lang::$word->NO_LIST);?>
        <?php else:?>
        <?php foreach($catrow as $crow):?>
        <div class="wojo fitted segment">
        <?php if($crow->featured):?><div class="wojo ribbon"><div class="ribbon success inverted"><?php echo Lang::$word->FEATURED;?></div></div><?php endif;?>
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
      <!-- End Category List/-->
      <?php endif;?>
      <div class="screen-30 tablet-50 phone-100"> 
        <!-- Sidebar Widgets-->
        <?php include(THEMEDIR . "/home_search.tpl.php");?>
        <?php include(THEMEDIR . "/loan_calc.tpl.php");?>
      </div>
    </div>
  </div>
</div>
<!-- End Category/-->