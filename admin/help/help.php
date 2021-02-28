<?php
  /**
   * Help
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * Shared by LOLcLOL
   * @version $Id: help.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);

  require_once ("../init.php");
  if (!$user->is_Admin())
      redirect_to("../login.php");
?>
<div id="config-help">
  <div class="header">
    <p><?php echo Lang::$word->CONF_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->CONF_SITE;?></h5>
      <?php echo Lang::$word->CONF_SITE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_COMPANY;?></h5>
      <?php echo Lang::$word->CONF_COMPANY_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_EMAIL;?></h5>
      <?php echo Lang::$word->CONF_EMAIL_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_URL;?></h5>
      <?php echo Lang::$word->CONF_URL_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_DIR;?></h5>
      <?php echo Lang::$word->CONF_DIR_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_OFFLINE;?></h5>
      <?php echo Lang::$word->CONF_OFFLINE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_OFFLINE_TIME;?></h5>
      <?php echo Lang::$word->CONF_OFFLINE_TIME_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_OFFLINE;?></h5>
      <?php echo Lang::$word->CONF_OFFLINE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_LOC;?></h5>
      <?php echo Lang::$word->CONF_LOC_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_IPP;?></h5>
      <?php echo Lang::$word->CONF_IPP_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_FEATURED;?></h5>
      <?php echo Lang::$word->CONF_FEATURED_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_CURRENCY;?></h5>
      <?php echo Lang::$word->CONF_CURRENCY_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_CURSYMBOL;?></h5>
      <?php echo Lang::$word->CONF_CURSYMBOL_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_MAILER;?></h5>
      <?php echo Lang::$word->CONF_MAILER_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_SMAILPATH;?></h5>
      <?php echo Lang::$word->CONF_SMAILPATH_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_SMTP_HOST;?></h5>
      <?php echo Lang::$word->CONF_SMTP_HOST_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_SMTP_PORT;?></h5>
      <?php echo Lang::$word->CONF_SMTP_PORT_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_SMTP_SSL;?></h5>
      <?php echo Lang::$word->CONF_SMTP_SSL_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_GA;?></h5>
      <?php echo Lang::$word->CONF_GA_I;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_METAKEY;?></h5>
      <?php echo Lang::$word->CONF_METAKEY_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->CONF_METADESC;?></h5>
      <?php echo Lang::$word->CONF_METADESC_T;?></div>
  </div>
</div>
<div id="user-help">
  <div class="header">
    <p><?php echo Lang::$word->USR_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->LOCATIONS;?></h5>
      <?php echo Lang::$word->USR_LOCATIONS_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->USR_LEVEL;?></h5>
      <?php echo Lang::$word->USR_LEVEL_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->USR_NOTIFY;?></h5>
      <?php echo Lang::$word->USR_NOTIFY_T;?></div>
  </div>
</div>
<div id="showroom-help">
  <div class="header">
    <p><?php echo Lang::$word->LOC_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->LOC_SEARCH;?></h5>
      <?php echo Lang::$word->LOC_SEARCH_T;?></div>
  </div>
</div>
<div id="listing-help">
  <div class="header">
    <p><?php echo Lang::$word->LST_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->LST_FEATURED;?></h5>
      <?php echo Lang::$word->LST_FEATURED_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_ACTIVE;?></h5>
      <?php echo Lang::$word->LST_ACTIVE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_LTITLE;?></h5>
      <?php echo Lang::$word->LST_LTITLE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_SLUG;?></h5>
      <?php echo Lang::$word->LST_SLUG_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_NOTES;?></h5>
      <?php echo Lang::$word->LST_NOTES_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_METAKEY;?></h5>
      <?php echo Lang::$word->LST_METAKEY_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LST_METADESC;?></h5>
      <?php echo Lang::$word->LST_METADESC_T;?></div>
  </div>
</div>
<div id="page-help">
  <div class="header">
    <p><?php echo Lang::$word->PAG_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->PAG_SLUG;?></h5>
      <?php echo Lang::$word->PAG_SLUG_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->PAG_HOME;?></h5>
      <?php echo Lang::$word->PAG_HOME_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->PAG_FAQPAGE;?></h5>
      <?php echo Lang::$word->PAG_FAQPAGE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->PAG_CNPAGE;?></h5>
      <?php echo Lang::$word->PAG_CNPAGE_T;?></div>
  </div>
</div>
<div id="menu-help">
  <div class="header">
    <p><?php echo Lang::$word->MENU_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->MENU_OPT;?></h5>
      <?php echo Lang::$word->MENU_INFO_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->MENU_NAME;?></h5>
      <?php echo Lang::$word->MENU_NAME_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->MENU_TYPE;?></h5>
      <?php echo Lang::$word->MENU_TYPE_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->MENU_LINK;?></h5>
      <?php echo Lang::$word->MENU_LINK_T;?></div>
  </div>
</div>
<div id="language-help">
  <div class="header">
    <p><?php echo Lang::$word->LNG_HELP;?></p>
    <a class="helper"><i class="icon reorder"></i></a></div>
  <div class="wojo-content" id="help-items">
    <div class="item">
      <h5><?php echo Lang::$word->LNG_NAME;?></h5>
      <?php echo Lang::$word->LNG_NAME_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LNG_ABBR;?></h5>
      <?php echo Lang::$word->LNG_ABBR_T;?></div>
    <div class="item">
      <h5><?php echo Lang::$word->LNG_NEW;?></h5>
      <?php echo Lang::$word->LNG_NEW_T;?></div>
  </div>
</div>