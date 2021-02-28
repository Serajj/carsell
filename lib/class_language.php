<?php
  /**
   * Language
   * 
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: class_lang.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');


  final class Lang
  {
	  public static $language;
	  const lTable = "language";
	  public static $word = array();


      /**
       * Lang::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  self::get();
      }
	  
      /**
       * Lang::get()
       * 
       * @return
       */
	  private static function get()
	  {

		  self::$word = self::set(Registry::get("Core")->lang);
		  return self::$word;
	  }

      /**
       * Lang::set()
       * 
       * @return
       */
	  private static function set($lang)
	  {
		  $sql = "SELECT * FROM " . self::lTable . " WHERE abbr = '" . $lang . "'";
		  $dbdata = Registry::get("Database")->fetch_all($sql);
		  if($dbdata) {
		  $data = new stdClass();
			  foreach($dbdata as $row) {
				  $key = $row->lang_key;
				  $data->$key = $row->lang_value;
			  }
		  }
		  return ($dbdata) ? $data : 0;
	  }

      /**
       * Lang::getLanguage()
       * 
       * @return
       */
	  public static function getLanguage()
	  {
		  $sql = "SELECT * FROM " . self::lTable . " WHERE abbr = '" . Registry::get("Core")->lang . "' ORDER BY lang_value";
		  $row = Registry::get("Database")->fetch_all($sql);
		  
		  return ($row ) ? $row  : 0;
	  }

	  
      /**
       * Lang::fetchLanguage()
       * 
       * @return
       */
	  public static function fetchLanguage()
	  {
		  $sql = "SELECT abbr, name FROM " . self::lTable . " GROUP BY abbr";
		  $row = Registry::get("Database")->fetch_all($sql);
		  
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Lang::processLang()
       * 
       * @return
       */
	  public static function processLang()
	  {
		  Filter::checkPost('name', self::$word->LNG_NAME);
		  Filter::checkPost('abbr', self::$word->LNG_ABBR);
		  
          if (empty(Filter::$msgs)) {
			  
			  $data = Registry::get("Database")->fetch_all("SELECT * FROM " . self::lTable . " WHERE abbr = 'en' ORDER BY lang_value");
			  
			  $query = "INSERT INTO " . self::lTable . " (lang_key, lang_value, lang_type, abbr, name) VALUES ('";
			  $values = array();
	
			  foreach ($data as $val) {
				  $values[] = $val->lang_key . '\', \'' . $val->lang_value . '\', \'' . $val->lang_type . '\', \'' . sanitize($_POST['abbr']) . '\', \'' . sanitize($_POST['name']);
			  }
	
			  $query .= implode('\'), (\'', $values) . '\')';
			  Registry::get("Database")->query($query);
		  

			  if (Registry::get("Database")->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(self::$word->LNG_ADDED, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(self::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);

		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }

  }
?>