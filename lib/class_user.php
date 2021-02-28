<?php
  /**
   * User Class
   *
   * @package Business Directory Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: class_user.php, v1.00 2012-03-05 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Users
  {
      const uTable = "users";
      public $logged_in = null;
      public $uid = 0;
      public $username;
      public $sesid;
      public $email;
      public $name;
      public $userlevel;
	  public $last;
	  public $access = null;
      private $lastlogin = "NOW()";
      private static $db;

      /**
       * Users::__construct()
       * 
       * @return
       */
      function __construct()
      {
          self::$db = Registry::get("Database");
          $this->startSession();
      }


      /**
       * Users::startSession()
       * 
       * @return
       */
      private function startSession()
      {
          session_start();
          $this->logged_in = $this->loginCheck();

          if (!$this->logged_in) {
              $this->username = $_SESSION['CDP_username'] = "Guest";
              $this->sesid = sha1(session_id());
              $this->userlevel = 0;
          }
      }

      /**
       * Users::loginCheck()
       * 
       * @return
       */
      private function loginCheck()
      {
          if (isset($_SESSION['CDP_username']) && $_SESSION['CDP_username'] != "Guest") {

              $row = $this->getUserInfo($_SESSION['CDP_username']);
              $this->uid = $row->id;
              $this->username = $row->username;
              $this->email = $row->email;
              $this->name = $row->fname . ' ' . $row->lname;
              $this->userlevel = $row->userlevel;
			  $this->access = $row->access;
			  $this->last = $row->lastlogin;
              $this->sesid = sha1(session_id());
              return true;
          } else {
              return false;
          }
      }

      /**
       * Users::is_Admin()
       * 
       * @return
       */
      public function is_Admin()
      {
          return ($this->userlevel == 9 or $this->userlevel == 8);

      }

      /**
       * Users::login()
       * 
       * @param mixed $username
       * @param mixed $password
       * @return
       */
      public function login($username, $password)
      {
          if ($username == "" && $password == "") {
              Filter::$msgs['username'] = 'Please enter valid username and password';
          } else {
              $status = $this->checkStatus($username, $password);

              switch ($status) {
                  case 0:
                      Filter::$msgs['username'] = 'Login and/or password did not match to the database.';
                      break;

                  case 1:
                      Filter::$msgs['username'] = 'Your account has been banned.';
                      break;

                  case 2:
                      Filter::$msgs['username'] = 'Your account it\'s not activated.';
                      break;

                  case 3:
                      Filter::$msgs['username'] = 'You need to verify your email address.';
                      break;
              }
          }
          if (empty(Filter::$msgs) && $status == 5) {
              $row = $this->getUserInfo($username);
              $this->uid = $_SESSION['userid'] = $row->id;
              $this->username = $_SESSION['CDP_username'] = $row->username;
              $this->email = $_SESSION['email'] = $row->email;
              $this->userlevel = $_SESSION['userlevel'] = $row->userlevel;
			  $this->access = $_SESSION['access'] = $row->access;
			  $this->last = $_SESSION['last'] = $row->lastlogin;

              $data = array('lastlogin' => $this->lastlogin, 'lastip' => sanitize($_SERVER['REMOTE_ADDR']));
              self::$db->update(self::uTable, $data, "username='" . $this->username . "'");

              return true;
          } else
              Filter::msgStatus();
      }

      /**
       * Users::logout()
       * 
       * @return
       */
      public function logout()
      {
          unset($_SESSION['CDP_username']);
          unset($_SESSION['email']);
          unset($_SESSION['name']);
          unset($_SESSION['userid']);
          unset($_SESSION['uid']);
		  unset($_SESSION['access']);
          session_destroy();
          session_regenerate_id();

          $this->logged_in = false;
          $this->username = "Guest";
          $this->userlevel = 0;
      }

      /**
       * Users::getUserInfo()
       * 
       * @param mixed $username
       * @return
       */
      public function getUserInfo($username)
      {
          $username = sanitize($username);
          $username = self::$db->escape($username);

          $sql = "SELECT * FROM " . self::uTable . " WHERE username = '" . $username . "'";
          $row = self::$db->first($sql);
          if (!$username)
              return false;

          return ($row) ? $row : 0;
      }

      /**
       * Users::checkStatus()
       * 
       * @param mixed $username
       * @param mixed $password
       * @return
       */
      public function checkStatus($username, $password)
      {

          $username = sanitize($username);
          $username = self::$db->escape($username);
          $password = sanitize($password);

          $sql = "SELECT password, active FROM " . self::uTable . " WHERE username = '" . $username . "'";
          $result = self::$db->query($sql);

          if (self::$db->numrows($result) == 0)
              return 0;

          $row = self::$db->fetch($result);
          $entered_pass = sha1($password);

          switch ($row->active) {
              case "b":
                  return 1;
                  break;

              case "n":
                  return 2;
                  break;

              case "t":
                  return 3;
                  break;

              case "y" && $entered_pass == $row->password:
                  return 5;
                  break;
          }
      }

      /**
       * Users::getUsers()
       * 
       * @return
       */
      public function getUsers()
      {
		  
          $sql = "SELECT *, CONCAT(fname,' ',lname) as name,"
		  . "\n (SELECT COUNT(listings.id) FROM listings WHERE listings.user_id = users.id) as totalitems"
		  . "\n FROM " . self::uTable
		  . "\n ORDER BY created";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Users::processUser()
       * 
       * @return
       */
      public function processUser()
      {
          if (!Filter::$id) {
              Filter::checkPost('username', Lang::$word->USERNAME_R1);
              if ($value = $this->usernameExists($_POST['username'])) {
                  if ($value == 1)
                      Filter::$msgs['username'] = Lang::$word->USERNAME_R2;
                  if ($value == 2)
                      Filter::$msgs['username'] = Lang::$word->USERNAME_R3;
                  if ($value == 3)
                      Filter::$msgs['username'] = Lang::$word->USERNAME_R4;
              }
          }

          Filter::checkPost('fname', Lang::$word->FNAME);
          Filter::checkPost('lname', Lang::$word->LNAME);

          if (!Filter::$id) {
              Filter::checkPost('password', Lang::$word->PASSWORD_R1);
          }

          Filter::checkPost('email', Lang::$word->EMAIL_R1);
          if (!Filter::$id) {
              if ($this->emailExists($_POST['email']))
                  Filter::$msgs['email'] = Lang::$word->EMAIL_R2;
          }
          if (!$this->isValidEmail($_POST['email']))
              Filter::$msgs['email'] = Lang::$word->EMAIL_R3;

          if (empty(Filter::$msgs)) {

              $data = array(
					'username' => sanitize($_POST['username']), 
					'email' => sanitize($_POST['email']), 
					'lname' => sanitize($_POST['lname']), 
					'fname' => sanitize($_POST['fname']), 
					'userlevel' => intval($_POST['userlevel']),
					'active' => sanitize($_POST['active'])
			  );

			  if (isset($_POST['access'])) {	  
				  if (is_array($_POST['access'])) {
					  $data['access'] = Content::_implodeFields($_POST['access']);
				  }
			  } else {
				  $data['access'] = 0;
			  }
				  
              if (!Filter::$id)
                  $data['created'] = "NOW()";

              if (Filter::$id)
                  $userrow = Registry::get("Core")->getRowById(self::uTable, Filter::$id);

              if ($_POST['password'] != "") {
                  $data['password'] = sha1($_POST['password']);
              } else
                  $data['password'] = $userrow->password;

              (Filter::$id) ? self::$db->update(self::uTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::uTable, $data);
              $message = (Filter::$id) ? Lang::$word->USR_UPDATED : Lang::$word->USR_ADDED;

			  if(self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);

			  if (isset($_POST['notify']) && intval($_POST['notify']) == 1) {
				  require_once(BASEPATH . "lib/class_mailer.php");
				  $mailer = $mail->sendMail();	
							  
				  $row = Registry::get("Core")->getRowById(Content::eTable, 1);
				  $body = str_replace(array('[NAME]', '[SITE_NAME]', '[USERNAME]', '[PASSWORD]', '[URL]'), 
				  array($data['fname'] . ' ' . $data['lname'], Registry::get("Core")->site_name, $data['username'], $_POST['password'], SITEURL), $row->body);
		
				  $msg = Swift_Message::newInstance()
							->setSubject($row->subject)
							->setTo(array($data['email'] => $data['fname'].' '.$data['lname']))
							->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
							->setBody(cleanOut($body), 'text/html');
							
				   $mailer->send($msg);
			  }
				  
          } else {
              $json['message'] = Filter::msgStatus();
              print json_encode($json);
          }
      }

      /**
       * Users::getLocationList()
       * 
       * @param bool $list
       * @return
       */
	  public function getLocationList($list = false)
	  {
		  $sqldata = self::$db->fetch_all("SELECT id, name FROM " . Content::lcTable . " ORDER BY name");
	
		  if ($list) {
			  $arr = explode(",", $list);
			  reset($arr);
		  }
		  $data = '';
		  if ($sqldata) {
			  $data .= '<select name="access[]" title="Choose a location(s)..."  multiple="multiple" class="custombox" style="width:350px">';
			  foreach ($sqldata as $val) {
				  if ($list) {
					  $selected = (in_array($val->id, $arr)) ? " selected=\"selected\"" : "";
				  } else {
					  $selected = null;
				  }
				  $data .= "<option $selected value=\"" . $val->id . "\">" . $val->name . "</option>\n";
	
			  }
			  unset($val);
			  $data .= "</select>";
	
			  return $data;
		  }
	  }
		  
      /**
       * Users::getPermissionList()
       * 
       * @param bool $access
       * @return
       */
	  public function getPermissionList($access = false)
	  {
		  
		  $plugdata = self::$db->fetch_all("SELECT title, plugalias  FROM plugins WHERE hasconfig = '1'");
		  
		  $data = '';
		  
		  if ($access) {
			  $arr = explode(",", $access);
			  reset($arr);
		  }
		  
		  $data .= '<select name="access[]" size="10" multiple="multiple" class="select" style="width:250px">';
		  foreach (self::getPermissionValues() as $key => $val) {
			  if ($access && $arr) {
				  $selected = (in_array($key, $arr)) ? " selected=\"selected\"" : "";
			  } else 
				  $selected = null;
			  $data .= "<option $selected value=\"" . $key . "\">" . $val . "</option>\n";
		  }
		  unset($val);

          if($plugdata) {
			  $data .= "<optgroup label=\"".lang('M_PLUGINS')."\">\n";
			foreach ($plugdata as $pval) {
				if ($access && $arr) {
					$selected = (in_array($pval->plugalias, $arr)) ? " selected=\"selected\"" : "";
				} else 
					$selected = null;
				$data .= "<option $selected value=\"" . $pval->plugalias . "\">-- " . $pval->title . "</option>\n";
			}
			  $data .= "</optgroup>\n";
			unset($pval);
		  }
		  		  
		  $data .= "</select>";
		  $data .= "&nbsp;&nbsp;";
		  $data .= tooltip(lang('USR_ACCESS_T'));
		  
		  return $data;
	  }
	  
	  /**
	   * Users::getAcl()
	   * 
	   * @param string $content
	   * @return
	   */
	  public function getAcl($content)
	  {
		  if ($this->userlevel == 8) {
			  $arr = explode(",", $this->access);
			  reset($arr);
			  
			  if (in_array($content, $arr)) {
				  return true;
			  } else
				  return false;
		  } else
			  return true;
	  }
	  
      /**
       * Users::getPermissionValues()
       * 
       * @return
       */
      private static function getPermissionValues()
	  {
		  $arr = array(
				 'Menus' => lang('M_MENUS'),
				 'Content' => lang('M_CONTENT'),
				 'Article' => lang('M_ARTICLE'),
				 'News' => lang('M_NEWS'),
				 'Page' => lang('M_PAGE'),
				 'Layout' =>  lang('M_LAYOUT'),
				 'Users' =>  lang('M_USERS'),
				 'Config' =>  lang('M_CONF'),
				 'FM' =>  lang('M_FILEM'),
				 'Backup' =>  lang('M_DATABASE'),
				 'Plugins' =>  lang('M_PLUGINS')
		  );

		  return $arr;
	  } 
	  
      /**
       * Users::usernameExists()
       * 
       * @param mixed $username
       * @return
       */
      private function usernameExists($username)
      {
          $username = sanitize($username);
          if (strlen(self::$db->escape($username)) < 4)
              return 1;
			  
          //Username should contain only alphabets, numbers, underscores or hyphens.Should be between 4 to 15 characters long
		  $valid_uname = "/^[a-z0-9_-]{4,15}$/"; 
          if (!preg_match($valid_uname, $username))
              return 2;

          $sql = self::$db->query("SELECT username FROM " . self::uTable . " WHERE username = '" . $username . "' LIMIT 1");
          $count = self::$db->numrows($sql);

          return ($count > 0) ? 3 : false;
      }

      /**
       * Users::emailExists()
       * 
       * @param mixed $email
       * @return
       */
      private function emailExists($email)
      {
		  $email = self::$db->escape($email);
          $sql = self::$db->query("SELECT email FROM " . self::uTable . " WHERE email = '" . sanitize($email) . "' LIMIT 1");

          if (self::$db->numrows($sql) == 1) {
              return true;
          } else
              return false;
      }

      /**
       * Users::isValidEmail()
       * 
       * @param mixed $email
       * @return
       */
      private function isValidEmail($email)
      {
          if (function_exists('filter_var')) {
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return true;
              } else
                  return false;
          } else
              return preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email);
      }

      /**
       * Users::getUniqueCode()
       * 
       * @param string $length
       * @return
       */
      private function getUniqueCode($length = "")
      {
          $code = md5(uniqid(rand(), true));
          if ($length != "") {
              return substr($code, 0, $length);
          } else
              return $code;
      }

      /**
       * Users::generateRandID()
       * 
       * @return
       */
      private function generateRandID()
      {
          return sha1($this->getUniqueCode(24));
      }
  }

?>