<?php
  /**
   * Language Manager
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: language.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "add": ?>
<h1 class="main-header"><?php echo Lang::$word->LNG_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=language" class="section"><?php echo Lang::$word->ADM_LANG;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LNG_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="language"><i class="icon help"></i></a> <i class="chat icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LNG_ADD;?> </div>
    <p><?php echo Lang::$word->LNG_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->LNG_SUB1;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->LNG_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->LNG_NAME;?>" name="name">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LNG_ABBR;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->LNG_ABBR;?>" name="abbr">
        </label>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->LNG_ADD;?></button>
    <a href="index.php?do=language" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processLang" type="hidden" value="1">
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default: ?>
<?php $langrow = Lang::getLanguage();?>
<a href="index.php?do=language&amp;action=add" class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->LNG_ADD;?>"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->LNG_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_LANG;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="chat icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LNG_SUB;?> </div>
    <p><?php echo Lang::$word->LNG_INFO;?></p>
  </div>
</div>
<div class="wojo small form">
  <div class="wojo positive segment">
    <div class="two fields">
      <div class="field">
        <div class="wojo icon input">
          <input id="filter" type="text" placeholder="<?php echo Lang::$word->SEARCH;?>">
          <i class="search icon"></i> </div>
      </div>
      <div class="field">
        <select id="group" name="group">
          <option value="all"><?php echo Lang::$word->LNG_RESET;?></option>
          <option value="Global"><?php echo Lang::$word->GLOBAL;?></option>
          <option value="Backup"><?php echo Lang::$word->BAC_TITLE;?></option>
          <option value="Categories"><?php echo Lang::$word->CAT_TITLE;?></option>
          <option value="Contact"><?php echo Lang::$word->TAB_CONTACT;?></option>
          <option value="Conditions"><?php echo Lang::$word->COND_TITLE;?></option>
          <option value="Configuration"><?php echo Lang::$word->CONF_TITLE;?></option>
          <option value="Dashboard"><?php echo Lang::$word->DASH_NAME;?></option>
          <option value="Email"><?php echo Lang::$word->ETPL_TITLE;?></option>
          <option value="FAQ"><?php echo Lang::$word->FAQ_TITLE;?></option>
          <option value="Front"><?php echo Lang::$word->FRONT;?></option>
          <option value="Features"><?php echo Lang::$word->FEAT_TITLE;?></option>
          <option value="Fuel"><?php echo Lang::$word->FUEL_TITLE;?></option>
          <option value="Gallery"><?php echo Lang::$word->GAL_TITLE;?></option>
          <option value="Language"><?php echo Lang::$word->LNG_TITLE;?></option>
          <option value="Listings"><?php echo Lang::$word->LST_TITLE;?></option>
          <option value="Locations"><?php echo Lang::$word->LOC_TITLE;?></option>
          <option value="Makes"><?php echo Lang::$word->MAKE_TITLE;?></option>
          <option value="Menus"><?php echo Lang::$word->MENU_TITLE;?></option>
          <option value="Models"><?php echo Lang::$word->MODL_TITLE;?></option>
          <option value="Navigation"><?php echo Lang::$word->ADM_NAV;?></option>
          <option value="Newsletter"><?php echo Lang::$word->ADM_NLETTER;?></option>
          <option value="Pages"><?php echo Lang::$word->PAG_TITLE;?></option>
          <option value="Pagination"><?php echo Lang::$word->PAGINATION;?></option>
          <option value="Preview"><?php echo Lang::$word->LPR_SUMMARY;?></option>
          <option value="Transmissions"><?php echo Lang::$word->TRNS_TITLE;?></option>
          <option value="Sitemap"><?php echo Lang::$word->MAP_TITLE;?></option>
          <option value="System"><?php echo Lang::$word->SYS_TITLE;?></option>
          <option value="Users"><?php echo Lang::$word->USR_TITLE;?></option>
        </select>
      </div>
    </div>
  </div>
  <div class="two columns small-gutters">
    <?php foreach($langrow as $row):?>
    <div class="row" data-group="<?php echo $row->lang_type;?>">
      <textarea data-id="<?php echo $row->id;?>" name="phrase"><?php echo $row->lang_value;?></textarea>
    </div>
    <?php endforeach;?>
  </div>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    /* == Filter == */
    $("#filter").on("keyup", function () {
        var filter = $(this).val(),
            count = 0;
        $("textarea").each(function () {
            if ($(this).val().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().fadeOut();
            } else {
                $(this).parent().show();
                count++;
            }
        });
    });

    /* == Group Filter == */
    $('#group').change(function () {
        var sel = $(this).val();
        $('div.row').hide();
        if (sel != "all") {
            $('.row[data-group="' + sel + '"]').show();
        } else {
            $('div.row').show();
        }
    });

    /* == Inline Edit == */
    $('body').on('focus', 'textarea', function () {
        $(this).data("initialText", $(this).val());
    }).on('blur', 'textarea', function () {
        if ($(this).data("initialText") !== $(this).val()) {
            value = $(this).val();
            id = $(this).data("id")
            $this = $(this);
            $.ajax({
                type: "POST",
                url: "controller.php",
                data: ({
                    'title': value,
					'type': 'phrase',
                    'id': id,
                    'quickedit': 1
                }),
                beforeSend: function () {
                    $this.val('working...').animate({
                        opacity: 0.2
                    }, 800);
                },
                success: function (res) {
                    $this.animate({
                        opacity: 1
                    }, 800);
                    $this.addClass("active");
                    setTimeout(function () {
                        $this.val(res).fadeIn("slow");
                    }, 1000);
                }
            })
        }
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>