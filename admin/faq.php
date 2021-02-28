<?php
  /**
   * F.A.Q.
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: faq.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Content::faqTable, Filter::$id);?>
<h1 class="main-header"><?php echo Lang::$word->FAQ_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=faq" class="section"><?php echo Lang::$word->ADM_FAQ;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->FAQ_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="help icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->FAQ_EDIT;?> </div>
    <p><?php echo Lang::$word->FAQ_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->FAQ_SUB . $row->question;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="field">
      <label><?php echo Lang::$word->FAQ_NAME;?></label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" value="<?php echo $row->question;?>" name="question">
      </label>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label><?php echo Lang::$word->FAQ_BODY;?></label>
      <textarea name="answer" class="post"><?php echo $row->answer;?></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->FAQ_UPDATE;?></button>
    <a href="index.php?do=faq" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
    <input name="processFaq" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>
<h1 class="main-header"><?php echo Lang::$word->FAQ_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=faq" class="section"><?php echo Lang::$word->ADM_FAQ;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->FAQ_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="help icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->FAQ_ADD;?> </div>
    <p><?php echo Lang::$word->FAQ_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->FAQ_SUB1;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="field">
      <label><?php echo Lang::$word->FAQ_NAME;?></label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input type="text" placeholder="<?php echo Lang::$word->FAQ_NAME;?>" name="question">
      </label>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label><?php echo Lang::$word->FAQ_BODY;?></label>
      <textarea name="answer" placeholder="<?php echo Lang::$word->FAQ_BODY;?>" class="post"></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->FAQ_ADD;?></button>
    <a href="index.php?do=faq" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processFaq" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $faqrow = $content->getFaq();?>
<a class="wojo icon positive button push-right" data-content="<?php echo Lang::$word->FAQ_ADD;?>" href="index.php?do=faq&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->FAQ_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_FAQ;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="help icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->FAQ_SUB2;?> </div>
    <p><?php echo Lang::$word->FAQ_INFO2;?></p>
  </div>
</div>
<div class="wojo segment">
  <table class="wojo sortable table">
    <thead>
      <tr>
        <th data-sort="int">ID</th>
        <th data-sort="string"><?php echo Lang::$word->FAQ_NAME;?></th>
        <th data-sort="int"><?php echo Lang::$word->FAQ_POS;?></th>
        <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$faqrow):?>
      <tr>
        <td colspan="4"><?php Filter::msgSingleAlert(Lang::$word->FAQ_NOFAQ);?></td>
      </tr>
      <?php else:?>
      <?php foreach($faqrow as $row):?>
      <tr id="node-<?php echo $row->id;?>">
        <td class="handle"><?php echo $row->id;?>.</td>
        <td><?php echo $row->question;?></td>
        <td><?php echo $row->position;?></td>
        <td><a href="index.php?do=faq&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="rounded inverted success icon pencil link"></i></a> <a class="delete" data-title="<?php echo Lang::$word->FAQ_DELFAQ;?>" data-option="deleteFaq" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->question;?>"><i class="rounded danger inverted trash icon link"></i></a></td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>
</div>
<?php if($faqrow):?>
<a id="serialize" class="wojo small positive button"><?php echo Lang::$word->FAQ_SAVE;?></a>
<?php endif;?>
<script type="text/javascript"> 
// <![CDATA[
var tableHelper = function (e, tr) {
    tr.children().each(function () {
        $(this).width($(this).width());
    });
    return tr;
};
$(document).ready(function () {
    $(".wojo.table tbody").sortable({
        helper: tableHelper,
        handle: '.handle',
        opacity: .6
    }).disableSelection();

    $('#serialize').click(function () {
        serialized = $(".wojo.table tbody").sortable('serialize');
		serialized +='&sortfaqs=1';
        $.ajax({
            type: "post",
			dataType: 'json',
            url: "controller.php",
            data: serialized,
            success: function (json) {
				$.sticky(decodeURIComponent(json.message), {
					type: json.type,
					title: json.title
				});
            }
        });
    })
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>