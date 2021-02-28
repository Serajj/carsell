<?php
  /**
   * Print Listing
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: print_listing.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
   
  define("_VALID_PHP", true);
  
  require_once("init.php");
  if (!$user->is_Admin())
	redirect_to("login.php");
	  
   $row = (Filter::$id) ? $content->getListingPreview() : Filter::error("You have selected an Invalid Id", "Content::getListingPreview()");
   $galdata = $content->getGallery();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listing &rsaquo;<?php echo $row->title;?></title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body { font-family: Arial, Helvetica, sans-serif; font-size: 13px; margin: 5px; background-color: #FFF; background-image: none; }
.display { border: 1px solid #C9C9C9 }
.display tr td { border-bottom: 1px solid #C9C9C9 }
.display img { box-shadow:none }
</style>
</head>
<body>
<div class="block-content">
  <table class="display">
    <tr>
      <td align="center" valign="top"><table width="100%">
          <tr>
            <td align="center" valign="middle"><?php if($row->thumb):?>
              <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/'.$row->thumb;?>&amp;w=500&amp;h=350" alt="" class="mainimg" style="margin:0"/>
              <?php else:?>
              <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL;?>/listings/nopic.jpg&amp;w=120&amp;h=60" alt="" class="mainimg" />
              <?php endif;?></td>
          </tr>
          <tr>
            <td><div id="maindata">
                <?php if($galdata):?>
                <?php foreach ($galdata as $grow):?>
                <div class="gallview-gal gallview"  style="display:inline-block">
                  <div class="inner2"> <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/pics' . Filter::$id . '/'.$grow->photo;?>&amp;w=150&amp;h=100" alt="" class="mainimg" style="margin:0;"/> </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
              </div></td>
          </tr>
        </table></td>
      <td width="100%" valign="top"><table width="100%">
          <thead>
            <tr>
              <td colspan="2"><strong><?php echo $row->year . ' ' .$row->title;?></strong></td>
            </tr>
          </thead>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_STOCK;?></td>
            <td><?php echo Core::has($row->stock_id);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_VIN;?></td>
            <td><?php echo Core::has($row->vin);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_COND;?></td>
            <td><?php echo $row->condition_name;?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_ODM;?></td>
            <td><?php echo Core::has($row->milege);?> <?php echo $core->odometer;?></td>
          </tr>
      <tr>
        <td class="wojo table"><?php echo Lang::$word->LST_PRICE;?></td>
        <td><?php echo ($row->price_sale) ? '<span class="sale">' . $core->formatMoney($row->price) . '</span>' : $core->formatMoney($row->price);?></td>
      </tr>
	  <?php if($row->price_sale):?>
      <tr>
        <td class="wojo table"><?php echo Lang::$word->LST_DPRICE_S;?></td>
        <td><?php echo Core::has($core->formatMoney($row->price_sale));?></td>
      </tr>
      <?php endif;?>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_ROOM;?></td>
            <td><?php echo $row->location_name;?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->EMAIL;?></td>
            <td><?php echo $row->email;?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->CONF_PHONE;?></td>
            <td><?php echo Core::has($row->phone);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_INTC;?></td>
            <td><?php echo Core::has($row->color_i);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_EXTC;?></td>
            <td><?php echo Core::has($row->color_e);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_DOORS;?></td>
            <td><?php echo Core::has($row->doors);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_ENGINE;?></td>
            <td><?php echo Core::has($row->engine);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_TRANS;?></td>
            <td><?php echo $row->trans_name;?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_FUEL;?>:</td>
            <td><?php echo $row->fuel_name;?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_TRAIN;?>:</td>
            <td><?php echo Core::has($row->drive_train);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_SPEED;?>:</td>
            <td><?php echo Core::has($row->top_speed);?> <?php echo ($core->odometer == "km") ? 'km/h' : 'mph';?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_POWER;?></td>
            <td><?php echo Core::has($row->horse_power);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_TORQUE;?></td>
            <td><?php echo Core::has($row->torque);?></td>
          </tr>
          <tr>
            <td class="wojo table"><?php echo Lang::$word->LST_TOWING;?></td>
            <td><?php echo Core::has($row->towing_capacity);?></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo cleanOut($row->body);?></td>
    </tr>
    <tr>
      <td colspan="2"><?php $featurerow = $content->getFeaturesById($row->features);?>
        <?php
	   		$result = '';
			foreach($featurerow as $frow) {
				if(strlen($result) > 0) {
					$result .= ", ";
				}
				$result .= "&bull; " . $frow->name;
			}
			echo $result;
			unset($frow)
		?></td>
    </tr>
  </table>
</div>
</body>
</html>