<?php
  /**
   * Configuration
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: config.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php if($user->userlevel == 8): print Filter::msgInfo(Lang::$word->NOACCESS, false); return; endif;?>
<h1 class="main-header"><?php echo Lang::$word->CONF_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->CONF_UPDATE;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"><a class="helper wojo top right corner label" data-help="config"><i class="icon help"></i></a> <i class="laptop icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->CONF_TITLE;?> </div>
    <p><?php echo Lang::$word->CONF_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->CONF_SUB;?></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_SITE;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="site_name" type="text" value="<?php echo $core->site_name;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_COMPANY;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="company" type="text" value="<?php echo $core->company;?>">
        </label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="site_email" type="text" value="<?php echo $core->site_email;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_URL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="site_url" type="text" value="<?php echo $core->site_url;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_DIR;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="site_dir" type="text" value="<?php echo $core->site_dir;?>">
        </label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_ADDRESS;?></label>
        <input name="address" type="text" value="<?php echo $core->address;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_CITY;?></label>
        <input name="city" type="text" value="<?php echo $core->city;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_STATE;?></label>
        <input name="state" type="text" value="<?php echo $core->state;?>">
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_ZIP;?></label>
        <input name="zip" type="text" value="<?php echo $core->zip;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_PHONE;?></label>
        <input name="phone" type="text" value="<?php echo $core->phone;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FAX;?></label>
        <input name="fax" type="text" value="<?php echo $core->fax;?>">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->FB;?></label>
        <input name="fb" type="text" value="<?php echo $core->fb;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->TWITTER;?></label>
        <input name="twitter" type="text" value="<?php echo $core->twitter;?>">
      </div>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOGO;?></label>
        <label class="input">
          <input type="file" name="logo" class="filefield">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOGO_I;?></label>
        <div class="wojo avatar image">
          <?php if($core->logo):?>
          <a href="<?php echo UPLOADURL . '/' . $core->logo;?>" class="lightbox"><img src="<?php echo UPLOADURL . '/' . $core->logo;?>" alt="" /></a>
          <?php endif;?>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_DELLOGO;?></label>
        <label class="checkbox">
          <input name="dellogo" type="checkbox" value="1">
          <i></i><?php echo Lang::$word->YES;?></label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_OFFLINE;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="offline" type="radio" onclick="$('.offline-data').show();" value="1" <?php echo getChecked($core->offline, 1);?>>
            <i></i><?php echo Lang::$word->YES;?></label>
          <label class="radio">
            <input name="offline" type="radio" onclick="$('.offline-data').hide();" value="0" <?php echo getChecked($core->offline, 0);?>>
            <i></i><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_SDATE;?></label>
        <select name="short_date">
          <?php echo $core->getShortDate();?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LDATE;?></label>
        <select name="long_date">
          <?php echo $core->getLongDate();?>
        </select>
      </div>
    </div>
    <div class="two fields wojo segment offline-data"<?php echo ($core->offline) ? "" : " style=\"display:none\""; ?>>
      <div class="field">
        <label><?php echo Lang::$word->CONF_OFFLINE_DATE;?></label>
        <label class="input"><i class="icon-prepend icon calendar"></i> <i class="icon-append icon asterisk"></i>
          <input name="offline_d" data-datepicker="true" type="text" value="<?php echo $core->offline_d;?>">
        </label>
        <div class="small-top-space"></div>
        <label><?php echo Lang::$word->CONF_OFFLINE_TIME;?></label>
        <label class="input"><i class="icon-prepend icon time"></i> <i class="icon-append icon asterisk"></i>
          <input name="offline_t" data-timepicker="true" type="text" value="<?php echo $core->offline_t;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_OFFLINE_INFO;?></label>
        <textarea class="altpost" name="offline_msg"><?php echo $core->offline_msg;?></textarea>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_TZ;?></label>
        <?php echo $core->getTimezones();?> </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOC;?></label>
        <select name="locale">
          <?php echo $core->getlocaleList();?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LANG;?></label>
        <select name="lang">
          <?php foreach(Lang::fetchLanguage() as $lang):?>
          <option value="<?php echo $lang->abbr;?>"<?php if($core->lang == $lang->abbr) echo ' selected="selected"';?>><?php echo $lang->name;?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_IPP;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="ipp" type="text" value="<?php echo $core->ipp;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FEATURED;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="featured" type="text" value="<?php echo $core->featured;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_SPEAD;?></label>
        <select name="odometer">
          <option value="km"<?php if ($core->odometer == "km") echo " selected=\"selected\"";?>><?php echo Lang::$word->KM;?></option>
          <option value="mi"<?php if ($core->odometer == "mi") echo " selected=\"selected\"";?>><?php echo Lang::$word->MI;?></option>
        </select>
      </div>
    </div>
    <div class="four fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_CURRENCY;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="currency" type="text" value="<?php echo $core->currency;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_CURSYMBOL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="cur_symbol" type="text" value="<?php echo $core->cur_symbol;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_TSEP;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="tsep" type="text" value="<?php echo $core->tsep;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_DSEP;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="dsep" type="text" value="<?php echo $core->dsep;?>">
        </label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_GA;?></label>
        <textarea name="analytics"><?php echo $core->analytics;?></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_METAKEY;?></label>
        <textarea name="metakeys"><?php echo $core->metakeys;?></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_METADESC;?></label>
        <textarea name="metadesc"><?php echo $core->metadesc;?></textarea>
      </div>
    </div>
    <div class="wojo fitted divider"></div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_MAILER;?></label>
        <select name="mailer" id="mailerchange" class="selectbox">
          <option value="PHP" <?php if ($core->mailer == "PHP") echo "selected=\"selected\"";?>>PHP Mailer</option>
          <option value="SMAIL" <?php if ($core->mailer == "SMAIL") echo "selected=\"selected\"";?>>Sendmail</option>
          <option value="SMTP" <?php if ($core->mailer == "SMTP") echo "selected=\"selected\"";?>>SMTP Mailer</option>
        </select>
      </div>
      <div class="field showsmail">
        <label><?php echo Lang::$word->CONF_SMAILPATH;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="sendmail" value="<?php echo $core->sendmail;?>" type="text">
        </label>
      </div>
      <div class="field"> </div>
    </div>
    <div class="showsmtp">
      <div class="wojo thin attached divider"></div>
      <div class="two fields">
        <div class="field">
          <label><?php echo Lang::$word->CONF_SMTP_HOST;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_host" value="<?php echo $core->smtp_host;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_HOST;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->CONF_SMTP_USER;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_user" value="<?php echo $core->smtp_user;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_USER;?>" type="text">
          </label>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label><?php echo Lang::$word->CONF_SMTP_PASS;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_pass" value="<?php echo $core->smtp_pass;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_PASS;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->CONF_SMTP_PORT;?></label>
          <label class="input"><i class="icon-append icon asterisk"></i>
            <input name="smtp_port" value="<?php echo $core->smtp_port;?>" placeholder="<?php echo Lang::$word->CONF_SMTP_PORT;?>" type="text">
          </label>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->CONF_SMTP_SSL;?></label>
          <div class="inline-group">
            <label class="radio">
              <input name="is_ssl" type="radio" value="1" <?php getChecked($core->is_ssl, 1); ?>>
              <i></i><?php echo Lang::$word->YES;?></label>
            <label class="radio">
              <input name="is_ssl" type="radio" value="0" <?php getChecked($core->is_ssl, 0); ?>>
              <i></i> <?php echo Lang::$word->NO;?> </label>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->CONF_UPDATE;?></button>
    <input name="processConfig" type="hidden" value="1" />
  </form>
</div>
<div id="msgholder"></div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
	var res2 = '<?php echo $core->mailer;?>';
		(res2 == "SMTP" ) ? $('.showsmtp').show() : $('.showsmtp').hide();
    $('#mailerchange').change(function () {
		var res = $("#mailerchange option:selected").val();
		(res == "SMTP" ) ? $('.showsmtp').show() : $('.showsmtp').hide();
	});
	
    (res2 == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
    $('#mailerchange').change(function () {
        var res = $("#mailerchange option:selected").val();
        (res == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
    });
});
// ]]>
</script> 
