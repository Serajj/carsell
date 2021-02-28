<?php
  /**
   * Category
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: category.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
   $catrow = $content->getCategories();
?>
<a id="add" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->CAT_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->CAT_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_CATS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="ellipsis horizontal icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->CAT_SUB;?> </div>
    <p><?php echo Lang::$word->CAT_INFO;?></p>
  </div>
</div>
<div id="cat" class="<?php echo($catrow) ? "three" : "one"?> columns small-gutters">
  <?php if(!$catrow):?>
  <div class="row"><?php echo Filter::msgSingleInfo(Lang::$word->CAT_NOCAT);?></div>
  <?php else:?>
  <?php foreach($catrow as $row):?>
  <div class="row">
    <div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="<?php echo $row->id;?>" data-edit-type="category"><?php echo $row->name;?></span> <a class="delete wojo top right negative corner label" data-title="<?php echo Lang::$word->CAT_DEL;?>" data-option="deleteCategory" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="icon delete"></i></a> </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('a#add').on('click', function () {
        new Messi("<div class=\"wojo small form\" style=\"max-width:350px\"><div class=\"field\"><input type=\"text\" placeholder=\"<?php echo Lang::$word->CAT_NAME;?>\" name=\"catname\"></div><div class=\"inline-group\"><?php foreach(fetchFiles(BASEPATH . '/assets/images/catico/') as $img):?><label class=\"radio\"><input name=\"image\" type=\"radio\" value=\"<?php echo $img;?>\"><i></i><img src=\"<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo SITEURL.'/assets/images/catico/'.$img;?>&amp;w=60&amp;h=40\" alt=\"\" /></label><?php endforeach;?></div></div>", {
            'title': '<?php echo Lang::$word->CAT_ADDNEW;?>',
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: '<?php echo Lang::$word->CAT_ADD;?>',
                class: 'positive',
                val: 'Y'
            }],
            callback: function (val) {
				var catname = $('input[name="catname"]').val();
				var image = $('input[name=image]:checked').val()
                $.ajax({
                    type: 'post',
                    url: "controller.php",
                    dataType: 'json',
					data: ({
						processCategory: 1,
						name: catname,
						img: image
					}),
					success: function (json) {
						if (json.type == "success") {
							$(".wojo.info.message").remove();
							$("#cat").prepend(json.data);
							$("#cat .row").children(":first").effect("highlight", {}, 3000);
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