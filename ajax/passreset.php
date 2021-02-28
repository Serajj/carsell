<?php
  /**
   * Password Reset
   *
   * @package Slim cms
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: passreset.php, v1.00 2012-03-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  if (isset($_POST['passReset'])) {

      if (empty($_POST['passReset']))
          Filter::$msgs['passReset'] = Lang::$word->EMAIL_R1;

      if (!empty($_POST['passReset'])) {
		  if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['passReset']))
			  Filter::$msgs['email'] = Lang::$word->EMAIL_R3;
	  }
	  
      if (empty(Filter::$msgs)) {

          $sender_email = sanitize($_POST['passReset']);
          $ip = sanitize($_SERVER['REMOTE_ADDR']);
		  $user = $db->first("SELECT * FROM " . Users::uTable . " WHERE email = '" . $db->escape($sender_email) . "'");

          if ($user) {
              $randpass = md5(uniqid(rand(), true));
              $trimpass = substr($randpass, 0, 10);
              $newpass = sha1($trimpass);

              $data['password'] = $newpass;
              $db->update(Users::uTable, $data, "id = '" . $user->id . "'");


              require_once (BASEPATH . "lib/class_mailer.php");
              $mailer = $mail->sendMail();

              $row = Core::getRowById(Content::eTable, 4);

			  $body = str_replace(
					array('[USERNAME]', '[PASSWORD]', '[URL]', '[LINK]', '[IP]', '[SITE_NAME]'), 
					array($user['username'], $randpass, SITEURL, SITEURL . '/admin/', $_SERVER['REMOTE_ADDR'], $core->site_name), $row->body
					);
					
			  $newbody = cleanOut($body);

              $msg = Swift_Message::newInstance()
					->setSubject($row->subject)
					->setTo(array($user->email => $user->username))
					->setFrom(array($core->site_email => $core->company))
					->setBody($newbody, 'text/html');

              if ($mailer->send($msg)) {
                  print 'Y';
              }
          } else {
              print 'N';
          }

      } else
          print Filter::msgStatus();
  }
?>