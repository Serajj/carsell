<?php
  /**
   * Newsletter
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: newsletter.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php $row = get('emailid') ? Core::getRowById(Content::eTable, 3) : Core::getRowById(Content::eTable, 5);?>
<a id="add" href="controller.php?exportNewsletter" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->NLT_EXPORT;?>"><i class="icon add"></i> <?php echo Lang::$word->EXPORT;?></a>
<h1 class="main-header"><?php echo Lang::$word->NLT_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_NLETTER;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="mail reply icon"></i>
  <div class="content">
    <div class="header"> <?php echo get('emailid') ? Lang::$word->NLT_SUB1 : Lang::$word->NLT_SUB;?> </div>
    <p><?php echo Lang::$word->NLT_INFO;?></p>
  </div>
</div>
<div class="wojo form segment">
  <form id="wojo_form" name="wojo_form" method="post">
    <?php if (get('emailid')):?>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->NLT_REC;?></label>
      </div>
      <div class="field">
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="recipient" type="text"  value="<?php echo sanitize(get('emailid'));?>">
        </label>
      </div>
    </div>
    <div class="wojo fitted divider"></div>
    <?php else:?>
    <input name="recipient" type="hidden" value="all">
    <?php endif;?>
    <div class="field">
      <label><?php echo Lang::$word->NLT_SUBJECT;?></label>
      <label class="input"><i class="icon-append icon asterisk"></i>
        <input name="subject" type="text"  value="<?php echo $row->subject;?>">
      </label>
    </div>
    <div class="field">
      <label><?php echo Lang::$word->NLT_BODY;?></label>
      <textarea name="body" class="post"><?php echo $row->body;?></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->NLT_SEND;?></button>
    <input name="processNewsletter" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>