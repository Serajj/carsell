<?php
  /**
   * Menus
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: menus.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Content::muTable, Filter::$id);?>
<h1 class="main-header"><?php echo Lang::$word->MENU_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=menus" class="section"><?php echo Lang::$word->ADM_MENUS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->MENU_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="menu"><i class="icon help"></i></a> <i class="sitemap icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->MENU_EDIT;?> </div>
    <p><?php echo Lang::$word->MENU_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="columns small-gutters">
  <div class="screen-70 tablet-50 phone-100">
    <div class="wojo form segment">
      <div class="wojo header"><?php echo Lang::$word->MENU_SUB . $row->name;?></div>
      <div class="wojo double fitted divider"></div>
      <form id="wojo_form" name="wojo_form" method="post">
        <div class="field">
          <label><?php echo Lang::$word->MENU_NAME;?></label>
          <label class="input"> <i class="icon-append icon asterisk"></i>
            <input type="text" name="name" value="<?php echo $row->name;?>">
          </label>
        </div>
        <div class="two fields">
          <div class="field">
            <label><?php echo Lang::$word->MENU_TYPE;?></label>
            <select name="content_type" id="contenttype">
              <option value=""><?php echo Lang::$word->MENU_TYPE_SEL;?></option>
              <?php echo Content::getContentType($row->content_type);?>
            </select>
          </div>
          <div class="field" id="contentid" style="display:<?php echo ($row->content_type != "web") ? 'block' : 'none';?>">
            <label><?php echo Lang::$word->MENU_LINK;?></label>
            <select name="page_id" class="selectbox" id="_id">
              <?php $clist = $content->getContentPages($row->content_type);?>
              <?php if($clist):?>
              <?php foreach($clist as $crow):?>
              <?php $sel = ($crow->id == $row->page_id) ? " selected=\"selected\"" : "" ?>
              <option value="<?php echo $crow->id;?>"<?php echo $sel;?>><?php echo $crow->title;?></option>
              <?php endforeach;?>
              <?php unset($crow);?>
              <?php endif;?>
            </select>
          </div>
        </div>
        <div class="two fields" id="webid" style="display:<?php echo ($row->content_type == "web") ? 'block' : 'none';?>">
          <div class="field">
            <label><?php echo Lang::$word->MENU_LINK;?></label>
            <label class="input">
              <input type="text" name="web" value="<?php echo $row->link;?>" placeholder="<?php echo Lang::$word->MENU_LINK;?>">
            </label>
          </div>
          <div class="field">
            <label><?php echo Lang::$word->MENU_TARGETL;?></label>
            <select name="target" class="selectbox">
              <option value=""><?php echo Lang::$word->MENU_TARGET;?></option>
              <option value="_blank"<?php if ($row->target == "_blank") echo ' selected="selected"';?>><?php echo Lang::$word->MENU_TARGET_B;?></option>
              <option value="_self"<?php if ($row->target == "_self") echo ' selected="selected"';?>><?php echo Lang::$word->MENU_TARGET_S;?></option>
            </select>
          </div>
        </div>
        <div class="field">
          <div class="inline-group">
            <label><?php echo Lang::$word->MENU_PUB;?></label>
            <label class="radio">
              <input name="active" type="radio" value="1" <?php getChecked($row->active, 1); ?>>
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input name="active" type="radio"  value="0" <?php getChecked($row->active, 0); ?>>
              <i></i> <?php echo Lang::$word->NO;?> </label>
          </div>
        </div>
        <div class="wojo double fitted divider"></div>
        <button type="button" name="doMenu" class="wojo positive button"><?php echo Lang::$word->MENU_UPDATE;?></button>
        <input name="processMenu" type="hidden" value="1">
        <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
      </form>
    </div>
  </div>
  <div class="screen-30 tablet-50 phone-100">
    <h4 class="wojo header"><?php echo Lang::$word->MENU_LIST;?></h4>
    <div id="menusort" class="clearfix"> <?php echo $content->getSortMenuList();?></div>
    <div class="wojo double divider"></div>
    <div class="sholder"><a id="serialize" class="wojo basic left labeled icon button"><i class="icon ok sign"></i><?php echo Lang::$word->MENU_SAVE;?></a></div>
  </div>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<a class="wojo icon positive button push-right" data-content="Add New Listing" href="index.php?do=menus&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->MENU_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_MENUS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="menu"><i class="icon help"></i></a> <i class="sitemap icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->MENU_ADD;?> </div>
    <p><?php echo Lang::$word->MENU_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="columns small-gutters">
  <div class="screen-70 tablet-50 phone-100">
    <div class="wojo form segment">
      <div class="wojo header"><?php echo Lang::$word->MENU_SUB1;?></div>
      <div class="wojo double fitted divider"></div>
      <form id="wojo_form" name="wojo_form" method="post">
        <div class="field">
          <label><?php echo Lang::$word->MENU_NAME;?></label>
          <label class="input"> <i class="icon-append icon asterisk"></i>
            <input type="text" name="name" placeholder="<?php echo Lang::$word->MENU_NAME;?>">
          </label>
        </div>
        <div class="two fields">
          <div class="field">
            <label><?php echo Lang::$word->MENU_TYPE;?></label>
            <select name="content_type" class="selectbox" id="contenttype">
              <option value=""><?php echo Lang::$word->MENU_TYPE_SEL;?></option>
              <?php echo Content::getContentType();?>
            </select>
          </div>
          <div class="field" id="contentid">
            <label><?php echo Lang::$word->MENU_LINK;?></label>
            <select name="page_id" class="selectbox" id="page_id">
              <option value="0"><?php echo Lang::$word->MENU_NONE;?></option>
            </select>
          </div>
        </div>
        <div class="two fields" id="webid" style="display:none">
          <div class="field">
            <label><?php echo Lang::$word->MENU_LINK;?></label>
            <label class="input">
              <input type="text" name="web" placeholder="<?php echo Lang::$word->MENU_LINK;?>">
            </label>
          </div>
          <div class="field">
            <label><?php echo Lang::$word->MENU_TARGETL;?></label>
            <select name="target" class="selectbox">
              <option value=""><?php echo Lang::$word->MENU_TARGET;?></option>
              <option value="_blank"><?php echo Lang::$word->MENU_TARGET_B;?></option>
              <option value="_self"><?php echo Lang::$word->MENU_TARGET_S;?></option>
            </select>
          </div>
        </div>
        <div class="field">
          <div class="inline-group">
            <label><?php echo Lang::$word->MENU_PUB;?></label>
            <label class="radio">
              <input name="active" type="radio" value="1" checked="checked">
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input name="active" type="radio"  value="0">
              <i></i> <?php echo Lang::$word->NO;?> </label>
          </div>
        </div>
        <div class="wojo double fitted divider"></div>
        <button type="button" name="doMenu" class="wojo positive button"><?php echo Lang::$word->MENU_ADD;?></button>
        <input name="processMenu" type="hidden" value="1">
      </form>
    </div>
  </div>
  <div class="screen-30 tablet-50 phone-100">
    <h4 class="wojo header"><?php echo Lang::$word->MENU_LIST;?></h4>
    <div id="menusort" class="clearfix"> <?php echo $content->getSortMenuList();?></div>
    <div class="wojo double divider"></div>
    <div class="sholder"><a id="serialize" class="wojo basic left labeled icon button"><i class="icon ok sign"></i><?php echo Lang::$word->MENU_SAVE;?></a></div>
  </div>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php endswitch;?>