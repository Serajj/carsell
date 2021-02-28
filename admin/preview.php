<?php
  /**
   * Preview
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: preview.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $row = (Filter::$id) ? $content->getListingPreview() : Filter::error("You have selected an Invalid Id", "Content::getListingPreview()");
   $galdata = $content->getGallery();
?>
<a class="wojo icon positive button push-right lc" data-content="Print Summary" onclick="javascript:void window.open('print_listing.php?id=<?php echo Filter::$id;?>','printer','width=880,height=600,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;"><i class="icon print"></i> <?php echo Lang::$word->PRINT;?></a>
<h1 class="main-header"><?php echo Lang::$word->LPR_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=listings" class="section"><?php echo Lang::$word->ADM_LISTINGS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LPR_SUMMARY;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="print icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LPR_SUB . $row->title;?> </div>
    <p><?php echo Lang::$word->LPR_INFO;?></p>
  </div>
</div>
<div class="columns small-gutters">
  <div class="screen-50 tablet-100 phone-100">
    <?php if($row->thumb):?>
    <img src="<?php echo UPLOADURL.'/listings/'.$row->thumb;?>" alt="" class="wojo image">
    <?php else:?>
    <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL;?>/listings/nopic.jpg&amp;w=120&amp;h=60" alt="" class="wojo image">
    <?php endif;?>
    <?php if($galdata):?>
    <div class="wojo divider"></div>
    <div class="three columns small-gutters">
      <?php foreach ($galdata as $grow):?>
      <div class="row"><img class="wojo image" src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/pics' . Filter::$id . '/'.$grow->photo;?>&amp;w=200&amp;h=140" alt=""></div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </div>
  <div class="screen-50 tablet-100 phone-100">
    <table class="wojo table">
      <thead>
        <tr>
          <td colspan="2"><strong><?php echo $row->year . ' ' .$row->name;?></strong></td>
        </tr>
      </thead>
      <tr>
        <td><?php echo Lang::$word->LST_STOCK;?></td>
        <td><?php echo Core::has($row->stock_id);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_VIN;?></td>
        <td><?php echo Core::has($row->vin);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_COND;?></td>
        <td><?php echo $row->condition_name;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_ODM;?></td>
        <td><?php echo Core::has($row->milege);?> <?php echo $core->odometer;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_PRICE;?></td>
        <td><?php echo ($row->price_sale) ? '<span class="sale">' . $core->formatMoney($row->price) . '</span>' : $core->formatMoney($row->price);?></td>
      </tr>
	  <?php if($row->price_sale):?>
      <tr>
        <td><?php echo Lang::$word->LST_DPRICE_S;?></td>
        <td><?php echo Core::has($core->formatMoney($row->price_sale));?></td>
      </tr>
      <?php endif;?>
      <tr>
        <td><?php echo Lang::$word->LST_ROOM;?></td>
        <td><?php echo $row->location_name;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->EMAIL;?></td>
        <td><?php echo $row->email;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->CONF_PHONE;?></td>
        <td><?php echo Core::has($row->phone);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_INTC;?></td>
        <td><?php echo Core::has($row->color_i);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_EXTC;?></td>
        <td><?php echo Core::has($row->color_e);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_DOORS;?></td>
        <td><?php echo Core::has($row->doors);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_ENGINE;?></td>
        <td><?php echo Core::has($row->engine);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_TRANS;?></td>
        <td><?php echo $row->trans_name;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_FUEL;?>:</td>
        <td><?php echo $row->fuel_name;?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_TRAIN;?>:</td>
        <td><?php echo Core::has($row->drive_train);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_SPEED;?>:</td>
        <td><?php echo Core::has($row->top_speed);?> <?php echo ($core->odometer == "km") ? 'km/h' : 'mph';?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_POWER;?></td>
        <td><?php echo Core::has($row->horse_power);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_TORQUE;?></td>
        <td><?php echo Core::has($row->torque);?></td>
      </tr>
      <tr>
        <td><?php echo Lang::$word->LST_TOWING;?></td>
        <td><?php echo Core::has($row->towing_capacity);?></td>
      <tr>
        <td colspan="2" class="active"><?php echo cleanOut($row->body);?></td>
      </tr>
      <tr>
        <td colspan="2">
		<?php $featurerow = $content->getFeaturesById($row->features);?>
          <?php if($featurerow):?>
          <div class="two columns small-gutters">
            <?php foreach ($featurerow as $frow):?>
            <div class="row"> <?php echo $frow->name;?> </div>
            <?php endforeach;?>
            <?php unset($frow);?>
          </div>
          <?php endif;?></td>
      </tr>
    </table>
  </div>
</div>
<a href="index.php?do=listings" class="wojo icon basic button"><i class="icon left triangle"></i> <?php echo Lang::$word->BACKTO;?></a>