<?php
  /**
   * Email Templates
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: etemplates.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Content::eTable, Filter::$id);?>
<h1 class="main-header"><?php echo Lang::$word->ETPL_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=etemplates" class="section"><?php echo Lang::$word->ADM_FAQ;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ETPL_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="help icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->ETPL_EDIT;?> </div>
    <p><?php echo Lang::$word->ETPL_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->ETPL_SUB . $row->name;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
  <div class="two fields">
    <div class="field">
      <label><?php echo Lang::$word->ETPL_NAME;?></label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" value="<?php echo $row->name;?>" name="name">
      </label>
    </div>
    <div class="field">
      <label><?php echo Lang::$word->ETPL_SUBJECT;?></label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" value="<?php echo $row->subject;?>" name="subject">
      </label>
    </div>
    </div>
    <div class="field">
      <label><?php echo Lang::$word->ETPL_INFO;?></label>
      <textarea name="help"><?php echo $row->help;?></textarea>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label><?php echo Lang::$word->ETPL_BODY;?></label>
      <textarea name="body" class="post"><?php echo $row->body;?></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->ETPL_UPDATE;?></button>
    <a href="index.php?do=etemplates" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
    <input name="processTemplate" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $tplrow = $content->getEtemplates();?>
<h1 class="main-header"><?php echo Lang::$word->ETPL_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_ETPL;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="mail icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->ETPL_SUB1;?> </div>
    <p><?php echo Lang::$word->ETPL_INFO1;?></p>
  </div>
</div>
<div class="wojo segment">
  <table class="wojo sortable table">
    <thead>
      <tr>
        <th data-sort="int">ID</th>
        <th data-sort="string"><?php echo Lang::$word->ETPL_NAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->ETPL_SUBJECT;?></th>
        <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$tplrow):?>
      <tr>
        <td colspan="4"><?php Filter::msgSingleAlert(Lang::$word->ETPL_NOTPL);?></td>
      </tr>
      <?php else:?>
      <?php foreach($tplrow as $row):?>
      <tr>
        <td><?php echo $row->id;?>.</td>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->subject;?></td>
        <td><a href="index.php?do=etemplates&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="rounded inverted success icon pencil link"></i></a></td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>
</div>
<?php break;?>
<?php endswitch;?>