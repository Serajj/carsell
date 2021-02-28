<?php
  /**
   * Features
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: features.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $featrow = $content->getFeatures();
?>
<a id="add" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->FEAT_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->FEAT_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_FEATURES;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="reorder icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->FEAT_SUB;?> </div>
    <p><?php echo Lang::$word->FEAT_INFO;?></p>
  </div>
</div>
<div id="con" class="<?php echo($featrow) ? "three" : "one"?> columns small-gutters">
  <?php if(!$featrow):?>
  <div class="row"><?php echo Filter::msgSingleInfo(Lang::$word->FEAT_NOFEATURE);?></div>
  <?php else:?>
  <?php foreach($featrow as $row):?>
  <div class="row">
    <div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="<?php echo $row->id;?>" data-edit-type="feature"><?php echo $row->name;?></span> <a class="delete wojo top right negative corner label" data-title="<?php echo Lang::$word->FEAT_DEL;?>" data-option="deleteFeature" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="icon delete"></i></a> </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('a#add').on('click', function () {
        new Messi("<div class=\"wojo small form\"><input type=\"text\" placeholder=\"<?php echo Lang::$word->FEAT_NAME;?>\" name=\"catname\"></div>", {
            'title': '<?php echo Lang::$word->FEAT_ADDNEW;?>',
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: '<?php echo Lang::$word->FEAT_ADD;?>',
                class: 'positive',
                val: 'Y'
            }],
            callback: function (val) {
				var catname = $('input[name="catname"]').val();
                $.ajax({
                    type: 'post',
                    url: "controller.php",
                    dataType: 'json',
					data: ({
						processFeature: 1,
						name: catname
					}),
					success: function (json) {
						if (json.type == "success") {
							$(".wojo.info.message").remove();
							$("#con").prepend(json.data);
							$("#con .row").children(":first").effect("highlight", {}, 3000);
						}
                        $.sticky(decodeURIComponent(json.message), {
                            type: json.type,
                            title: json.title
                        });
					}

                });
            }
        });
    });
});
// ]]>
</script> 