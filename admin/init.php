<?php
  /**
   * Init
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: init.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php //error_reporting(E_ALL);

  if (substr(PHP_OS, 0, 3) == "WIN") {
      $BASEPATH = str_replace("admin\\init.php", "", realpath(__FILE__));
  } else {
      $BASEPATH = str_replace("admin/init.php", "", realpath(__FILE__));
  }
  define("BASEPATH", $BASEPATH);
  
  $configFile = BASEPATH . "lib/config.ini.php";
  if (file_exists($configFile)) {
      require_once($configFile);
  } else {
      header("Location: setup/");
  }

  require_once(BASEPATH . "lib/class_db.php");
  
  require_once(BASEPATH . "lib/class_registry.php");
  Registry::set('Database',new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE));
  $db = Registry::get("Database");
  $db->connect();

  
  //Include Functions
  require_once(BASEPATH . "lib/fn_seo.php");
  require_once(BASEPATH . "lib/functions.php");

  //Start Filter Class 
  require_once(BASEPATH . "lib/class_filter.php");
  $filter = new Filter();  

  //Start Core Class 
  require_once(BASEPATH . "lib/class_core.php");
  Registry::set('Core',new Core());
  $core = Registry::get("Core");

  //Start Language Class 
  require_once(BASEPATH . "lib/class_language.php");
  Registry::set('Lang',new Lang());
  
  //Start Content Class
  require_once(BASEPATH . "lib/class_content.php");
  Registry::set('Content',new Content());
  $content = Registry::get("Content");

  //Start Paginator Class 
  require_once(BASEPATH . "lib/class_paginate.php");
  $pager = Paginator::instance();

  //Start Uploader Class 
  require_once(BASEPATH . "lib/class_upload.php");

  //Star tUser Class 
  require_once(BASEPATH . "lib/class_user.php");
  Registry::set('Users',new Users());
  $user = Registry::get("Users");

  //Start Minify Class
  require_once (BASEPATH . "lib/class_minify.php");
  Registry::set('Minify', new Minify());
  
  if (isset($_SERVER['HTTPS'])) {
      $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
  } else {
      $protocol = 'http';
  }
  $dir = (Registry::get("Core")->site_dir) ? '/' . Registry::get("Core")->site_dir : '';
  $url = preg_replace("#/+#", "/", $_SERVER['HTTP_HOST'] . $dir);
  $site_url = $protocol . "://" . $url;
  
  define("SITEURL", $site_url);
  define("ADMINURL", $site_url."/admin");
  define("UPLOADS", BASEPATH."uploads/");
  define("UPLOADURL", SITEURL."/uploads");
  define("THEME", BASEPATH . "admin/assets");
  define("THEMEU", SITEURL . "/admin/assets");

?>