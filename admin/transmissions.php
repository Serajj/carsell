<?php
  /**
   * Transmissions
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: transmissions.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $transrow = $content->getTransmissions();
?>
<a id="add" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->TRNS_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->TRNS_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_TRANS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="settings icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->TRNS_SUB;?> </div>
    <p><?php echo Lang::$word->TRNS_INFO;?></p>
  </div>
</div>
<div id="trans" class="<?php echo($transrow) ? "three" : "one"?> columns small-gutters">
  <?php if(!$transrow):?>
  <div class="row"><?php echo Filter::msgSingleInfo(Lang::$word->TRNS_NOTRANS);?></div>
  <?php else:?>
  <?php foreach($transrow as $row):?>
  <div class="row">
    <div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="<?php echo $row->id;?>" data-edit-type="transmission"><?php echo $row->name;?></span> <a class="delete wojo top right negative corner label" data-title="<?php echo Lang::$word->TRNS_DEL;?>" data-option="deleteTransmission" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="icon delete"></i></a> </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('a#add').on('click', function () {
        new Messi("<div class=\"wojo small form\"><input type=\"text\" placeholder=\"<?php echo Lang::$word->TRNS_NAME;?>\" name=\"catname\"></div>", {
            'title': '<?php echo Lang::$word->TRNS_ADDNEW;?>',
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: '<?php echo Lang::$word->TRNS_ADD;?>',
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
						processTransmission: 1,
						name: catname
					}),
					success: function (json) {
						if (json.type == "success") {
							$(".wojo.info.message").remove();
							$("#trans").prepend(json.data);
							$("#trans .row").children(":first").effect("highlight", {}, 3000);
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