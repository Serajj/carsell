<?php
  /**
   * Gallery
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: gallery.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $title = (Filter::$id) ? $content->getTitle() : Filter::error("You have selected an Invalid Id", "Content::getTitle()");
   $galdata = (Filter::$id) ? $content->getGallery() : Filter::error("You have selected an Invalid Id", "Content::getGallery()");
?>
<a class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->GAL_UPLOAD;?>" onclick="$('#extra').slideToggle();"><i class="icon upload disk"></i> <?php echo Lang::$word->UPLOAD;?></a>
<h1 class="main-header"><?php echo Lang::$word->LST_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=listings" class="section"><?php echo Lang::$word->ADM_LISTINGS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->GAL_TITLE;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="photo icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->GAL_SUB . $title;?> </div>
    <p><?php echo Lang::$word->GAL_INFO;?></p>
  </div>
</div>
<div id="extra" style="display:none">
  <div id="uploader">
    <form id="upload" method="post" action="controller.php" enctype="multipart/form-data">
      <div id="drop" class="fade well"> <?php echo Lang::$word->FM_DROP;?> <a id="upl"><?php echo Lang::$word->BROWSE;?></a>
        <input type="file" name="mainfile" multiple />
        <input name="gupload" type="hidden" value="1">
        <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
      </div>
      <ul>
      </ul>
    </form>
  </div>
  <div class="wojo double fitted divider"></div>
</div>
<?php if(!$galdata):?>
<?php Filter::msgSingleInfo(Lang::$word->GAL_NOGAL);?>
<?php endif;?>
<div id="gallery" class="four columns small-gutters">
  <?php if($galdata):?>
  <?php foreach($galdata as $row):?>
  <div class="row">
    <div class="wojo basic image reveal slide"> <img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/pics' . Filter::$id . '/'.$row->photo;?>&amp;w=500&amp;h=300" alt="">
      <div class="mask">
        <div class="content"><a href="<?php echo UPLOADURL.'/listings/pics' . Filter::$id . '/'.$row->photo;?>" class="lightbox" title="<?php echo $row->title;?>"><i class="circular info large inverted unhide icon link"></i></a> <a class="imgdelete" data-lid="<?php echo Filter::$id;?>" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->title;?>"><i class="circular danger large inverted trash icon link"></i></a></div>
      </div>
      <div class="caption"><span class="editable" contenteditable="true" data-id="<?php echo $row->id;?>" data-edit-type="gallery"><?php echo $row->title;?></span></div>
    </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<a href="index.php?do=listings" class="wojo icon basic button"><i class="icon left triangle"></i> <?php echo Lang::$word->BACKTO;?></a> 
<script src="assets/js/jquery.knob.js"></script> 
<script src="assets/js/jquery.iframe-transport.js"></script> 
<script src="assets/js/fileupload.js"></script> 