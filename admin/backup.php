<?php
  /**
   * Database Backup
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: backup.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
  if($user->userlevel == 8): print Filter::msgInfo(Lang::$word->NOACCESS, false); return; endif;
  
  require_once(BASEPATH . "lib/class_dbtools.php");
  Registry::set('dbTools',new dbTools());
  $tools = Registry::get("dbTools"); 

  if (isset($_GET['backupok']) && $_GET['backupok'] == "1")
      Filter::msgOk(Lang::$word->BAC_CREATED,1,1);
	    
  if (isset($_GET['create']) && $_GET['create'] == "1")
      $tools->doBackup('',false);
	  
  $dir = BASEPATH . 'admin/backups/';
?>
<a href="index.php?do=backup&amp;create=1" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->BAC_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->BAC_ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->BAC_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->SYS_TITLE;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="hdd icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->BAC_SUB;?> </div>
    <p><?php echo Lang::$word->BAC_INFO;?></p>
  </div>
</div>
<?php /*?>  <div class="wojo buttons" id="tabs"> <a class="wojo button" data-tab="#dbbackup"><?php echo Lang::$word->BAC_SUB;?></a> <a class="wojo button" data-tab="#optimize"><?php echo Lang::$word->BAC_OPTIMIZE;?></a> </div><?php */?>
<div class="wojo segment">
  <?php if (is_dir($dir)):?>
  <?php $getDir = dir($dir);?>
  <div class="wojo divided list">
    <?php while (false !== ($file = $getDir->read())):?>
    <?php if ($file != "." && $file != ".." && $file != "index.php"):?>
    <?php $latest =  ($file == $core->dbbackup) ? " active" : "";?>
    <div class="item<?php echo $latest;?>"><i class="icon hdd"></i>
      <div class="header"><?php echo getSize(filesize(BASEPATH . 'admin/backups/' . $file));?></div>
      <div class="push-right"> <a class="dbdelete" data-title="<?php echo Lang::$word->BAC_DELETE;?>" data-option="deleteBackup" data-file="<?php echo $file;;?>" data-name="<?php echo $file;?>"><i class="rounded danger inverted trash icon"></i></a> <a href="<?php echo ADMINURL . '/backups/' . $file;?>" data-content="<?php echo Lang::$word->DOWNLOAD;?>"><i class="rounded success inverted download alt icon"></i></a> <a class="restore" data-content="<?php echo Lang::$word->BAC_RESTORE;?>" data-file="<?php echo $file;?>"><i class="rounded warning inverted refresh icon"></i></a> </div>
      <div class="content"><?php echo str_replace(".sql", "", $file);?></div>
    </div>
    <?php endif;?>
    <?php endwhile;?>
    <?php $getDir->close();?>
  </div>
  <?php endif;?>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('a.restore').on('click', function () {
        var parent = $(this).closest('div.item');
        var id = $(this).data('file')
        var title = id;
        var text = "<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p><?php echo Lang::$word->BAC_DORESTORE1;?><br><strong><?php echo Lang::$word->BAC_DORESTORE2;?></strong></p></div>";
        new Messi(text, {
            title: "<?php echo Lang::$word->BAC_RESTORE;?>",
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: "<?php echo Lang::$word->BAC_RESTORE;?>",
                val: 'Y',
				class: 'negative'
            }],
            callback: function (val) {
                if (val === "Y") {
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: "controller.php",
						data: 'restoreBackup=' + id,
						success: function (json) {
							parent.effect('highlight', 1500);
							$.sticky(decodeURIComponent(json.message), {
								type: json.type,
								title: json.title
							});
						}
					});
                }
            }
        })
    });
	
    $('body').on('click', 'a.dbdelete', function () {
        var file = $(this).data('file');
        var name = $(this).data('name');
        var title = $(this).data('title');
        var option = $(this).data('option');
        var parent = $(this).parent().parent();

        new Messi("<div class=\"messi-warning\"><i class=\"massive icon warn warning sign\"></i></p><p><?php echo Lang::$word->DELCONFIRM;?><br><strong><?php echo Lang::$word->DELCONFIRM2;?></strong></p></div>", {
            title: title,
            titleClass: '',
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: '<?php echo Lang::$word->DELETE;?>',
                class: 'negative',
                val: 'Y'
            }],
            callback: function (val) {
                $.ajax({
                    type: 'post',
                    url: "controller.php",
                    dataType: 'json',
                    data: {
                        file: file,
                        delete: option,
                        title: encodeURIComponent(name)
                    },
                    beforeSend: function () {
                        parent.animate({
                            'backgroundColor': '#FFBFBF'
                        }, 400);
                    },
                    success: function (json) {
                        parent.fadeOut(400, function () {
                            parent.remove();
                        });
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