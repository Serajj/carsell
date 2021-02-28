<?php
  /**
   * Functions
   *
   * @package Freelance Manager
   * @author wojoscripts.com
   * @copyright 2011
   * @version $Id: functions.php, v1.00 2011-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  /**
   * redirect_to()
   * 
   * @param mixed $location
   * @return
   */
  function redirect_to($location)
  {
      if (!headers_sent()) {
          header('Location: ' . $location);
		  exit;
	  } else
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
  }
  
  /**
   * countEntries()
   * 
   * @param mixed $table
   * @param string $where
   * @param string $what
   * @return
   */
  function countEntries($table, $where = '', $what = '')
  {
      if (!empty($where) && isset($what)) {
          $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
      } else
          $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
      
      $record = Registry::get("Database")->query($q);
      $total = Registry::get("Database")->fetchrow($record);
      return $total[0];
  }
  
  /**
   * getChecked()
   * 
   * @param mixed $row
   * @param mixed $status
   * @return
   */
  function getChecked($row, $status)
  {
      if ($row == $status) {
          echo "checked=\"checked\"";
      }
  }
  
  /**
   * post()
   * 
   * @param mixed $var
   * @return
   */
  function post($var)
  {
      if (isset($_POST[$var]))
          return $_POST[$var];
  }
  
  /**
   * get()
   * 
   * @param mixed $var
   * @return
   */
  function get($var)
  {
      if (isset($_GET[$var]))
          return $_GET[$var];
  }
  
  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false, $int = false, $str = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim)
          $string = substr($string, 0, $trim);
      if ($int)
		  $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
		  $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
		  
      return $string;
  }

  /**
   * cleanSanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function cleanSanitize($string, $trim = false,  $end_char = '&#8230;')
  {
	  $string = cleanOut($string);
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
	  }
      return $string;
  }

  /**
   * getQs()
   * 
   * @param bool $all
   * @param array $vars
   * @return
   */
  function getQs($all = false, $vars)
  {
      if (!empty($_SERVER['QUERY_STRING'])) {
          $parts = explode("&amp;", $_SERVER['QUERY_STRING']);
          $vars = str_replace(" ", "", $vars);
          $c_vars = explode(",", $vars);
          $newParts = array();
          foreach ($parts as $val) {
              $val_parts = explode("=", $val);
              if (!in_array($val_parts[0], $c_vars)) {
                  array_push($newParts, $val);
              }
          }
          if (count($newParts) != 0) {
              $qs = "&amp;" . implode("&amp;", $newParts);
          } else {
              return false;
          }
          
		  $html = '';
          $charset = explode(",", Lang::$word->CHARSET);
          $html .= "<div class=\"wojo small pagination menu\">\n";
          foreach ($charset as $key) {
			  $active = ($key == get('letter')) ? ' active' : null;
              $html .= "<a class=\"item$active\" href=\"" . phpself() . "?letter=" . $key . $qs . "\">" . $key . "</a>\n";
          }
          $viewAll = ($all === false) ? phpself() : $all;
          $html .= "<a class=\"item\" href=\"" . $viewAll . "\">" . Lang::$word->ALL . "</a>\n";
          $html .= "</div>\n";
		  unset($key);
		  
		  return $html;
	  } else {
		  return false;
	  }
  }
  
  /**
   * getValue()
   * 
   * @param mixed $stwhatring
   * @param mixed $table
   * @param mixed $where
   * @return
   */
  function getValue($what, $table, $where)
  {
      $sql = "SELECT $what FROM $table WHERE $where";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  }  

  /**
   * getValueById()
   * 
   * @param mixed $what
   * @param mixed $table
   * @param mixed $id
   * @return
   */
  function getValueById($what, $table, $id)
  {
      $sql = "SELECT $what FROM $table WHERE id = $id";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  } 
  /**
   * tooltip()
   * 
   * @param mixed $tip
   * @return
   */
  function tooltip($tip)
  {
      return '<img src="' . SITEURL . '/images/tip.png" alt="" class="tooltip" title="' . $tip . '" style="margin-left:5px"/>';
  }
  
  /**
   * required()
   * 
   * @return
   */
  function required()
  {
      return '<img src="' . SITEURL . '/images/required.png" alt="Required Field" />';
  }


  /**
   * getSize()
   * 
   * @param mixed $size
   * @param integer $precision
   * @param bool $long_name
   * @param bool $real_size
   * @return
   */
  function getSize($size, $precision = 2, $long_name = false, $real_size = true)
  {
      $base = $real_size ? 1024 : 1000;
      $pos = 0;
      while ($size > $base) {
          $size /= $base;
          $pos++;
      }
      $prefix = _getSizePrefix($pos);
      @$size_name = $long_name ? $prefix . "bytes" : $prefix[0] . 'B';
      return round($size, $precision) . ' ' . ucfirst($size_name);
  }

  /**
   * _getSizePrefix()
   * 
   * @param mixed $pos
   * @return
   */  
  function _getSizePrefix($pos)
  {
      switch ($pos) {
          case 00:
              return "";
          case 01:
              return "kilo";
          case 02:
              return "mega";
          case 03:
              return "giga";
          default:
              return "?-";
      }
  }
    
  /**
   * stripTags()
   * 
   * @param mixed $start
   * @param mixed $end
   * @param mixed $string
   * @return
   */
  function stripTags($start, $end, $string)
  {
	  $string = stristr($string, $start);
	  $doend = stristr($string, $end);
	  return substr($string, strlen($start), -strlen($doend));
  }

  /**
   * cleanOut()
   * 
   * @param mixed $text
   * @return
   */
  function cleanOut($text) {
	 $text =  strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
	 $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	 $text = str_replace('<br>', '<br />', $text);
	 return stripslashes($text);
  }
    
  /**
   * isActive()
   * 
   * @param mixed $id
   * @return
   */
  function isActive($id)
  {
	  if ($id == 1) {
		  $display = '<img src="images/yes.png" alt="" class="tooltip" title="Published"/>';
	  } else {
		  $display = '<img src="images/no.png" alt="" class="tooltip" title="Unpublished"/>';
	  }

      return $display;;
  }

  /**
   * makeDir()
   * 
   * @param mixed $path
   * @param int $mode
   * @return
   */
  function makeDir($path)
  {
      $path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
      $e = explode("/", ltrim($path, "/"));
      if (substr($path, 0, 1) == "/") {
          $e[0] = "/" . $e[0];
      }
      $c = count($e);
      $cp = $e[0];
      for ($i = 1; $i < $c; $i++) {
          if (!is_dir($cp) && !@mkdir($cp, 0755)) {
              return false;
          }
          $cp .= "/" . $e[$i];
      }
      //return @mkdir($path, $mode);
	  @mkdir ($path, 0755);
	  return @chmod($path, 0755);
  }

  /**
   * delete_directory()
   * 
   * @param mixed $dirname
   * @return
   */ 
	function delete_directory($dirname) {
		$dir_handle='';
	   if (is_dir($dirname))
		  $dir_handle = opendir($dirname);
	   if (!$dir_handle)
		  return false;
	   while($file = readdir($dir_handle)) {
		  if ($file != "." && $file != "..") {
			 if (!is_dir($dirname."/".$file))
				unlink($dirname."/".$file);
			 else
				delete_directory($dirname.'/'.$file);    
		  }
	   }
	   closedir($dir_handle);
	   rmdir($dirname);
	   return true;
	}

  /**
   * doUrl()
   * 
   * @return
   */ 
  function doUrl($id, $slug, $type) {
	  
	  switch($type) {
		  case "item" :
		   return SITEURL . '/item/' . $id . '/' . $slug . '/';
		  break;
		  
		  case "category" :
		   return SITEURL . '/category/' . $slug . '/';
		  break;
		  
		  case "content" :
		   return SITEURL . '/content/' . $slug . '/';
		  break;
	  }

  }
  
  /**
   * truncate()
   * 
   * @param mixed $string
   * @param mixed $length
   * @param bool $ellipsis
   * @return
   */
  function truncate($string, $length, $ellipsis = true)
  {
      $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
      $length = round($length - $wide * 0.2);
      $clean_string = preg_replace('/&[^;]+;/', '-', $string);
      if (strlen($clean_string) <= $length)
          return $string;
      $difference = $length - strlen($clean_string);
      $result = substr($string, 0, $difference);
      if ($result != $string and $ellipsis) {
          $result = add_ellipsis($result);
      }
      return $result;
  }

  /**
   * add_ellipsis()
   * 
   * @param mixed $string
   * @return
   */
  function add_ellipsis($string)
  {
      $string = substr($string, 0, strlen($string) - 3);
      return trim(preg_replace('/ .{1,3}$/', '', $string)) . '...';
  }

  /**
   * compareNumbers()
   * 
   * @param mixed $float1
   * @param mixed $float2
   * @param string $operator
   * @return
   */
  function compareNumbers($float1, $float2, $operator='=')  
  {  
	  // Check numbers to 5 digits of precision  
	  $epsilon = 0.00001;  
		
	  $float1 = (float)$float1;  
	  $float2 = (float)$float2;  
		
	  switch ($operator)  
	  {  
		  // equal  
		  case "=":  
		  case "eq":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return true;  
			  }  
			  break;    
		  // less than  
		  case "<":  
		  case "lt":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return false;  
			  } else {  
				  if ($float1 < $float2) {  
					  return true;  
				  }  
			  }  
			  break;    
		  // less than or equal  
		  case "<=":  
		  case "lte":  
			  if (compareFloatNumbers($float1, $float2, '<') || compareFloatNumbers($float1, $float2, '=')) {  
				  return true;  
			  }  
			  break;    
		  // greater than  
		  case ">":  
		  case "gt":  
			  if (abs($float1 - $float2) < $epsilon) {  
				  return false;  
			  } else {  
				  if ($float1 > $float2) {  
					  return true;  
				  }  
			  }  
			  break;    
		  // greater than or equal  
		  case ">=":  
		  case "gte":  
			  if (compareFloatNumbers($float1, $float2, '>') || compareFloatNumbers($float1, $float2, '=')) {  
				  return true;  
			  }  
			  break;    
		
		  case "<>":  
		  case "!=":  
		  case "ne":  
			  if (abs($float1 - $float2) > $epsilon) {  
				  return true;  
			  }  
			  break;    
		  default:  
			  die("Unknown operator '".$operator."' in compareFloatNumbers()");    
	  }  
		
	  return false;  
  } 

  /**
   * parseUrl()
   * 
   * @return
   */ 
  function parseUrl($link, $page)
  {
      $url_data = parse_url(str_replace('&amp;', '&', $link));
      $url = '';
      $data = array();

      if (isset($url_data['query'])) {
          parse_str($url_data['query'], $data);
      }
      $query = '';
      if ($url) {

          if ($data) {
              $query .= http_build_query($data);

              if ($query) {
                  $query = '?' . trim($query, '&');
              }

              $result = $url . $query;
              return $url_data['scheme'] . '://' . $url_data['host'] . (isset($url_data['port']) ? ':' . $url_data['port'] : '') . str_replace('/' . $page, '', rtrim($url_data['path'], '/')) . $result;
          }

      } else {
          return $link;
      }
  }

  /**
   * fetchFiles()
   * 
   * @return
   */
  function fetchFiles($directory)
  {
	  if (!is_dir($directory)) {
		  return false;
	  } else {
		  $file_array = array();
		  foreach (glob($directory."*.png") as $file) {
			  $file_array[] = basename($file);
		  }
		  return $file_array;
	  }
  }

  /**
   * numberToWords()
   * 
   * @param mixed $number
   * @return
   */
  function numberToWords($number)
  {
      $words = array(
          'zero',
          'one',
          'two',
          'three',
          'four',
          'five',
          'six',
          'seven',
          'eight',
          'nine',
          'ten',
          'eleven',
          'twelve',
          'thirteen',
          'fourteen',
          'fifteen',
          'sixteen',
          'seventeen',
          'eighteen',
          'nineteen',
          'twenty',
          30 => 'thirty',
          40 => 'fourty',
          50 => 'fifty',
          60 => 'sixty',
          70 => 'seventy',
          80 => 'eighty',
          90 => 'ninety',
          100 => 'hundred',
          1000 => 'thousand');
      $number_in_words = '';
      if (is_numeric($number)) {
          $number = (int)round($number);
          if ($number < 0) {
              $number = -$number;
              $number_in_words = 'minus ';
          }
          if ($number > 1000) {
              $number_in_words = $number_in_words . numberToWords(floor($number / 1000)) . " " . $words[1000];
              $hundreds = $number % 1000;
              $tens = $hundreds % 100;
              if ($hundreds > 100) {
                  $number_in_words = $number_in_words . ", " . numberToWords($hundreds);
              } elseif ($tens) {
                  $number_in_words = $number_in_words . " and " . numberToWords($tens);
              }
          } elseif ($number > 100) {
              $number_in_words = $number_in_words . numberToWords(floor($number / 100)) . " " . $words[100];
              $tens = $number % 100;
              if ($tens) {
                  $number_in_words = $number_in_words . " and " . numberToWords($tens);
              }
          } elseif ($number > 20) {
              $number_in_words = $number_in_words . " " . $words[10 * floor($number / 10)];
              $units = $number % 10;
              if ($units) {
                  $number_in_words = $number_in_words . numberToWords($units);
              }
          } else {
              $number_in_words = $number_in_words . " " . $words[$number];
          }
          return $number_in_words;
      }
      return false;
  }
  
  /**
   * phpself()
   * 
   * @return
   */
  function phpself()
  {
      return htmlspecialchars($_SERVER['PHP_SELF']);
  }
  
  /**
   * randName()
   * 
   * @return
   */ 
  function randName() {
	  $code = '';
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,999999999999999))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }
  
  /**
   * random_numbers()
   * 
   * @return
   */ 
  function random_numbers() {
	  $digits = 7;
	  $min = pow(10, $digits - 1);
	  $max = pow(10, $digits) - 1;
	  return mt_rand($min, $max);
  }
?>