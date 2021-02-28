<?php
  /**
   * Pages
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: pages.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Content::pTable, Filter::$id);?>
<h1 class="main-header"><?php echo Lang::$word->PAG_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=pages" class="section"><?php echo Lang::$word->ADM_PAGES;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->PAG_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="page"><i class="icon help"></i></a> <i class="copy icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->PAG_EDIT;?> </div>
    <p><?php echo Lang::$word->PAG_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->PAG_SUB . $row->title;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->title;?>" name="title">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_SLUG;?></label>
        <label class="input">
          <input type="text" value="<?php echo $row->slug;?>" name="slug">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_DATE;?></label>
        <label class="input"><i class="icon-append icon calendar"></i>
          <input name="created" data-datepicker="true" type="text" value="<?php echo $row->created;?>"/>
        </label>
      </div>
    </div>
    <div class="four fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_HOME;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="home_page" type="radio" value="1" <?php echo getChecked($row->home_page, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="home_page" type="radio" <?php echo getChecked($row->home_page, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_FAQPAGE;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="faq" type="radio" value="1" <?php echo getChecked($row->faq, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="faq" type="radio" <?php echo getChecked($row->faq, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_CNPAGE;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="contact" type="radio" value="1" <?php echo getChecked($row->contact, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="contact" type="radio" <?php echo getChecked($row->contact, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="1" <?php echo getChecked($row->active, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="active" type="radio" <?php echo getChecked($row->active, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label><?php echo Lang::$word->PAG_BODY;?></label>
      <textarea name="body" class="post"><?php echo $row->body;?></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->PAG_UPDATE;?></button>
    <a href="index.php?do=pages" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
    <input name="processPage" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>
<h1 class="main-header"><?php echo Lang::$word->PAG_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=pages" class="section"><?php echo Lang::$word->ADM_PAGES;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->PAG_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="page"><i class="icon help"></i></a> <i class="copy icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->PAG_ADD;?> </div>
    <p><?php echo Lang::$word->PAG_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->PAG_SUB1;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->PAG_NAME;?>" name="title">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_SLUG;?></label>
        <label class="input">
          <input type="text" placeholder="<?php echo Lang::$word->PAG_SLUG;?>" name="slug">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_DATE;?></label>
        <label class="input"><i class="icon-append icon calendar"></i>
          <input name="created" data-datepicker="true" type="text" value="<?php echo date('Y-m-d');?>">
        </label>
      </div>
    </div>
    <div class="four fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_HOME;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="home_page" type="radio" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="home_page" type="radio" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_FAQPAGE;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="faq" type="radio" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="faq" type="radio" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_CNPAGE;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="contact" type="radio" value="1">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="contact" type="radio" checked="checked">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="1" checked="checked">
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="active" type="radio">
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="field">
      <label><?php echo Lang::$word->PAG_BODY;?></label>
      <textarea name="body" placeholder="<?php echo Lang::$word->PAG_BODY;?>" class="post"></textarea>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->PAG_ADD;?></button>
    <a href="index.php?do=pages" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processPage" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $pagerow = $content->getContentPages();?>
<a class="wojo icon positive button push-right" data-content="<?php echo Lang::$word->PAG_ADD;?>" href="index.php?do=pages&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->PAG_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_PAGES;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="copy icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->PAG_SUB2;?> </div>
    <p><?php echo Lang::$word->PAG_INFO2;?></p>
  </div>
</div>
<div class="wojo segment">
  <table class="wojo sortable table">
    <thead>
      <tr>
        <th data-sort="int">ID</th>
        <th data-sort="string"><?php echo Lang::$word->PAG_NAME;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
        <th class="disabled"><?php echo Lang::$word->PAG_TYPE;?></th>
        <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$pagerow):?>
      <tr>
        <td colspan="5"><?php Filter::msgSingleAlert(Lang::$word->PAG_NOPAGE);?></td>
      </tr>
      <?php else:?>
      <?php foreach($pagerow as $row):?>
      <tr>
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->title;?></td>
        <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Filter::doDate("short_date", $row->created);?></td>
        <td>
		 <?php if($row->contact):?>
          <i class="rounded inverted warning icon mail"></i>
          <?php elseif($row->faq):?>
          <i class="rounded inverted info icon comment"></i>
          <?php elseif($row->home_page):?>
          <i class="rounded inverted success icon home"></i>
          <?php else:?>
          <i class="rounded inverted black icon file"></i>
          <?php endif;?></td>
        <td><a href="index.php?do=pages&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="rounded inverted success icon pencil link"></i></a> <a class="delete" data-title="<?php echo Lang::$word->PAG_DELPAGE;?>" data-option="deletePage" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="rounded danger inverted trash icon link"></i></a></td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>
</div>
<?php break;?>
<?php endswitch;?>