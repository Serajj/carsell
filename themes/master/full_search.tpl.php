<?php
  /**
   * Full Search
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: full_search.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo secondary segment">
  <h4 class="wojo shadow header"><?php echo Lang::$word->HOME_SEARCH;?></h4>
  <div class="wojo divider"></div>
  <div class="wojo small form">
    <form id="wojo_form" name="wojo_form" action="<?php echo SITEURL;?>/search/" method="get">
      <div class="field">
        <label><?php echo Lang::$word->LST_MAKE;?></label>
        <?php echo $core->getDropList($content->getMakeList(), "make_id", get('make_id'), Lang::$word->LST_MAKE_S);?> </div>
      <div class="field">
        <label><?php echo Lang::$word->LST_MODEL;?></label>
        <select name="model_id" id="droplist-model_id">
          <option value=""><?php echo Lang::$word->LST_MODEL_S;?></option>
        </select>
      </div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->LST_YEAR;?></label>
          <select name="year_from">
            <option value="<?php echo $core->minyear;?>"><?php echo Lang::$word->FROM;?></option>
            <?php echo $core->yearList($core->minyear, $core->maxyear, "DESC", get('year_from'));?>
          </select>
        </div>
        <div class="field">
          <label>&nbsp;</label>
          <select name="year_to">
            <option value="<?php echo $core->maxyear;?>"><?php echo Lang::$word->TO;?></option>
            <?php echo $core->yearList($core->minyear, $core->maxyear, "DESC", get('year_to'));?>
          </select>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PRICE_RANGE;?></label>
        <input type="text" class="range" name="price_range" value="<?php echo $core->getPriceRange();?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->KM_RANGE;?></label>
        <input type="text" class="range" name="km_range" value="<?php echo $core->minkm . ';' . $core->maxkm;?>">
      </div>
      <?php if($core->colour):?>
      <div class="wojo fitted divider"></div>
      <div class="field">
        <label><?php echo Lang::$word->SR_COLOUR;?></label>
        <?php $colour = explode(",", $core->colour);?>
        <?php foreach($colour as $i => $clrow):?>
        <label class="checkbox">
          <input name="color[<?php echo $i;?>]" type="checkbox" value="<?php echo $clrow;?>" <?php echo (get('color') and in_array($clrow, get('color'))) ? 'checked="checked"' : null; ?>>
          <i></i><?php echo $clrow;?> </label>
        <?php endforeach;?>
      </div>
      <?php endif;?>
      <?php if($cats):?>
      <div class="wojo fitted divider"></div>
      <div class="field">
        <label><?php echo Lang::$word->LST_CAT;?></label>
        <?php foreach($cats as $i => $crow):?>
        <label class="checkbox">
          <input name="category[<?php echo $crow->id;?>]" type="checkbox" value="<?php echo $crow->id;?>" <?php echo (get('category') and in_array($crow->id, get('category'))) ? 'checked="checked"' : null; ?>>
          <i></i><?php echo $crow->name;?> (<?php echo $crow->total;?>)</label>
        <?php endforeach;?>
      </div>
      <?php endif;?>
      <div class="top-space">
        <div class="wojo fitted divider"></div>
        <button type="submit" name="dosubmit" class="wojo small black button"><?php echo Lang::$word->SEARCH;?></button>
      </div>
    </form>
  </div>
</div>