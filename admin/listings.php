<?php
  /**
   * Listings
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: listings.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = (Filter::$id) ? $content->getListingById() : Filter::error("You have selected an Invalid Id", "Content::getListingById()");?>
<h1 class="main-header"><?php echo Lang::$word->LST_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=listings" class="section"><?php echo Lang::$word->ADM_LISTINGS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LST_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="listing"><i class="icon help"></i></a> <i class="tasks icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LST_EDIT;?> </div>
    <p><?php echo Lang::$word->LST_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->LST_SUB . $row->title;?></div>
  <div class="wojo buttons" id="tabs"> <a class="wojo button" data-tab="#general"><i class="icon bookmark"></i><?php echo Lang::$word->LST_MGEN;?></a> <a class="wojo button" data-tab="#feat"><i class="icon grid layout"></i><?php echo Lang::$word->LST_MFET;?></a> <a class="wojo button" data-tab="#desc"><i class="icon file"></i><?php echo Lang::$word->LST_MDSC;?></a> </div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div id="general" class="tab_content">
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ROOM;?></label>
          <?php echo $core->getDropList($content->getLocations(), "location", $row->location, Lang::$word->LST_ROOM_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_YEAR;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input type="text" value="<?php echo $row->year;?>" name="year">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_STOCK;?></label>
          <input type="text" value="<?php echo $row->stock_id;?>" name="stock_id">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_VIN;?></label>
          <input type="text" value="<?php echo $row->vin;?>" name="vin">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_MAKE;?></label>
          <?php echo $core->getDropList($content->getMakes(false), "make_id", $row->make_id, Lang::$word->LST_MAKE_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_MODEL;?></label>
          <?php echo $core->getDropList($content->getModelList($row->make_id), "model_id", $row->model_id, Lang::$word->LST_MODEL_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_CAT;?></label>
          <?php echo $core->getDropList($content->getCategories(), "category", $row->category, Lang::$word->LST_CAT_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_COND;?></label>
          <?php echo $core->getDropList($content->getConditions(), "condition", $row->condition, Lang::$word->LST_COND_S);?> </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ODM;?></label>
          <div class="wojo action input">
            <input type="text" value="<?php echo $row->milege;?>" name="milege">
            <span class="wojo icon button"><?php echo $core->odometer;?></span> </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TORQUE;?></label>
          <input type="text" value="<?php echo $row->torque;?>" name="torque">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_INTC;?></label>
          <input type="text" value="<?php echo $row->color_i;?>" name="color_i">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_EXTC;?></label>
          <input type="text" value="<?php echo $row->color_e;?>" name="color_e">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ENGINE;?></label>
          <input type="text" value="<?php echo $row->engine;?>" name="engine">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TRAIN;?></label>
          <input type="text" value="<?php echo $row->drive_train;?>" name="drive_train">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_DOORS;?></label>
          <input type="text" value="<?php echo $row->doors;?>" name="doors">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TRANS;?></label>
          <?php echo $core->getDropList($content->getTransmissions(), "transmission", $row->transmission, Lang::$word->LST_TRANS_S);?> </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_SPEED;?></label>
          <div class="wojo action input">
            <input type="text" value="<?php echo $row->top_speed;?>" name="top_speed">
            <span class="wojo icon button"><?php echo ($core->odometer == "km") ? 'km/h' : 'mph';?></span> </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_FUEL;?></label>
          <?php echo $core->getDropList($content->getFueltypes(), "fuel", $row->fuel, Lang::$word->LST_FUEL_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_POWER;?></label>
          <input type="text" value="<?php echo $row->horse_power;?>" name="horse_power">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TOWING;?></label>
          <input type="text"  value="<?php echo $row->towing_capacity;?>" name="towing_capacity">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_PRICE;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i> <i class="icon-prepend icon dollar"></i>
            <input type="text" value="<?php echo $row->price;?>" name="price">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_DPRICE_S;?></label>
          <label class="input"><i class="icon-prepend icon dollar"></i>
            <input type="text" value="<?php echo $row->price_sale;?>" name="price_sale">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_FEATURED;?></label>
          <label class="checkbox">
            <input type="checkbox" value="1" name="featured" <?php getChecked($row->featured, 1); ?>>
            <i></i><?php echo Lang::$word->FEATURED;?></label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_ACTIVE;?></label>
          <label class="checkbox">
            <input type="checkbox" value="1" name="status" <?php getChecked($row->status, 1); ?>>
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_IMAGE;?></label>
          <label class="input">
            <input type="file" name="thumb" class="filefield">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_IMAGE_P;?></label>
          <div class="wojo avatar image">
            <?php if($row->thumb):?>
            <a href="<?php echo UPLOADURL.'/listings/'.$row->thumb;?>" title="<?php echo $row->title;?>" class="lightbox"><img src="<?php echo UPLOADURL.'/listings/'.$row->thumb;?>" alt="" /></a>
            <?php else:?>
            <a href="<?php echo UPLOADURL.'/listings/nopic.jpg';?>" title="<?php echo $row->title;?>"><img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt=""/></a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
    <div id="feat" class="tab_content">
      <?php $featurerow = $content->getFeatures();?>
      <div class="field">
        <label><?php echo Lang::$word->LST_FEATURES;?></label>
        <div class="inline-group">
          <label class="checkbox">
            <input type="checkbox" id="checkall">
            <i></i><?php echo Lang::$word->LST_SEL_ALL;?></label>
        </div>
      </div>
      <div class="four columns small-gutters" id="features">
        <?php foreach ($featurerow as $frow):?>
        <?php $key = explode(",", $row->features);?>
        <?php $checked = (in_array($frow->id, $key) ? ' checked="checked"' : '');?>
        <div class="row">
          <label class="checkbox">
            <input name="features[<?php echo $frow->id;?>]" type="checkbox" value="<?php echo $frow->id;?>" <?php echo $checked;?>/>
            <i></i><?php echo $frow->name;?> </label>
        </div>
        <?php endforeach;?>
        <?php unset($frow);?>
      </div>
    </div>
    <div id="desc" class="tab_content">
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_LTITLE;?></label>
          <input type="text" value="<?php echo $row->title;?>" name="title">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_SLUG;?></label>
          <input type="text" value="<?php echo $row->slug;?>" name="slug">
        </div>
      </div>
      <div class="wojo fitted divider"></div>
      <div class="field">
        <label><?php echo Lang::$word->LST_DESC;?></label>
        <textarea name="body" class="post"><?php echo $row->body;?></textarea>
      </div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_METAKEY;?></label>
          <textarea name="metakey"><?php echo $row->metakey;?></textarea>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_METADESC;?></label>
          <textarea name="metadesc"><?php echo $row->metadesc;?></textarea>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LST_NOTES;?></label>
        <textarea name="notes"><?php echo $row->notes;?></textarea>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->LST_UPDATE;?></button>
    <a href="index.php?do=listings" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processListing" type="hidden" value="1" />
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>
<h1 class="main-header"><?php echo Lang::$word->LST_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=listings" class="section"><?php echo Lang::$word->ADM_LISTINGS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LST_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="listing"><i class="icon help"></i></a> <i class="tasks icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LST_ADD;?> </div>
    <p><?php echo Lang::$word->LST_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->LST_SUB1;?></div>
  <div class="wojo buttons" id="tabs"> <a class="wojo button" data-tab="#general"><i class="icon bookmark"></i><?php echo Lang::$word->LST_MGEN;?></a> <a class="wojo button" data-tab="#feat"><i class="icon grid layout"></i><?php echo Lang::$word->LST_MFET;?></a> <a class="wojo button" data-tab="#desc"><i class="icon file"></i><?php echo Lang::$word->LST_MDSC;?></a> </div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div id="general" class="tab_content">
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ROOM;?></label>
          <?php echo $core->getDropList($content->getLocations(), "location", "", Lang::$word->LST_ROOM_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_YEAR;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input type="text" placeholder="<?php echo Lang::$word->LST_YEAR;?>" name="year">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_STOCK;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_STOCK;?>" name="stock_id">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_VIN;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_VIN;?>" name="vin">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_MAKE;?></label>
          <?php echo $core->getDropList($content->getMakes(false), "make_id", "", Lang::$word->LST_MAKE_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_MODEL;?></label>
          <select name="model_id" id="droplist-model_id">
            <option value=""><?php echo Lang::$word->LST_MODEL_S;?></option>
          </select>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_CAT;?></label>
          <?php echo $core->getDropList($content->getCategories(), "category", "", Lang::$word->LST_CAT_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_COND;?></label>
          <?php echo $core->getDropList($content->getConditions(), "condition", "", Lang::$word->LST_COND_S);?> </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ODM;?></label>
          <div class="wojo action input">
            <input type="text" placeholder="<?php echo Lang::$word->LST_ODM;?>" name="milege">
            <span class="wojo icon button"><?php echo $core->odometer;?></span> </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TORQUE;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_TORQUE;?>" name="torque">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_INTC;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_INTC;?>" name="color_i">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_EXTC;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_EXTC;?>" name="color_e">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_ENGINE;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_ENGINE;?>" name="engine">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TRAIN;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_TRAIN;?>" name="drive_train">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_DOORS;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_DOORS;?>" name="doors">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TRANS;?></label>
          <?php echo $core->getDropList($content->getTransmissions(), "transmission", "", Lang::$word->LST_TRANS_S);?> </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_SPEED;?></label>
          <div class="wojo action input">
            <input type="text" placeholder="<?php echo Lang::$word->LST_SPEED;?>" name="top_speed">
            <span class="wojo icon button"><?php echo ($core->odometer == "km") ? 'km/h' : 'mph';?></span> </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_FUEL;?></label>
          <?php echo $core->getDropList($content->getFueltypes(), "fuel", "", Lang::$word->LST_FUEL_S);?> </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_POWER;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_POWER;?>" name="horse_power">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_TOWING;?></label>
          <input type="text"  placeholder="<?php echo Lang::$word->LST_TOWING;?>" name="towing_capacity">
        </div>
      </div>
      <div class="four fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_PRICE;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i> <i class="icon-prepend icon dollar"></i>
            <input type="text" placeholder="<?php echo Lang::$word->LST_PRICE;?>" name="price">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_DPRICE_S;?></label>
          <label class="input"><i class="icon-prepend icon dollar"></i>
            <input type="text" placeholder="<?php echo Lang::$word->LST_DPRICE_S;?>" name="price_sale">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_FEATURED;?></label>
          <label class="checkbox">
            <input type="checkbox" value="1" name="featured">
            <i></i><?php echo Lang::$word->FEATURED;?></label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_ACTIVE;?></label>
          <label class="checkbox">
            <input type="checkbox" value="1" name="status">
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_IMAGE;?></label>
          <label class="input">
            <input type="file" name="thumb" class="filefield">
          </label>
        </div>
        <div class="field"></div>
      </div>
    </div>
    <div id="feat" class="tab_content">
      <?php $featurerow = $content->getFeatures();?>
      <div class="field">
        <label><?php echo Lang::$word->LST_FEATURES;?></label>
        <div class="inline-group">
          <label class="checkbox">
            <input type="checkbox" id="checkall">
            <i></i><?php echo Lang::$word->LST_SEL_ALL;?></label>
        </div>
      </div>
      <div class="four columns small-gutters" id="features">
        <?php foreach ($featurerow as $frow):?>
        <div class="row">
          <label class="checkbox">
            <input name="features[<?php echo $frow->id;?>]" type="checkbox" value="<?php echo $frow->id;?>" />
            <i></i><?php echo $frow->name;?> </label>
        </div>
        <?php endforeach;?>
        <?php unset($frow);?>
      </div>
    </div>
    <div id="desc" class="tab_content">
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_LTITLE;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_LTITLE;?>" name="title">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_SLUG;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->LST_SLUG;?>" name="slug">
        </div>
      </div>
      <div class="wojo fitted divider"></div>
      <div class="field">
        <label><?php echo Lang::$word->LST_DESC;?></label>
        <textarea name="body" class="post"></textarea>
      </div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_METAKEY;?></label>
          <textarea name="metakey" placeholder="<?php echo Lang::$word->LST_METAKEY;?>"></textarea>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->LST_METADESC;?></label>
          <textarea name="metadesc" placeholder="<?php echo Lang::$word->LST_METADESC;?>"></textarea>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LST_NOTES;?></label>
        <textarea name="notes" placeholder="<?php echo Lang::$word->LST_NOTES;?>"></textarea>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->LST_ADD;?></button>
    <a href="index.php?do=listings" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processListing" type="hidden" value="1" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $listrow = $content->getListings();?>
<a class="wojo icon positive button push-right" data-content="Add New Listing" href="index.php?do=listings&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->LST_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_LISTINGS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="tasks icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LST_SUB2;?> </div>
    <p><?php echo Lang::$word->LST_INFO2;?></p>
  </div>
</div>
<div class="wojo small form segment">
  <form method="post" id="wojo_form" name="wojo_form">
    <div class="four fields">
      <div class="field">
        <div class="wojo input"> <i class="icon-prepend icon calendar"></i>
          <input name="fromdate" type="text" data-datepicker="true" placeholder="<?php echo Lang::$word->FROM;?>" id="fromdate" />
        </div>
      </div>
      <div class="field">
        <div class="wojo action input"> <i class="icon-prepend icon calendar"></i>
          <input name="enddate" type="text" data-datepicker="true" placeholder="<?php echo Lang::$word->TO;?>" id="enddate" />
          <a id="doDates" class="wojo icon button"><?php echo Lang::$word->GO;?></a> </div>
      </div>
      <div class="field">
        <div class="wojo icon input">
          <input type="text" name="searchfield" placeholder="<?php echo Lang::$word->SEARCH;?>"  id="searchfield"  />
          <i class="search icon"></i>
          <div id="suggestions"> </div>
        </div>
      </div>
      <div class="field">
        <div class="two columns small-horizontal-gutters">
          <div class="row"> <?php echo $pager->items_per_page();?> </div>
          <div class="row"> <?php echo $pager->jump_menu();?> </div>
        </div>
      </div>
    </div>
    <div class="wojo divider"></div>
    <div id="abc"> <?php echo getQs('index.php?do=listings', "letter");?> </div>
    <div class="wojo fitted divider"></div>
    <table class="wojo sortable table">
      <thead>
        <tr>
          <th class="disabled"> <label class="checkbox">
              <input type="checkbox" name="masterCheckbox" id="masterCheckbox">
              <i></i></label>
          </th>
          <th class="disabled"><?php echo Lang::$word->PHOTO;?></th>
          <th data-sort="string"><?php echo Lang::$word->DESC;?></th>
          <th data-sort="int"><?php echo Lang::$word->VISITS;?></th>
          <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
          <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!$listrow):?>
        <tr>
          <td colspan="6"><?php Filter::msgSingleAlert(Lang::$word->LST_NOLIST);?></td>
        </tr>
        <?php else:?>
        <?php foreach($listrow as $row):?>
        <tr>
          <td class="hide-tablet"><label class="checkbox">
              <input name="listid[<?php echo $row->id;?>]" type="checkbox" value="<?php echo $row->id;?>">
              <i></i></label></td>
          <td><div class="wojo rounded image reveal zoom">
              <?php if($row->thumb):?>
              <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/'.$row->thumb;?>&amp;w=140&amp;h=100" alt="" />
              <?php else:?>
              <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL;?>/listings/nopic.jpg&amp;w=140&amp;h=100" alt=""/>
              <?php endif;?>
              <div class="mask">
                <div class="content"><a href="index.php?do=listings&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="circular success inverted pencil icon link"></i></a></div>
              </div>
            </div></td>
          <td><strong><?php echo $row->title;?></strong> (<?php echo $row->year;?>) <br />
            <small><?php echo $row->name;?></small><br />
            #: <strong><?php echo $row->stock_id;?></strong> <br />
            <?php echo Lang::$word->LST_PRICE;?>: (<?php echo $core->formatMoney($row->price);?>)<br />
            <?php echo Lang::$word->MODIFIED;?>: <strong><?php echo ($row->modified <> 0) ? Filter::dodate("short_date", $row->modified): '- never -'?></strong></td>
          <td><?php echo $row->hits;?></td>
          <td data-sort-value="<?php echo strtotime($row->modified);?>"><?php echo Filter::dodate("short_date", $row->created);?></td>
          <td><a href="index.php?do=preview&amp;id=<?php echo $row->id;?>"><i class="rounded inverted info icon laptop link"></i></a> <a href="index.php?do=gallery&amp;id=<?php echo $row->id;?>"><i class="rounded inverted purple icon photo link"></i></a> <a href="index.php?do=listings&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="rounded inverted success icon pencil link"></i></a> <a class="delete" data-title="<?php echo Lang::$word->LST_DELETE;?>" data-option="deleteListing" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="rounded danger inverted trash icon link"></i></a></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <?php if($listrow):?>
    <div class="wojo fitted divider"></div>
    <button name="mdelete" type="button" class="wojo danger button hide-tablet"><i class="icon delete"></i><?php echo Lang::$word->LST_DELETES;?></button>
    <input name="delete" type="hidden" value="deleteMultiListings">
    <?php endif;?>
  </form>
</div>
<div class="content-center"><?php echo $pager->display_pages();?></div>
<div id="msgholder"></div>
<?php break;?>
<?php endswitch;?>