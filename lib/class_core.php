<?php
  /**
   * Core Class
   *
   * @package Business Directory Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: class_core.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Core
  {
      const sTable = "settings";
      public $year = null;
      public $month = null;
      public $day = null;
	  
      /**
       * Core::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          $this->getSettings();
		  
          ($this->dtz) ? date_default_timezone_set($this->dtz) : date_default_timezone_set('GMT');

          $this->year = (get('year')) ? sanitize(get('year'),4,true) : strftime('%Y');
          $this->month = (get('month')) ? sanitize(get('month'),2,true) : strftime('%m');
          $this->day = (get('day')) ? sanitize(get('day'),2,true) : strftime('%d');

          return mktime(0, 0, 0, $this->month, $this->day, $this->year);
      }

	        
      /**
       * Core::getSettings()
       *
       * @return
       */
      private function getSettings()
      {
          $sql = "SELECT * FROM " . self::sTable;
          $row = Registry::get("Database")->first($sql);
          
          $this->site_name = $row->site_name;
		  $this->company = $row->company;
          $this->site_url = $row->site_url;
		  $this->site_dir = $row->site_dir;
		  $this->site_email = $row->site_email;
          $this->address = $row->address;
          $this->city = $row->city;
          $this->state = $row->state;
          $this->zip = $row->zip;
          $this->phone = $row->phone;
          $this->fax = $row->fax;
		  $this->logo = $row->logo;
		  $this->fb = $row->fb;
		  $this->twitter = $row->twitter;
		  $this->offline = $row->offline;
		  $this->offline_d = $row->offline_d;
		  $this->offline_t = $row->offline_t;
		  $this->offline_msg = $row->offline_msg;
		  $this->ipp = $row->ipp;
		  $this->theme = $row->theme;
		  $this->featured = $row->featured;
		  $this->odometer = $row->odometer;
		  $this->notify_admin = $row->notify_admin;
		  $this->dtz = $row->dtz;
		  $this->locale = $row->locale;
		  $this->short_date = $row->short_date;
		  $this->long_date = $row->long_date;
		  $this->lang = $row->lang;
		  $this->currency = $row->currency;
		  $this->cur_symbol = $row->cur_symbol;
		  $this->tsep = $row->tsep;
		  $this->dsep = $row->dsep;
		  $this->dbbackup = $row->dbbackup;
          $this->metakeys = $row->metakeys;
		  $this->metadesc = $row->metadesc;
		  $this->mailer = $row->mailer;
		  $this->sendmail = $row->sendmail;
		  $this->smtp_host = $row->smtp_host;
		  $this->smtp_user = $row->smtp_user;
		  $this->smtp_pass = $row->smtp_pass;
		  $this->smtp_port = $row->smtp_port;
		  $this->is_ssl = $row->is_ssl;
		  $this->analytics = $row->analytics;
		  $this->metakeys = $row->metakeys;
		  $this->metadesc = $row->metadesc;
		  
		  $this->minprice = $row->minprice;
		  $this->maxprice = $row->maxprice;
		  $this->minsprice = $row->minsprice;
		  $this->maxsprice = $row->maxsprice;
		  $this->minyear = $row->minyear;
		  $this->maxyear = $row->maxyear;
		  $this->minkm = $row->minkm;
		  $this->maxkm = $row->maxkm;
		  $this->colour = $row->colour;
	  
		  $this->ver = $row->ver;

      }

      /**
       * Core::updateSetup()
       * 
       * @return
       */
	  public function processConfig()
	  {
		  
		  Filter::checkPost('site_name',Lang::$word->CONF_SITE);
		  Filter::checkPost('company',Lang::$word->CONF_COMPANY);
		  Filter::checkPost('site_url',Lang::$word->CONF_URL);
		  Filter::checkPost('site_email',Lang::$word->CONF_EMAIL);
		  Filter::checkPost('ipp',Lang::$word->CONF_IPP);
		  Filter::checkPost('featured',Lang::$word->CONF_FEATURED);
		  Filter::checkPost('currency',Lang::$word->CONF_CURRENCY);
		  Filter::checkPost('cur_symbol',Lang::$word->CONF_CURSYMBOL);

          switch($_POST['mailer']) {
			  case "SMTP" :
			      Filter::checkPost('smtp_host',Lang::$word->CONF_SMTP_HOST);
				  Filter::checkPost('smtp_user',Lang::$word->CONF_SMTP_USER);
				  Filter::checkPost('smtp_pass',Lang::$word->CONF_SMTP_PASS);
				  Filter::checkPost('smtp_port',Lang::$word->CONF_SMTP_PORT);
				  break;
			  
			  case "SMAIL" :
			      Filter::checkPost('sendmail',Lang::$word->CONF_SMAILPATH);
			  break;
		  }
		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
					  'site_name' => sanitize($_POST['site_name']), 
					  'company' => sanitize($_POST['company']),
					  'site_url' => sanitize($_POST['site_url']),
					  'site_dir' => sanitize($_POST['site_dir']),
					  'site_email' => sanitize($_POST['site_email']),
					  'address' => sanitize($_POST['address']),
					  'city' => sanitize($_POST['city']),
					  'state' => sanitize($_POST['state']),
					  'zip' => sanitize($_POST['zip']),
					  'phone' => sanitize($_POST['phone']),
					  'fax' => sanitize($_POST['fax']),
					  'fb' => sanitize($_POST['fb']),
					  'twitter' => sanitize($_POST['twitter']),
					  'ipp' => intval($_POST['ipp']),
					  'featured' => intval($_POST['featured']),
					  'odometer' => sanitize($_POST['odometer']),
					  'offline' => intval($_POST['offline']),
					  'offline_d' => sanitize($_POST['offline_d']),
					  'offline_t' => sanitize($_POST['offline_t']),
					  'offline_msg' => sanitize($_POST['offline_msg']),
					  'dtz' => trim($_POST['dtz']),
					  'locale' => trim($_POST['locale']),
					  'short_date' => sanitize($_POST['short_date']),
					  'long_date' => sanitize($_POST['long_date']),	
					  'lang' => sanitize($_POST['lang']),
					  'currency' => sanitize($_POST['currency']),
					  'cur_symbol' => sanitize($_POST['cur_symbol']),	
					  'dsep' => sanitize($_POST['dsep']),
					  'tsep' => sanitize($_POST['tsep']),					  
					  'mailer' => trim($_POST['mailer']),
					  'sendmail' => sanitize($_POST['sendmail']),
					  'smtp_host' => sanitize($_POST['smtp_host']),
					  'smtp_user' => sanitize($_POST['smtp_user']),
					  'smtp_pass' => sanitize($_POST['smtp_pass']),
					  'smtp_port' => intval($_POST['smtp_port']),
					  'is_ssl' => intval($_POST['is_ssl']),
					  'metadesc' => trim($_POST['metadesc']),
					  'metakeys' => trim($_POST['metakeys']),
					  'analytics' => sanitize($_POST['analytics'])
			  );

              if (isset($_POST['dellogo']) and $_POST['dellogo'] == 1) {
				  $data['logo'] = "NULL";
			  } elseif (!empty($_FILES['logo']['name'])) {
				  if ($this->logo) {
					  @unlink(UPLOADS . $this->logo);
				  }
					  move_uploaded_file($_FILES['logo']['tmp_name'], UPLOADS . $_FILES['logo']['name']);

				  $data['logo'] = sanitize($_FILES['logo']['name']);
			  } else {
				$data['logo'] = $this->logo;
			  }
			  
			  Registry::get("Database")->update(self::sTable, $data);
			  
			  if(Registry::get("Database")->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->CONF_UPDATED, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
      }
	   	  	  	   	  	  
      /**
       * Core::getShortDate()
       * 
       * @return
       */ 
      public function getShortDate()
      {
          $arr = array(
				 '%m-%d-%Y' => '12-21-2009 (MM-DD-YYYY)',
				 '%e-%m-%Y' => '21-12-2009 (D-MM-YYYY)',
				 '%m-%e-%y' => '12-21-09 (MM-D-YY)',
				 '%e-%m-%y' => '21-12-09 (D-MMM-YY)',
				 '%d %b %Y' => 'Dec 21 2009'
		  );

          $shortdate = '';
          foreach ($arr as $key => $val) {
              if ($key == $this->short_date) {
                  $shortdate .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $shortdate .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $shortdate;
      }
	  
      /**
       * Core::getLongDate()
       * 
       * @return
       */ 	  
      public function getLongDate()
      {
          $arr = array(
				'%B %d, %Y %I:%M %p' => 'December 21, 2009 04:00 am/pm',
				'%d %B %Y %I:%M %p' => '21 December 2009 04:00 am/pm',
				'%B %d, %Y' => 'December 21, 2009',
				'%d %B, %Y' => '21 December, 2009',
				'%A %d %B %Y' => 'Monday 21 December, 2009',
				'%A %d %B %Y %H:%M' => 'Monday 21 December 2009 07:00',
				'%a %d, %B' => 'Mon. 12, December'
		  );

          $longdate = '';
          foreach ($arr as $key => $val) {
              if ($key == $this->long_date) {
                  $longdate .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $longdate .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $longdate;
      }

      /**
       * Core::weekList()
       * 
       * @return
       */
      public function weekList()
      {
          $arr = array(
		          '1' => 'Sunday', 
		          '2' => 'Monday', 
		          '3' => 'Tuesday', 
		          '4' => 'Wednesday', 
		          '5' => 'Thursday', 
		          '6' => 'Friday', 
		          '7' => 'Saturday'
          );

          $weeklist = '';
          foreach ($arr as $key => $val) {
              $weeklist .= "<option value=\"$key\"";
              $weeklist .= ($key == $this->weekstart) ? ' selected="selected"' : '';
              $weeklist .= ">$val</option>\n";
          }
          unset($val);
          return $weeklist;
      }
	  
      /**
       * Core::monthList()
       * 
       * @return
       */ 	  
      public function monthList()
	  {
		  $arr = array(
				'01' => 'January',
				'02' => 'February',
				'03' => 'March',
				'04' => 'April',
				'05' => 'May',
				'06' => 'June',
				'07' => 'July',
				'08' => 'August',
				'09' => 'September',
				'10' => 'October',
				'11' => 'November',
				'12' => 'December'
		  );
		  
		  $monthlist = '';
		  foreach ($arr as $key => $val) {
			  $monthlist .= "<option value=\"$key\"";
			  $monthlist .= ($key == $this->month) ? ' selected="selected"' : '';
			  $monthlist .= ">$val</option>\n";
          }
          unset($val);
          return $monthlist;
      }

      /**
       * Core::yearList()
	   *
       * @param mixed $start_year
       * @param mixed $end_year
	   * @param boll $selected
       * @return
       */
	  public function yearList($start_year, $end_year, $sort = "DESC", $selected = false)
	  {
		  $r = range($start_year, $end_year);
		  ($sort == "DESC") ? arsort($r) : asort($r);
		  $select = '';
		  foreach ($r as $year) {
			  $select .= "<option value=\"$year\"";
			  $select .= ($year == $selected) ? ' selected="selected"' : '';
			  $select .= ">$year</option>\n";
		  }
		  return $select;
	  }
	  

      /**
       * Core::getNumbers()
       * 
       * @return
       */ 	  
      public function getNumbers($selected = false)
	  {
		  $num = '';
		  for ($i = 0; $i <= 10; $i++) {
			  $sel = ($selected && $i == $selected) ? " selected=\"selected\"" : "" ;
              $num .= "<option value=\"" . $i . "\"" . $sel . ">" . $i . "</option>\n";
          }
          return $num;
      }
	  	  

      /**
       * Core::getTimezones()
       * 
       * @return
       */
	  public function getTimezones()
	  {
		  $html = '';
		  $tzone = DateTimeZone::listIdentifiers();
		  $html .='<select name="dtz">';
		  foreach ($tzone as $zone) {
			  $selected = ($zone == $this->dtz) ? ' selected="selected"' : '';
			  $html .= '<option value="' . $zone . '"' . $selected . '>' . $zone . '</option>';
		  }
		  $html .='</select>';
		  return $html;
	  }

      /**
       * Core::getDropList()
       * 
	   * @param array $array
	   * @param string $name
	   * @param string $sel
	   * @param int $width
	   * @param int $text
       * @return
       */
	  public function getDropList($array, $name, $sel, $text)
	  {
		  if($array) {
			  $html = '';
			  $html .='<select name="' . $name . '" id="droplist-' . $name . '">';
			  $html .= '<option value="">--- ' . $text . ' ---</option>';
			  foreach ($array as $data) {
				  $selected = ($sel == $data->id) ? ' selected="selected"' : '';
				  $html .= '<option value="' . $data->id . '"' . $selected . '>' . $data->name . '</option>';
			  }
			  $html .='</select>';
			  return $html;
		  }
	  }
	  
	  /**
	   * Core::formatMoney()
	   * 
	   * @param mixed $amount
	   * @return
	   */
	  public function formatMoney($amount)
	  {
		  return $this->cur_symbol . number_format($amount, 0, $this->dsep, $this->tsep) . ' ' . $this->currency;
	  }

	  /**
	   * Core::has()
	   * 
	   * @param mixed $value
	   * @return
	   */
	  public static function has($value)
	  {
		  return ($value) ? $value : '-/-';
	  }
	  		  
      /**
       * getRowById()
       * 
       * @param mixed $table
       * @param mixed $id
       * @param bool $and
       * @param bool $is_admin
       * @return
       */
      public static function getRowById($table, $id, $and = false, $is_admin = true)
      {
          $id = sanitize($id, 8, true);
          if ($and) {
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "' AND " . Registry::get("Database")->escape($and) . "";
          } else
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "'";

          $row = Registry::get("Database")->first($sql);

          if ($row) {
              return $row;
          } else {
              if ($is_admin)
                  Filter::error("You have selected an Invalid Id - #" . $id, "Core::getRowById()");
          }
      }

      /**
       * Core::setLocalet()
       * 
       * @return
       */
	  public function setLocale()
	  {
		  return explode(',', $this->locale);
	  }
	  
      /**
       * Core::getlocaleList()
       * 
       * @return
       */
      public function getlocaleList()
      {
          $html = '';
          foreach (self::localeList() as $key => $val) {
              if ($key == $this->locale) {
                  $html .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $html .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $html;
      }
	  
      /**
       * Core::localeList()
       * 
       * @return
       */
	  public static function localeList()
	  {
	
		  $lang = array(
			  "af_utf8,Afrikaans,af_ZA.UTF-8,Afrikaans_South Africa.1252,WINDOWS-1252" => "Afrikaans",
			  "sq_utf8,Albanian,sq_AL.UTF-8,Albanian_Albania.1250,WINDOWS-1250" => "Albanian",
			  "ar_utf8,Arabic,ar_SA.UTF-8,Arabic_Saudi Arabia.1256,WINDOWS-1256" => "Arabic",
			  "eu_utf8,Basque,eu_ES.UTF-8,Basque_Spain.1252,WINDOWS-1252" => "Basque",
			  "be_utf8,Belarusian,be_BY.UTF-8,Belarusian_Belarus.1251,WINDOWS-1251" => "Belarusian",
			  "bs_utf8,Bosnian,bs_BA.UTF-8,Serbian (Latin),WINDOWS-1250" => "Bosnian",
			  "bg_utf8,Bulgarian,bg_BG.UTF-8,Bulgarian_Bulgaria.1251,WINDOWS-1251" => "Bulgarian",
			  "ca_utf8,Catalan,ca_ES.UTF-8,Catalan_Spain.1252,WINDOWS-1252" => "Catalan",
			  "hr_utf8,Croatian,hr_HR.UTF-8,Croatian_Croatia.1250,WINDOWS-1250" => "Croatian",
			  "zh_cn_utf8,Chinese (Simplified),zh_CN.UTF-8,Chinese_China.936" => "Chinese (Simplified)",
			  "zh_tw_utf8,Chinese (Traditional),zh_TW.UTF-8,Chinese_Taiwan.950" => "Chinese (Traditional)",
			  "cs_utf8,Czech,cs_CZ.UTF-8,Czech_Czech Republic.1250,WINDOWS-1250" => "Czech",
			  "da_utf8,Danish,da_DK.UTF-8,Danish_Denmark.1252,WINDOWS-1252" => "Danish",
			  "nl_utf8,Dutch,nl_NL.UTF-8,Dutch_Netherlands.1252,WINDOWS-1252" => "Dutch",
			  "en_utf8,English,en.UTF-8,English_Australia.1252," => "English(Australia)",
			  "en_us_utf8,English (US)" => "English",
			  "et_utf8,Estonian,et_EE.UTF-8,Estonian_Estonia.1257,WINDOWS-1257" => "Estonian",
			  "fa_utf8,Farsi,fa_IR.UTF-8,Farsi_Iran.1256,WINDOWS-1256" => "Farsi",
			  "fil_utf8,Filipino,ph_PH.UTF-8,Filipino_Philippines.1252,WINDOWS-1252" => "Filipino",
			  "fi_utf8,Finnish,fi_FI.UTF-8,Finnish_Finland.1252,WINDOWS-1252" => "Finnish",
			  "fr_utf8,French,fr_FR.UTF-8,French_France.1252,WINDOWS-1252" => "French",
			  "fr_ca_utf8,French (Canada),fr_FR.UTF-8,French_Canada.1252" => "French (Canada)",
			  "ga_utf8,Gaelic,ga.UTF-8,Gaelic; Scottish Gaelic,WINDOWS-1252" => "Gaelic",
			  "gl_utf8,Gallego,gl_ES.UTF-8,Galician_Spain.1252,WINDOWS-1252" => "Gallego",
			  "ka_utf8,Georgian,ka_GE.UTF-8,Georgian_Georgia.65001" => "Georgian",
			  "de_utf8,German,de_DE.UTF-8,German_Germany.1252,WINDOWS-1252" => "German",
			  "el_utf8,Greek,el_GR.UTF-8,Greek_Greece.1253,WINDOWS-1253" => "Greek",
			  "gu_utf8,Gujarati,gu.UTF-8,Gujarati_India.0" => "Gujarati",
			  "he_utf8,Hebrew,he_IL.utf8,Hebrew_Israel.1255,WINDOWS-1255" => "Hebrew",
			  "hi_utf8,Hindi,hi_IN.UTF-8,Hindi.65001" => "Hindi",
			  "hu_utf8,Hungarian,hu.UTF-8,Hungarian_Hungary.1250,WINDOWS-1250" => "Hungarian",
			  "is_utf8,Icelandic,is_IS.UTF-8,Icelandic_Iceland.1252,WINDOWS-1252" => "Indonesian",
			  "id_utf8,Indonesian,id_ID.UTF-8,Indonesian_indonesia.1252,WINDOWS-1252" => "Indonesian",
			  "it_utf8,Italian,it_IT.UTF-8,Italian_Italy.1252,WINDOWS-1252" => "Italian",
			  "ja_utf8,Japanese,ja_JP.UTF-8,Japanese_Japan.932" => "Japanese",
			  "kn_utf8,Kannada,kn_IN.UTF-8,Kannada.65001" => "Kannada",
			  "km_utf8,Khmer,km_KH.UTF-8,Khmer.65001" => "Khmer",
			  "ko_utf8,Korean,ko_KR.UTF-8,Korean_Korea.949" => "Korean",
			  "lo_utf8,Lao,lo_LA.UTF-8,Lao_Laos.UTF-8,WINDOWS-1257" => "Lao",
			  "lt_utf8,Lithuanian,lt_LT.UTF-8,Lithuanian_Lithuania.1257,WINDOWS-1257" => "Lithuanian",
			  "lv_utf8,Latvian,lat.UTF-8,Latvian_Latvia.1257,WINDOWS-1257" => "Latvian",
			  "ml_utf8,Malayalam,ml_IN.UTF-8,Malayalam_India.x-iscii-ma" => "Malayalam",
			  "ms_utf8,Malaysian,ms_MY.UTF-8,Malay_malaysia.1252,WINDOWS-1252" => "Malaysian",
			  "mi_tn_utf8,Maori (Ngai Tahu),mi_NZ.UTF-8,Maori.1252,WINDOWS-1252" => "Maori (Ngai Tahu)",
			  "mi_wwow_utf8,Maori (Waikoto Uni),mi_NZ.UTF-8,Maori.1252,WINDOWS-1252" => "Maori (Waikoto Uni)",
			  "mn_utf8,Mongolian,mn.UTF-8,Cyrillic_Mongolian.1251" => "Mongolian",
			  "no_utf8,Norwegian,no_NO.UTF-8,Norwegian_Norway.1252,WINDOWS-1252" => "Norwegian",
			  "nn_utf8,Nynorsk,nn_NO.UTF-8,Norwegian-Nynorsk_Norway.1252,WINDOWS-1252" => "Nynorsk",
			  "pl_utf8,Polish,pl.UTF-8,Polish_Poland.1250,WINDOWS-1250" => "Polish",
			  "pt_utf8,Portuguese,pt_PT.UTF-8,Portuguese_Portugal.1252,WINDOWS-1252" => "Portuguese",
			  "pt_br_utf8,Portuguese (Brazil),pt_BR.UTF-8,Portuguese_Brazil.1252,WINDOWS-1252" => "Portuguese (Brazil)",
			  "ro_utf8,Romanian,ro_RO.UTF-8,Romanian_Romania.1250,WINDOWS-1250" => "Romanian",
			  "ru_utf8,Russian,ru_RU.UTF-8,Russian_Russia.1251,WINDOWS-1251" => "Russian",
			  "sm_utf8,Samoan,mi_NZ.UTF-8,Maori.1252,WINDOWS-1252" => "Samoan",
			  "sr_utf8,Serbian,sr_CS.UTF-8,Serbian (Cyrillic)_Serbia and Montenegro.1251,WINDOWS-1251" => "Serbian",
			  "sk_utf8,Slovak,sk_SK.UTF-8,Slovak_Slovakia.1250,WINDOWS-1250" => "Slovak",
			  "sl_utf8,Slovenian,sl_SI.UTF-8,Slovenian_Slovenia.1250,WINDOWS-1250" => "Slovenian",
			  "so_utf8,Somali,so_SO.UTF-8" => "Somali",
			  "es_utf8,Spanish (International),es_ES.UTF-8,Spanish_Spain.1252,WINDOWS-1252" => "Spanish",
			  "sv_utf8,Swedish,sv_SE.UTF-8,Swedish_Sweden.1252,WINDOWS-1252" => "Swedish",
			  "tl_utf8,Tagalog,tl.UTF-8" => "Tagalog",
			  "ta_utf8,Tamil,ta_IN.UTF-8,English_Australia.1252" => "Tamil",
			  "th_utf8,Thai,th_TH.UTF-8,Thai_Thailand.874,WINDOWS-874" => "Thai",
			  "to_utf8,Tongan,mi_NZ.UTF-8',Maori.1252,WINDOWS-1252" => "Tongan",
			  "tr_utf8,Turkish,tr_TR.UTF-8,Turkish_Turkey.1254,WINDOWS-1254" => "Turkish",
			  "uk_utf8,Ukrainian,uk_UA.UTF-8,Ukrainian_Ukraine.1251,WINDOWS-1251" => "Ukrainian",
			  "vi_utf8,Vietnamese,vi_VN.UTF-8,Vietnamese_Viet Nam.1258,WINDOWS-1258" => "Vietnamese",
			  );
	
		  return $lang;
	  }

      /**
       * Core::getPriceRange()
       * 
       * @return
       */
      public function getPriceRange()
      {
		  $mindata = ($this->minsprice) ? $this->minsprice : $this->minprice;
		  $maxdata = ($this->maxsprice) ? $this->maxsprice : $this->maxprice;

		  return $mindata . '; ' .$maxdata;
      }
	  
  }
?>