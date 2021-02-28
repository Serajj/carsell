<?php
  /**
   * Controller
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: controller.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);

  require_once ("init.php");
  if (!$user->is_Admin())
      redirect_to("login.php");
	  
  $delete = (isset($_POST['delete']))  ? $_POST['delete'] : null;
?>
<?php
  switch ($delete):
  /* == Delete Single Listing == */
  case "deleteListing":
      $thumb = getValueById("thumb", Content::lTable, Filter::$id);
	  if(file_exists(UPLOADS . "listings/" . $thumb)) :
        unlink(UPLOADS . "listings/" . $thumb);
	  endif;

      $res = $db->delete(Content::lTable, "id='" . Filter::$id . "'");
      $db->delete(Content::gTable, "listing_id='" . Filter::$id . "'");
	  
	  $pics = UPLOADS . "listings/pics" . Filter::$id;
	  delete_directory($pics);

      $title = sanitize($_POST['title']);

	  if($res) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[LISTING]", $title, Lang::$word->LST_DEL_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
  break;

  /* == Delete Multiple Listing == */
  case "deleteMultiListings":
      if (empty($_POST['listid']))
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Filter::msgSingleAlert(Lang::$word->LST_DEL_ERR1, false);

      if (isset($_POST['listid'])):
          if (!empty($_POST['listid'])):
		  
              foreach ($_POST['listid'] as $val):
                  $id = intval($val);
                  $thumb = getValue("thumb", Content::lTable, "id = '" . $id . "'");
				  
				  if(file_exists(UPLOADS . "listings/" . $thumb)) :
					unlink(UPLOADS . "listings/" . $thumb);
				  endif;

                  $db->delete(Content::lTable, "id='" . $id . "'");
                  $db->delete(Content::gTable, "listing_id='" . $id . "'");

				  $pics = UPLOADS . "listings/pics$id";
				  delete_directory($pics);

              endforeach;
          endif;
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = Filter::msgSingleOk(Lang::$word->LST_DEL_OK1, false);
      endif;
	  print json_encode($json);
  break;

  /* == Delete Location == */
  case "showroom":
      $db->delete(Content::lcTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);

	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[LOCATION]", $username, Lang::$word->LOC_DELOC_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
  break;

  /* == Delete User == */
  case "deleteUser":
  if (Filter::$id == 1):
	  $json['type'] = 'error';
	  $json['title'] = Lang::$word->ERROR;
	  $json['message'] = Lang::$word->USR_DELUSER_ERR1;
  else:
	  $db->delete("users", "id='" . Filter::$id . "'");
	  $username = sanitize($_POST['title']);
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[USERNAME]", $username, Lang::$word->USR_DELUSER_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
  endif;
      print json_encode($json);
	  break;


  /* == Delete Category == */
  case "deleteCategory":
      $db->delete(Content::cTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);
	  
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[CATEGORY]", $title, Lang::$word->CAT_DELOC_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  
      print json_encode($json);
	  break;
  

  /* == Delete Fueltype == */
  case "deleteFueltype":
      $db->delete(Content::fuTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);
	  
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[FUEL]", $title, Lang::$word->FUEL_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  
      print json_encode($json);
   break;

  /* == Delete Condition == */
  case "deleteCondition":
      $db->delete(Content::cdTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);
	  
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[COND]", $title, Lang::$word->COND_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  
      print json_encode($json);
  break;

  /* == Delete Feature == */
  case "deleteFeature":
      $action = $db->delete(Content::fTable, "id='" . Filter::$id . "'");

      $title = sanitize($_POST['title']);
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[FEATURE]", $title, Lang::$word->FEAT_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  
      print json_encode($json);
  break;
  
  /* == Delete Transmission == */
  case "deleteTransmission":
      $db->delete(Content::tTable, "id='" . Filter::$id . "'");
	  $title = sanitize($_POST['title']);

	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[TRANS]", $title, Lang::$word->TRNS_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  
      print json_encode($json);
  break;
  
  /* == Delete Make == */
  case "deleteMake":
      $action = $db->delete(Content::mTable, "id='" . Filter::$id . "'");
      $db->delete(Content::mdTable, "make_id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);
	  
	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[MAKE]", $title, Lang::$word->MAKE_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
      print json_encode($json);
  break;

  /* == Delete Model == */
  case "deleteModel":
      $db->delete(Content::mdTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);

	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[MODEL]", $title, Lang::$word->MODL_DELOF_OK);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
      print json_encode($json);
  break;


  /* == Delete Page == */
  case "deletePage":
      $title = sanitize($_POST['title']);
      if (getValueById("home_page", Content::pTable, Filter::$id)):
		  $json['type'] = 'error';
		  $json['title'] = Lang::$word->ERROR;
		  $json['message'] = Lang::$word->PAG_DELPAGE_H;
      else:
          $db->delete(Content::pTable, "id='" . Filter::$id . "'");
		  if($db->affected()) :
			  $json['type'] = 'success';
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = str_replace("[PAGE]", $title, Lang::$word->PAG_DELPAGE_OK);
		  else :
			  $json['type'] = 'warning';
			  $json['title'] = Lang::$word->ALERT;
			  $json['message'] = Lang::$word->NOPROCCESS;
		  endif;
      endif;
	  print json_encode($json);
   break;

  /* == Delete Menu == */
  case "deleteMenu":
      $db->delete(Content::muTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);

	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[MENU]", $title, Lang::$word->MENU_DELMENU_OK);
	  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
   break;

  /* == Delete F.A.Q. == */
  case "deleteFaq":
      $db->delete(Content::faqTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);

	  if($db->affected()) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[FAQ]", $title, Lang::$word->FAQ_DELFAQ_OK);
	  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
   break;
   
  /* == Delete Backup == */
  case "deleteBackup":
      $title = sanitize($_POST['title']);
	  $action = false;

	  if(file_exists(BASEPATH . 'admin/backups/'.sanitize($_POST['file']))) :
		$action = unlink(BASEPATH . 'admin/backups/'.sanitize($_POST['file']));
	  endif;
				  
	  if($action) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[DBNAME]", $title, Lang::$word->BAC_DELETE_OK);
	  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
   break;
  endswitch;
?>
<?php
  /* == Process Listing == */
  if (isset($_POST['processListing'])):
      $content->processListing();
  endif;
  
  /* == Proccess Configuration == */
  if (isset($_POST['processConfig'])):
      $core->processConfig();
  endif;

  /* == Process Location == */
  if (isset($_POST['processLocation'])):
      $content->processLocation();
  endif;

  /* == Process Category == */
  if (isset($_POST['processCategory'])):
      $content->processCategory();
  endif;

  /* == Process Makes == */
  if (isset($_POST['processMake'])):
      $content->processMake();
  endif;

  /* == Process Model == */
  if (isset($_POST['processModel'])):
      $content->processModel();
  endif;

  /* == Process Feature == */
  if (isset($_POST['processFeature'])):
      $content->processFeature();
  endif;

  /* == Process Condition == */
  if (isset($_POST['processCondition'])):
      $content->processCondition();
  endif;

  /* == Process Transmission == */
  if (isset($_POST['processTransmission'])):
      $content->processTransmission();
  endif;

  /* == Process processFueltype == */
  if (isset($_POST['processFueltype'])):
      $content->processFueltype();
  endif;

  /* == Proccess User == */
  if (isset($_POST['processUser'])):
      $user->processUser();
  endif;

  /* == Process Page == */
  if (isset($_POST['processPage'])):
      $content->processPage();
  endif;

  /* == Proccess Menus == */
  if (isset($_POST['processMenu'])):
      $content->processMenu();
  endif;
  
  /* == Process F.A.Q. == */
  if (isset($_POST['processFaq'])):
      $content->processFaq();
  endif;
  
  /* == Process Emal Template == */
  if (isset($_POST['processTemplate'])):
      $content->processEtemplate();
  endif;
  
  /* == Process Language == */
  if (isset($_POST['processLang'])):
      Lang::processLang();
  endif;
  
  /* == Process Newsletter == */
  if (isset($_POST['processNewsletter'])):
      $content->processNewsletter();
  endif;
  
  /* == Process Sitemap == */
  if (isset($_POST['processSitemap'])):
      $content->writeSiteMap();
  endif;
?>
<?php
  /* == Quick Edit == */
  if (isset($_POST['quickedit']) and isset($_POST['type'])):
      $data['name'] = cleanOut($_POST['title']);
	  $data['name'] = sanitize($data['name']);
	  
	  if(empty($data['name'])):
	     print 'NO TITLE';
		 exit;
	  endif;

      switch (sanitize($_POST['type'])) :
          case "category":
		      $data['slug'] = doSeo($data['name']);
              $db->update(Content::cTable, $data, "id='" . Filter::$id . "'");
              break;

          case "make":
              $db->update(Content::mTable, $data, "id='" . Filter::$id . "'");
              break;

          case "model":
              $db->update(Content::mdTable, $data, "id='" . Filter::$id . "'");
              break;

          case "feature":
              $db->update(Content::fTable, $data, "id='" . Filter::$id . "'");
              break;	  
			  
          case "condition":
              $db->update(Content::cdTable, $data, "id='" . Filter::$id . "'");
              break;	
			  
          case "transmission":
              $db->update(Content::tTable, $data, "id='" . Filter::$id . "'");
              break;	  
			  
          case "fuel":
              $db->update(Content::fuTable, $data, "id='" . Filter::$id . "'");
              break;
			  
          case "phrase":
		      $ldata['lang_value'] = $data['name'];
              $db->update(Lang::lTable, $ldata, "id='" . Filter::$id . "' AND abbr = '" . $core->lang . "'");
              break;

          case "gallery":
		      $gdata['title'] = $data['name'];
              $db->update(Content::gTable, $gdata, "id='" . Filter::$id . "'");
              break;
      endswitch;

      print cleanOut($data['name']);
  endif;
?>
<?php
  /* == Listing Live Search == */
  if (isset($_POST['listingSearch'])):
      $string = sanitize($_POST['listingSearch'], 15);
      if (strlen($string) > 3):

          $sql = "SELECT l.*, l.id AS id, CONCAT(m.name,' ',md.name) as title" 
		  . "\n FROM " . Content::lTable . " as l" 
		  . "\n LEFT JOIN " . Content::mTable 
		  . " AS m ON m.id = l.make_id" 
		  . "\n LEFT JOIN " . Content::mdTable . "  AS md ON md.id = l.model_id" 
		  . "\n WHERE MATCH (m.name, md.name) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE)" 
		  . "\n ORDER BY title LIMIT 10";

          $display = '';
          if ($result = $db->fetch_all($sql)):
              $display .= '<div id="search-results" class="wojo segment celled list">';
              foreach ($result as $row):
                  $thumb = ($row->thumb) ? '<img src="' . SITEURL . '/thumbmaker.php?src=' . UPLOADURL . '/listings/' . $row->thumb . '&amp;h=60&amp;w=100" alt="" title="' . $row->title . '" class="mainimg tooltip"/>' : '<img src="' . SITEURL . '/thumbmaker.php?src=' . UPLOADURL . '/listings/nopic.jpg&amp;h=60&amp;w=100" alt="" title="' . $row->title . '" class="mainimg tooltip"/>';
                  $link = 'index.php?do=listings&amp;action=edit&amp;id=' . $row->id;
				  $display .= '<div class="item">' . $thumb;
				  $display .= '<div class="items">';
				  $display .= '<div class="header"><a href="' . $link . '">' . truncate($row->title, 40) . '</a></div>';
				  $display .= '<p>' . Filter::dodate('short_date', $row->created) . '</p>';
				  $display .= '<p>' . $core->formatMoney($row->price) . '</p>';
				  $display .= '</div>';
				  $display .= '</div>';
              endforeach;
              $display .= '</div>';
              print $display;
          endif;

      endif;
  endif;
  
  /* == Load Makelist  == */
  if (isset($_POST['makelist'])):
      $id = intval($_POST['makelist']);

      $html = "";
      $sql = "SELECT * FROM " . Content::mdTable . " WHERE make_id = '" . $id . "' ORDER BY name ASC";

      $result = $db->fetch_all($sql);
      if ($result):
          foreach ($result as $row):
              $html .= "<option value=\"" . $row->id . "\">" . $row->name . "</option>\n";
          endforeach;
          unset($row);
      else:
          $html .= "<option value=\"\">--- " . Lang::$word->MAKE_NAME_R . " ---</option>\n";
      endif;
          echo $html;
  endif;
?>
<?php
  /* == Upload Photos == */
  if (isset($_POST['gupload'])):
       require_once(BASEPATH . "lib/class_upload.php");
       Registry::set('Uploader',new Uploader());
       Registry::get("Uploader")->doUpload("mainfile", Filter::$id);
  endif;
  
  /* == Delete Photo */
  if (isset($_POST['deletePhoto'])):
      $lid = intval($_POST['lid']);
      $photo = getValueById("photo", Content::gTable, Filter::$id);
	  if(file_exists(UPLOADS . "listings/pics$lid/" . $photo)) :
        unlink(UPLOADS . "listings/pics$lid/" . $photo);
	  endif;

      $res = $db->delete(Content::gTable, "id='" . Filter::$id . "'");
      $title = sanitize($_POST['title']);

	  if($res) {
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[PHOTO]", $username, Lang::$word->GAL_DELOK);
	  } else {
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  }
	  print json_encode($json);
  endif;
?>
<?php
  /* == Load Menus == */
  if (isset($_GET['getmenus'])):
      $content->getSortMenuList();
  endif;

  /* == Sort Menus == */
  if (isset($_POST['doMenuSort'])):
      $i = 0;
      foreach ($_POST['list'] as $v):
	      $i++;
          $data['position'] = $i;
          $db->update(Content::muTable, $data, "id='" . (int)$v . "'");
      endforeach;
	  $json['type'] = 'success';
	  $json['title'] = Lang::$word->SUCCESS;
	  $json['message'] = Lang::$word->MENU_SORTED;
	  print json_encode($json);
  endif;
?>
<?php
  /* == Sort F.A.Q.s == */
  if (isset($_POST['sortfaqs'])):
      $i = 0;
      foreach ($_POST['node'] as $v):
	      $i++;
          $data['position'] = $i;
          $db->update(Content::faqTable, $data, "id='" . (int)$v . "'");
      endforeach;
	  $json['type'] = 'success';
	  $json['title'] = Lang::$word->SUCCESS;
	  $json['message'] = Lang::$word->FAQ_SORTED;
	  print json_encode($json);
  endif;
?>
<?php
  /* Get Content Type */
  if (isset($_GET['contenttype'])):
      $type = sanitize($_GET['contenttype']);
      $html = "";
      switch ($type):
          case "page":
              $sql = "SELECT id, title FROM " . Content::pTable . " WHERE active = 1 ORDER BY title ASC";
              $result = $db->fetch_all($sql);

              if ($result):
                  foreach ($result as $row):
                      $html .= "<option value=\"" . $row->id . "\">" . $row->title . "</option>\n";
                  endforeach;
                  $json['type'] = 'page';
                  $json['message'] = $html;
              endif;
              break;

          default:
              $html .= "<input name=\"page_id\" type=\"hidden\" value=\"0\" />";
              $json['type'] = 'web';
              $json['message'] = $html;
      endswitch;

      print json_encode($json);
  endif;
?>
<?php
  /* == Restore SQL Backup == */
  if (isset($_POST['restoreBackup'])):
	  require_once(BASEPATH . "lib/class_dbtools.php");
	  Registry::set('dbTools',new dbTools());
	  $tools = Registry::get("dbTools");
	  
	  if($tools->doRestore($_POST['restoreBackup'])) :
		  $json['type'] = 'success';
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[DBFILE]", $_POST['restoreBackup'], Lang::$word->DB_RESTORED);
		  else :
		  $json['type'] = 'warning';
		  $json['title'] = Lang::$word->ALERT;
		  $json['message'] = Lang::$word->NOPROCCESS;
	  endif;
	  print json_encode($json);
  endif;
?>
<?php
  /* == Export Newsletter List == */
  if (isset($_GET['exportNewsletter'])):

      $header = '';
      $data = '';
      $result = $db->query("SELECT * FROM " . Content::nlTable);
      $fields = $db->field_count();
      $names = $db->fetch_fields($result);

      for ($i = 0; $i < $fields; $i++) {
          $header .= $names[$i]->name . ",";
      }
      while ($row = $db->fetchrow($result)) {
          $line = '';
          foreach ($row as $value) {
              $value = '"' . $value . '"' . ",";
              $line .= $value;
          }
          $data .= trim($line) . "\n";
      }
      $title = Lang::$word->NLT_LIST;
      $data = str_replace("\r", " ", $data);
      header("Content-type: application/x-msdownload");
      header("Content-Disposition: attachment; filename=nsl.csv");
      header("Pragma: no-cache");
      header("Expires: 0");
      print "$title\n\n$header\n$data";

      exit;
  endif;
?>
<?php
  /* == Latest Visitor Stats == */
  if (isset($_GET['getVisitsStats'])):
      if (intval($_GET['getVisitsStats']) == 0 || empty($_GET['getVisitsStats'])):
          die();
      endif;

      $range = (isset($_GET['timerange'])) ? sanitize($_GET['timerange']) : 'year';
      $data = array();
      $data['hits'] = array();
      $data['xaxis'] = array();
      $data['hits']['label'] = Lang::$word->DASH_HITS;
      $data['visits']['label'] = Lang::$word->DASH_VISITS;

      switch ($range)
      {
          case 'day':
		      $date = date('Y-m-d');
			  
              for ($i = 0; $i < 24; $i++)
              {
                  $row = $db->first("SELECT SUM(pageviews) AS total,"
				  . "\n SUM(uniquevisitors) as visits"
				  . "\n FROM " . Content::stTable
				  . "\n WHERE DATE(day)='" . $db->escape($date) . "'" 
				  . "\n AND HOUR(day) = '" . (int)$i . "'" 
				  . "\n GROUP BY HOUR(day) ORDER BY day ASC");

                  $data['hits']['data'][] = ($row) ? array($i, (int)$row->total) : array($i, 0);
                  $data['visits']['data'][] = ($row) ? array($i, (int)$row->visits) : array($i, 0);
                  $data['xaxis'][] = array($i, date('H', mktime($i, 0, 0, date('n'), date('j'), date('Y'))));
              }
              break;
          case 'week':
              $date_start = strtotime('-' . date('w') . ' days');

              for ($i = 0; $i < 7; $i++)
              {
                  $date = date('Y-m-d', $date_start + ($i * 86400));
                  $row = $db->first("SELECT SUM(pageviews) AS total," 
				  . "\n SUM(uniquevisitors) as visits"
				  . "\n FROM " . Content::stTable
				  . "\n WHERE DATE(day) = '" . $db->escape($date) . "'" 
				  . "\n GROUP BY DATE(day)");

                  $data['hits']['data'][] = ($row) ? array($i, (int)$row->total) : array($i, 0);
                  $data['visits']['data'][] = ($row) ? array($i, (int)$row->visits) : array($i, 0);
                  $data['xaxis'][] = array($i, date('D', strtotime($date)));
              }

              break;
          default:
          case 'month':
              for ($i = 1; $i <= date('t'); $i++)
              {
                  $date = date('Y') . '-' . date('m') . '-' . $i;
                  $row = $db->first("SELECT SUM(pageviews) AS total,"
				  . "\n SUM(uniquevisitors) as visits"
				  . "\n FROM " . Content::stTable
				  . "\n WHERE (DATE(day) = '" . $db->escape($date) . "')" 
				  . "\n GROUP BY DAY(day)");

                  $data['hits']['data'][] = ($row) ? array($i, (int)$row->total) : array($i, 0);
                  $data['visits']['data'][] = ($row) ? array($i, (int)$row->visits) : array($i, 0);
                  $data['xaxis'][] = array($i, date('j', strtotime($date)));
              }
              break;
          case 'year':
              for ($i = 1; $i <= 12; $i++)
              {
                  $row = $db->first("SELECT SUM(pageviews) AS total,"
				  . "\n SUM(uniquevisitors) as visits"
				  . "\n FROM " . Content::stTable
				  . "\n WHERE YEAR(day) = '" . date('Y') . "'" 
				  . "\n AND MONTH(day) = '" . $i . "'" 
				  . "\n GROUP BY MONTH(day)");

                  $data['hits']['data'][] = ($row) ? array($i, (int)$row->total) : array($i, 0);
                  $data['visits']['data'][] = ($row) ? array($i, (int)$row->visits) : array($i, 0);
                  $data['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i, 1, date('Y'))));
              }
              break;
      }

      print json_encode($data);
  endif;
?>