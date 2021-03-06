<?php
  /**
   * Controller
   *
   * @package Slim cms
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: controller.php, v1.00 2012-03-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("../init.php");
?>
<?php
  /* == Live Search == */
  if (isset($_POST['liveSearch'])):
      $string = sanitize($_POST['liveSearch'], 15);

      if (strlen($string) >= 3):
          $sql = $db->query("SELECT id, idx, title, body, year, slug" 
		  . " \n FROM " . Content::lTable . " WHERE title LIKE '%" . $db->escape($string) . "%'" 
		  . " \n ORDER BY id LIMIT 10");

          $html = '';
          $html .= '<div id="searchresults"><div class="searchresults-wrapper">';
          $i = 0;
          $color1 = "search-even";
          $color2 = "search-odd";
          while ($row = $db->fetch($sql)):
              $i++;
              $title = cleanSanitize($row->title, 30);
              $body = cleanOut($row->body);
              $content = sanitize($body, 80);
              $html .= '<div class="' . (($i % 2 == 0) ? $color1 : $color2) . '"><a href="' . doUrl($row->idx, $row->slug, "item") . '">' . $row->year . ' ' . $title . '<small>' . $content . '...</small></a></div>';
          endwhile;
          $html .= '</div></div>';
          print $html;
      endif;
  endif;

?>
<?php
  /* == Load Make List == */
  if (isset($_POST['makelist'])):
      $html = "";
      $id = intval($_POST['makelist']);

      $sql = "SELECT m.*" 
	  . "\n FROM " . Content::mdTable . " as m" 
	  . "\n LEFT JOIN " . Content::lTable . " AS l ON l.model_id = m.id" 
	  . "\n WHERE m.make_id = $id AND l.status = 1" 
	  . "\n GROUP BY m.id ORDER BY m.name";
      $result = $db->fetch_all($sql);

      if ($result):
          $html .= "<option value=\"\">--- " . Lang::$word->ALL . " ---</option>\n";
          foreach ($result as $row):
              $html .= "<option value=\"" . $row->id . "\">" . $row->name . "</option>\n";
          endforeach;
          unset($row);
      else:
          $html .= "<option value=\"\">--- " . Lang::$word->MAKE_NAME_R . " ---</option>\n";
      endif;
      print $html;
  endif;
?>
<?php
  /* == Newsletter == */
  if (isset($_POST['subscribe'])):
      Filter::checkPost("email", Lang::$word->WDG_CF_EMAIL);

      if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['email']))
          Filter::$msgs['email'] = Lang::$word->EMAIL_R3;

      Filter::checkPost("action", Lang::$word->SUBSC_ERR2);

      if (empty(Filter::$msgs)):
          $uemail = sanitize($_POST['email']);
          $email = getValue("email", Content::nlTable, "email = '" . $uemail . "'");

          if ($_POST['action'] == 'y'):
              if ($email):
                  $json['type'] = 'error';
                  $json['message'] = Filter::msgAlert(Lang::$word->SUBSC_ERR1, false);
              else:
                  $data['email'] = $uemail;
                  $db->insert(Content::nlTable, $data);
                  $json['type'] = 'success';
                  $json['message'] = Filter::msgOk(Lang::$word->SUBSC_MSG1, false);
              endif;

          else:
			  if ($email):
				  $db->delete(Content::nlTable, "email = '" . $uemail . "'");
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->SUBSC_MSG2, false);
			  else:
				  $json['type'] = 'error';
				  $json['message'] = Filter::msgAlert(Lang::$word->SUBSC_ERR3, false);
			  endif;
          endif;
          print json_encode($json);

	  else:
		  $json['message'] = Filter::msgStatus();
		  print json_encode($json);
	  endif;
  endif;
?>
<?php
  /* == Main Contact Form == */
  if (isset($_POST['main_contact'])):
  
      Filter::checkPost("name", Lang::$word->WDG_CF_NAME);
      Filter::checkPost("email", Lang::$word->WDG_CF_EMAIL);
	  Filter::checkPost("message", Lang::$word->WDG_CF_MSG);
	  Filter::checkPost("subject", Lang::$word->WDG_CF_SUB);
	  
      if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['email']))
          Filter::$msgs['email'] = Lang::$word->EMAIL_R3;
		  
      if (empty(Filter::$msgs)) :
          
          $sender_email = sanitize($_POST['email']);
          $name = sanitize($_POST['name']);
          $message = strip_tags($_POST['message']);
		  $subject = sanitize($_POST['subject']);
		  $ip = sanitize($_SERVER['REMOTE_ADDR']);
		  
		  $title = (isset($_POST['title'])) ? sanitize($_POST['title']) : null;
		  $to = (isset($_POST['toemail'])) ? sanitize($_POST['toemail']) : $core->site_email;
		  
		  require_once (BASEPATH . "lib/class_mailer.php");
		  $mailer = $mail->sendMail();
	  
		  $row = Core::getRowById(Content::eTable, 2);

		  $body = str_replace(
				array('[SENDER]', '[NAME]', '[MAILSUBJECT]', '[IP]', '[MESSAGE]'), 
				array($sender_email, $title . ' ' . $name, $subject, $_SERVER['REMOTE_ADDR'], $message), $row->body
				);
				
		  $newbody = cleanOut($body);
		  
		  $msg = Swift_Message::newInstance()
				  ->setSubject($row->subject)
				  ->setTo(array($to => $core->site_name))
				  ->setFrom(array($sender_email => $name))
				  ->setBody($newbody, 'text/html');
	
		  if ($mailer->send($msg)) :
			  $json['type'] = 'success';
			  $json['message'] = Filter::msgOk(Lang::$word->WDG_CF_OK, false);
			  print json_encode($json);
		    else :
			  $json['message'] = Filter::msgAlert(Lang::$word->WDG_CF_ERROR, false);
			  print json_encode($json);
		  endif;
		  
        else :
		  $json['message'] = Filter::msgStatus();
		  print json_encode($json);
	  endif;
  endif;
?>