<?php
  /**
   * Car Models
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: models.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $modelrow = $content->getModels();
   $makerow = $content->getMakes(false)
?>
<a onclick="$('.addmore').slideToggle();" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->MAKE_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->MAKE_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_MODELS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="book icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->MODL_SUB;?> </div>
    <p><?php echo Lang::$word->MODL_INFO;?></p>
  </div>
</div>
<div class="wojo small form segment">
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="three fields">
      <div class="field">
        <div class="wojo action input">
          <input type="text" name="find" placeholder="<?php echo Lang::$word->MODL_SEARCH;?>">
          <a id="doModelSearch" class="wojo icon button"><?php echo Lang::$word->GO;?></a> </div>
      </div>
      <div class="field"> <?php echo $core->getDropList($makerow, "makes", Filter::$id, Lang::$word->MODL_RESET);?> </div>
      <div class="field">
        <div class="two columns small-horizontal-gutters">
          <div class="row"><?php echo $pager->items_per_page();?></div>
          <div class="row"><?php echo $pager->jump_menu();?> </div>
        </div>
      </div>
    </div>
  </form>
  <div class="wojo divider"></div>
  <div class="addmore" style="display:none">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->MODL_NAME;?></label>
        <div id="container1" class="clonedInput small-bottom-space">
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input type="text" placeholder="Enter Model Name" size="55" name="makename[]">
          </label>
        </div>
      </div>
    </div>
    <a class="wojo small black button" id="dosubmit"><?php echo Lang::$word->ADDALL;?><span></span></a> <a id="btnAdd" class="wojo small positive button"><?php echo Lang::$word->ADD;?></a> <a id="btnDel" class="wojo small negative button"><?php echo Lang::$word->REMOVE;?></a>
    <div class="wojo divider"></div>
  </div>
  <table class="wojo sortable table">
    <thead>
      <tr>
        <th data-sort="int">ID</th>
        <th data-sort="string"><?php echo Lang::$word->MAKE_NAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->MODL_NAME;?></th>
        <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$modelrow):?>
      <tr>
        <td colspan="4"><?php echo Filter::msgSingleInfo(Lang::$word->MODL_NOMODEL);?></td>
      </tr>
      <?php else:?>
      <?php foreach($modelrow as $row):?>
      <tr>
        <td><?php echo $row->mdid;?></td>
        <td><?php echo $row->mkname;?></td>
        <td><span class="editable" contenteditable="true" data-id="<?php echo $row->mdid;?>" data-edit-type="model"><?php echo $row->mdname;?></span></td>
        <td><a class="delete" data-title="<?php echo Lang::$word->MODL_DEL;?>" data-option="deleteModel" data-id="<?php echo $row->mdid;?>" data-name="<?php echo $row->mkname;?>"><i class="rounded danger inverted trash icon link"></i></a></td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>
</div>
<div class="content-center"><?php echo $pager->display_pages();?></div>
