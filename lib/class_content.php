<?php
  /**
   * Content Class
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: class_content.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Content
  {
      const cTable = "categories";
      const mTable = "makes";
      const mdTable = "models";
	  const fTable = "features";
	  const cdTable = "conditions";
	  const tTable = "transmissions";
	  const fuTable = "fuel";
	  const lTable = "listings";
	  const liTable = "listings_info";
	  const lcTable = "locations";
	  const gTable = "gallery";
	  const pTable = "pages";
	  const muTable = "menus";
	  const faqTable = "faq";
	  const stTable = "stats";
	  const eTable = "email_templates";
	  const nlTable = "newsletter";
	  
	  public $pageslug = null;
	  public $catname = null;
	  public $itemslug = null;
	  public $idx = null;
	  
      private static $db;


      /**
       * Content::__construct()
       * 
       * @return
       */
      public function __construct($visits = false)
      {
          self::$db = Registry::get("Database");
		  $this->getContentSlug();
		  $this->getCatSlug();
		  $this->getListingSlug();
		  $this->getListingIdx();
		  ($visits) ? $this->getVisitors() : null;

      }

	  /**
	   * Content::getContentSlug()
	   * 
	   * @return
	   */
	  private function getContentSlug()
	  {
		  
		  if (isset($_GET['pagename'])) {
			  $this->pageslug = sanitize($_GET['pagename'],150);
			  return self::$db->escape($this->pageslug);
		  }
	  }

	  /**
	   * Content::getCatSlug()
	   * 
	   * @return
	   */
	  private function getCatSlug()
	  {
		  
		  if (isset($_GET['catname'])) {
			  $this->catname = sanitize($_GET['catname'],150);
			  return self::$db->escape($this->catname);
		  }
	  }

	  /**
	   * Content::getListingSlug()
	   * 
	   * @return
	   */
	  private function getListingSlug()
	  {
		  
		  if (isset($_GET['itemname'])) {
			  $this->itemslug = sanitize($_GET['itemname'],120);
			  return self::$db->escape($this->itemslug);
		  }
	  }

	  /**
	   * Content::getListingIdx()
	   * 
	   * @return
	   */
	  private function getListingIdx()
	  {
		  
		  if (isset($_GET['idx'])) {
			  $this->idx = sanitize($_GET['idx'],12, true);
			  return $this->idx;
		  } else {
			  return $this->idx = 0;
		  }
	  }
	  
      /**
       * Content::getLocations()
       * 
       * @return
       */
      public function getLocations()
      {
          $sql = "SELECT * FROM " . self::lcTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processLocation()
       * 
       * @return
       */
      public function processLocation()
      {
          Filter::checkPost('name', Lang::$word->LOC_NAME);
		  Filter::checkPost('email', Lang::$word->EMAIL);
		  Filter::checkPost('address', Lang::$word->CONF_ADDRESS);
		  Filter::checkPost('city', Lang::$word->CONF_CITY);
		  Filter::checkPost('state', Lang::$word->CONF_STATE);
		  Filter::checkPost('zip', Lang::$word->CONF_ZIP);

          if (empty(Filter::$msgs)) {
              $data = array(
					'name' => sanitize($_POST['name']),
					'email' => sanitize($_POST['email']),
					'address' => sanitize($_POST['address']),
					'city' => sanitize($_POST['city']),
					'state' => sanitize($_POST['state']),
					'zip' => sanitize($_POST['zip']),
					'country' => sanitize($_POST['country']),
					'url' => sanitize($_POST['url']),
					'phone' => sanitize($_POST['phone']),
					'fax' => sanitize($_POST['fax']),
					'lat' => sanitize($_POST['lat']),
					'lng' => sanitize($_POST['lng']),
					'zoom' => intval($_POST['zoom'])
			  
			  );

			  (Filter::$id) ? self::$db->update(self::lcTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::lcTable, $data);
			  $message = (Filter::$id) ? Lang::$word->LOC_UPDATED : Lang::$word->LOC_ADDED;
			  
			  if(self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
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
       * Content::getCategories()
       * 
       * @return
       */
      public function getCategories()
      {
          $sql = "SELECT *,(SELECT COUNT(id) FROM " . self::lTable . " WHERE category = " . self::cTable . ".id) as total FROM " . self::cTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {
	
		  Filter::checkPost('name', Lang::$word->CAT_NAME);
		  Filter::checkSetPost('img', Lang::$word->CAT_IMG);
	
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'name' => sanitize($_POST['name']),
				  'slug' => doSeo($_POST['name']),
				  'image' => sanitize($_POST['img'])
			  );
			  $last_id = self::$db->insert(self::cTable, $data);
	
			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="category">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->CAT_DEL . '" data-option="deleteCategory" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[CATEGORY]", $data['name'], Lang::$word->CAT_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->CAT_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
		  }
	  }

      /**
       * Content::getMakes()
       * 
       * @return
       */
      public function getMakes($paginate = true)
      {
          if ($paginate) {
              $pager = Paginator::instance();
              $pager->items_total = countEntries(self::mTable);
              $pager->default_ipp = Registry::get("Core")->ipp;
              $pager->paginate();
              $limit = $pager->limit;
          } else {
              $limit = null;
          }

          $sql = "SELECT * FROM " . self::mTable . " ORDER BY name" . $limit;
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processMake()
       * 
       * @return
       */
      public function processMake()
      {

          Filter::checkPost('name', Lang::$word->MAKE_NAME);

          if (empty(Filter::$msgs)) {
              $data = array('name' => sanitize($_POST['name']));
              $last_id = self::$db->insert(self::mTable, $data);

			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="make">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->CAT_DEL . '" data-option="deleteMake" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[MAKE]", $data['name'], Lang::$word->MAKE_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);

		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->MAKE_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
		  }

      }


      /**
       * Content::getMakes()
       * 
       * @return
       */
      public function getModels()
      {

          if (Filter::$id) {
              $total = countEntries(self::mdTable, "make_id", Filter::$id);
              $where = "WHERE md.make_id = '" . Filter::$id . "'";
          } elseif (isset($_POST['find'])) {
              $q = "SELECT COUNT(*) FROM " . self::mdTable . "  WHERE name LIKE '%" . sanitize($_POST['find']) . "%' LIMIT 1";
              $record = self::$db->query($q);
              $counter = self::$db->fetchrow($record);
              $total = $counter[0];
              $where = "WHERE md.name LIKE '%" . sanitize($_POST['find']) . "%'";
          } else {
              $total = countEntries(self::mdTable);
              $where = null;
          }

          $pager = Paginator::instance();
          $pager->items_total = $total;
          $pager->default_ipp = Registry::get("Core")->ipp;
          $pager->paginate();

          $sql = "SELECT md.id as mdid, md.name as mdname, mk.name as mkname" 
		  . "\n FROM " . self::mdTable . " as md" 
		  . "\n LEFT JOIN " . self::mTable . " as mk ON mk.id = md.make_id" 
		  . "\n $where" 
		  . "\n ORDER BY md.name" . $pager->limit;
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getModelList()
       * 
       * @return
       */
      public function getModelList($make_id)
      {
          $sql = "SELECT * FROM " . self::mdTable . " WHERE make_id = " . (int)$make_id . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  

      /**
       * Content::processModel()
       * 
       * @return
       */
      public function processModel()
      {
          if(empty($_POST['makeid'])) {
			  $err = Filter::$msgs['answer'] = Lang::$word->MAKE_NAME_R;
		  }

          $name = array_filter($_POST['makename'], 'strlen');
          if (empty($name))
              $err = Filter::$msgs['answer'] = Lang::$word->MODL_NAME_R;

          if (empty(Filter::$msgs)) {
              $makename = getValue("name", self::mTable, "id='" . intval($_POST['makeid']) . "'");
              $html = '';
              foreach ($_POST['makename'] as $key => $val) {
                  $data = array('name' => sanitize($_POST['makename'][$key]), 'make_id' => intval($_POST['makeid']));
                  $last_id = self::$db->insert(self::mdTable, $data);

                  $html .= '
				  <tr>
					<td class="warning">' . $last_id . '</td>
					<td>' . $makename . '</td>
					<td><span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="model">' . $data['name'] . '</span></td>
					<td><a class="delete" data-title="' . Lang::$word->MODL_DEL . '" data-option="deleteModel" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="rounded danger inverted trash icon link"></i></a></td>
				  </tr>';
              }
			  $json = array(
				  'type' => 'success',
				  'title' => Lang::$word->SUCCESS,
				  'data' => $html,
				  'message' => Lang::$word->MODL_ADDED
				  );
              print json_encode($json);

		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = $err;
			  print json_encode($json);
		  }

      }
	  
      /**
       * Content::getFeatures()
       * 
       * @return
       */
      public function getFeatures()
      {
          $sql = "SELECT * FROM " . self::fTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getFeaturesById()
       * 
       * @return
       */
      public function getFeaturesById($ids)
      {
          
          $sql = "SELECT * FROM " . self::fTable . " WHERE id in(" . $ids . ") ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::processFeature()
       * 
       * @return
       */
      public function processFeature()
      {

          Filter::checkPost('name', Lang::$word->FEAT_NAME);

          if (empty(Filter::$msgs)) {
              $data = array('name' => sanitize($_POST['name']));
              $last_id = self::$db->insert(self::fTable, $data);

			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="feature">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->FEAT_DEL . '" data-option="deleteFeature" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[FEATURE]", $data['name'], Lang::$word->FEAT_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->FEAT_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
		  }

      }
	  
      /**
       * Content::getConditions()
       * 
       * @return
       */
      public function getConditions()
      {
          $sql = "SELECT * FROM " . self::cdTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processCondition()
       * 
       * @return
       */
      public function processCondition()
      {

          Filter::checkPost('name', Lang::$word->COND_NAME);

          if (empty(Filter::$msgs)) {
              $data = array('name' => sanitize($_POST['name']));
              $last_id = self::$db->insert(self::cdTable, $data);

			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="condition">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->COND_DEL . '" data-option="deleteCondition" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[COND]", $data['name'], Lang::$word->COND_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->COND_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
		  }

      }
	  
      /**
       * Content::getTransmissions()
       * 
       * @return
       */
      public function getTransmissions()
      {
          $sql = "SELECT * FROM " . self::tTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processTransmission()
       * 
       * @return
       */
      public function processTransmission()
      {

          Filter::checkPost('name', Lang::$word->TRNS_NAME);

          if (empty(Filter::$msgs)) {
              $data = array('name' => sanitize($_POST['name']));
              $last_id = self::$db->insert(self::tTable, $data);

			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="transmission">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->TRNS_DEL . '" data-option="deleteTransmission" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[TRANS]", $data['name'], Lang::$word->TRNS_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->TRNS_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
		  }

      }

      /**
       * Content::getFueltypes()
       * 
       * @return
       */
      public function getFueltypes()
      {
          $sql = "SELECT * FROM " . self::fuTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processFueltype()
       * 
       * @return
       */
      public function processFueltype()
      {

          Filter::checkPost('name', Lang::$word->FUEL_NAME);

          if (empty(Filter::$msgs)) {
              $data = array('name' => sanitize($_POST['name']));
              $last_id = self::$db->insert(self::fuTable, $data);

			  if (self::$db->affected()) {
				  $html = '
					  <div class="row">
						<div class="wojo basic message notice"> <span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="fuel">' . $data['name'] . '</span> 
						<a class="delete wojo top right negative corner label" data-title="' . Lang::$word->FUEL_DEL . '" data-option="deleteFueltype" data-id="' . $last_id . '" data-name="' . $data['name'] . '"><i class="icon delete"></i></a> 
						</div>
					  </div>';
	
				  $json = array(
					  'type' => 'success',
					  'title' => Lang::$word->SUCCESS,
					  'data' => $html,
					  'message' => str_replace("[FUEL]", $data['name'], Lang::$word->FUEL_ADDED)
					  );
			  } else {
				  $json = array(
					  'type' => 'warning',
					  'title' => Lang::$word->ALERT,
					  'data' => Lang::$word->NOPROCCESS
					  );
			  }
			  print json_encode($json);

          } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = str_replace("[FIELDNAME]", Lang::$word->FUEL_NAME, Lang::$word->PROCCESS_ERR2);
			  print json_encode($json);
          }

      }
	  
	  
      /**
       * Content::getListings()
       * 
       * @return
       */
      public function getListings()
      {

		  if (isset($_GET['letter']) and (isset($_POST['fromdate_submit']) && $_POST['fromdate_submit'] <> "" || isset($from) && $from != '')) {
			  $enddate = date("Y-m-d");
			  $letter = sanitize($_GET['letter'], 2);
			  $fromdate = (empty($from)) ? $_POST['fromdate_submit'] : $from;
			  if (isset($_POST['enddate_submit']) && $_POST['enddate_submit'] <> "") {
				  $enddate = $_POST['enddate_submit'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'"
			  . "\n AND title REGEXP '^" . self::$db->escape($letter) . "'";
			  $where = " WHERE l.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND title REGEXP '^" . self::$db->escape($letter) . "'";
			  
		  } elseif (isset($_POST['fromdate_submit']) && $_POST['fromdate_submit'] <> "" || isset($from) && $from != '') {
			  $enddate = date("Y-m-d");
			  $fromdate = (empty($from)) ? $_POST['fromdate_submit'] : $from;
			  if (isset($_POST['enddate_submit']) && $_POST['enddate_submit'] <> "") {
				  $enddate = $_POST['enddate_submit'];
			  }
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  $where = " WHERE l.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
			  
		  } elseif(isset($_GET['letter'])) {
			  $letter = sanitize($_GET['letter'], 2);
			  $where = "WHERE title REGEXP '^" . self::$db->escape($letter) . "'";
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " WHERE title REGEXP '^" . self::$db->escape($letter) . "' LIMIT 1"; 
		  } else {
			  $q = "SELECT COUNT(*) FROM " . self::lTable . " LIMIT 1";
			  $where = null;
		  }
		  
          $record = self::$db->query($q);
          $total = self::$db->fetchrow($record);
          $counter = $total[0];
		  
		  $pager = Paginator::instance();
		  $pager->items_total = $counter;
		  $pager->default_ipp = Registry::get("Core")->ipp;
		  $pager->paginate();
		  
          $sql = "SELECT l.*, l.id AS id, CONCAT(m.name,' ',md.name) as name"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::mTable . " AS m ON m.id = l.make_id" 
		  . "\n LEFT JOIN " . self::mdTable . "  AS md ON md.id = l.model_id"
		  . "\n $where"
		  . "\n ORDER BY l.created DESC" . $pager->limit;
		  
		 $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
	  

      /**
       * Content::getListingById()
       * 
       * @return
       */
      public function getListingById()
      {
          
          $sql = "SELECT l.*, l.id AS id, CONCAT(m.name,' ',md.name) as title"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::mTable . " AS m ON m.id = l.make_id" 
		  . "\n LEFT JOIN " . self::mdTable . "  AS md ON md.id = l.model_id"
		  . "\n WHERE l.id = " . Filter::$id;
		  
		 $row = self::$db->first($sql);

          return ($row) ? $row : Filter::error("You have selected an Invalid Id", "Content::getListingById()");
      }

      /**
       * Content::getListingPreview()
       * 
       * @return
       */
      public function getListingPreview()
      {
          
          $sql = "SELECT l.*, li.*, c.*, l.id AS id, CONCAT(li.make_name,' ',li.model_name) as name"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::liTable . " AS li ON li.listing_id = l.id" 
		  . "\n LEFT JOIN " . self::lcTable . " AS c ON c.id = l.location" 
		  . "\n WHERE l.id = " . Filter::$id;
		  
		 $row = self::$db->first($sql);

          return ($row) ? $row : Filter::error("You have selected an Invalid Id", "Content::getListingPreview()");
      }
	  
      /**
       * Content::doTitle()
       * 
       * @return
       */
      public function doTitle($model_id)
      {
          $sql = "SELECT md.name as mdname, m.name as mname"
		  . "\n FROM ".self::mdTable." as md"
		  . "\n LEFT JOIN " . self::mTable . " AS m ON m.id = md.make_id" 
		  . "\n WHERE md.id = " . $model_id;
		  $row = self::$db->first($sql);

          return ($row) ? doSeo($row->mname . '-' . $row->mdname) : 0;
      }

      /**
       * Content::getTitle()
       * 
       * @return
       */
      public function getTitle()
      {
          $sql = "SELECT l.id AS id, CONCAT(m.name,' ',md.name) as title"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::mTable . " AS m ON m.id = l.make_id" 
		  . "\n LEFT JOIN " . self::mdTable . "  AS md ON md.id = l.model_id"
		  . "\n WHERE l.id = " . Filter::$id;
		  $row = self::$db->first($sql);

          return ($row) ? $row->title : Filter::error("You have selected an Invalid Id", "Content::getTitle()");
      }
	  
      /**
       * Content::processListing()
       * 
       * @return
       */
	  public function processListing()
	  {
		  Filter::checkPost('location', Lang::$word->LST_ROOM);
		  Filter::checkPost('make_id', Lang::$word->LST_MAKE);
		  Filter::checkPost('model_id', Lang::$word->LST_MODEL);
		  Filter::checkPost('price', Lang::$word->LST_PRICE);
		  Filter::checkPost('year', Lang::$word->LST_YEAR);
		  Filter::checkPost('category', Lang::$word->LST_CAT);
		  Filter::checkPost('condition', Lang::$word->LST_COND);
		  Filter::checkPost('transmission', Lang::$word->LST_TRANS);
		  Filter::checkPost('fuel', Lang::$word->LST_FUEL);
		  Filter::checkPost('body', Lang::$word->LST_DESC);
	
		  if (!empty($_FILES['thumb']['name'])) {
			  if (!preg_match("/(\.jpg|\.png)$/i", $_FILES['thumb']['name']))
				  Filter::$msgs['thumb'] = Lang::$word->LST_IMAGE_ERR1;
	
			  $file_info = getimagesize($_FILES['thumb']['tmp_name']);
			  if (empty($file_info))
				  Filter::$msgs['thumb'] = Lang::$word->LST_IMAGE_ERR2;
		  }
	
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'user_id' => Registry::get("Users")->uid,
				  'slug' => (empty($_POST['slug'])) ? intval($_POST['year']) . '-' . $this->doTitle(intval($_POST['model_id'])) : doSeo($_POST['slug']),
				  'location' => intval($_POST['location']),
				  'stock_id' => sanitize($_POST['stock_id']),
				  'vin' => sanitize($_POST['vin']),
				  'make_id' => intval($_POST['make_id']),
				  'model_id' => intval($_POST['model_id']),
				  'year' => intval($_POST['year']),
				  'condition' => intval($_POST['condition']),
				  'category' => intval($_POST['category']),
				  'milege' => sanitize($_POST['milege']),
				  'torque' => sanitize($_POST['torque']),
				  'price' => sanitize($_POST['price']),
				  'price_sale' => (empty($_POST['price_sale'])) ? sanitize($_POST['price']) : sanitize($_POST['price_sale']),
				  'color_e' => sanitize($_POST['color_e']),
				  'color_i' => sanitize($_POST['color_i']),
				  'doors' => intval($_POST['doors']),
				  'fuel' => intval($_POST['fuel']),
				  'drive_train' => sanitize($_POST['drive_train']),
				  'engine' => sanitize($_POST['engine']),
				  'transmission' => intval($_POST['transmission']),
				  'top_speed' => intval($_POST['top_speed']),
				  'horse_power' => sanitize($_POST['horse_power']),
				  'towing_capacity' => sanitize($_POST['towing_capacity']),
				  'body' => $_POST['body'],
				  'notes' => sanitize($_POST['notes']),
				  'status' => isset($_POST['status']) ? intval($_POST['status']) : 0,
				  'featured' => isset($_POST['featured']) ? intval($_POST['featured']) : 0
				  );
	
			  $data['title'] = (empty($_POST['title'])) ? str_replace("-", " ", $data['slug']) : sanitize($_POST['title']);
	
			  if (empty($_POST['metakey']) or empty($_POST['metadesc'])) {
				  include (BASEPATH . 'lib/class_meta.php');
				  parseMeta::instance($_POST['body']);
				  if (empty($_POST['metakey'])) {
					  $data['metakey'] = parseMeta::get_keywords();
				  }
				  if (empty($_POST['metadesc'])) {
					  $data['metadesc'] = parseMeta::metaText($_POST['body']);
				  }
	
			  }
	
			  if (!Filter::$id) {
				  $data['created'] = "NOW()";
				  $data['idx'] = random_numbers();
			  }
	
			  if (Filter::$id) {
				  $data['modified'] = "NOW()";
			  }
	
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbdir = UPLOADS . "listings/";
				  $tName = "ICON_" . randName();
				  $text = substr($_FILES['thumb']['name'], strrpos($_FILES['thumb']['name'], '.') + 1);
				  $thumbName = $thumbdir . $tName . "." . strtolower($text);
				  if (Filter::$id && $thumb = getValueById("thumb", self::lTable, Filter::$id)) {
					  @unlink($thumbdir . $thumb);
				  }
				  move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbName);
				  $data['thumb'] = $tName . "." . strtolower($text);
			  }
	
			  if (isset($_POST['features'])) {
				  if (is_array($_POST['features'])) {
					  $data['features'] = self::_implodeFields($_POST['features']);
				  }
			  } else {
				  $data['features'] = "NULL";
			  }
	
			  (Filter::$id) ? self::$db->update(self::lTable, $data, "id='" . Filter::$id . "'") : $lastID = self::$db->insert(self::lTable, $data);
			  $message = (Filter::$id) ? Lang::$word->LST_UPDATED : Lang::$word->LST_ADDED;
	
			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
	
			  if (!Filter::$id) {
				  // Create upload direcories
				  $picpath = UPLOADS . "listings/pics" . $lastID . "/";
				  makeDir($picpath);
			  }
	
			  // Add to listings info
			  $idata = array(
				  'listing_id' => (Filter::$id) ? Filter::$id : $lastID,
				  'make_name' => getValueById("name", self::mTable, $data['make_id']),
				  'model_name' => getValueById("name", self::mdTable, $data['model_id']),
				  'location_name' => getValueById("name", self::lcTable, $data['location']),
				  'condition_name' => getValueById("name", self::cdTable, $data['condition']),
				  'category_name' => getValueById("name", self::cTable, $data['category']),
				  'fuel_name' => getValueById("name", self::fuTable, $data['fuel']),
				  'trans_name' => getValueById("name", self::tTable, $data['transmission']));
	
			  (Filter::$id) ? self::$db->update(self::liTable, $idata, "listing_id='" . Filter::$id . "'") : self::$db->insert(self::liTable, $idata);
			  
			  $val = self::$db->first("SELECT MIN(price)as minprice, 
			  MAX(price)as maxprice, MIN(price_sale)as minsprice, 
			  MAX(price_sale)as maxsprice, MIN(year)as minyear, 
			  MAX(year)as maxyear,
			  MIN(milege)as minkm, MAX(milege)as maxkm FROM " . self::lTable);
			  
			  $val2 = self::$db->fetch_all("SELECT color_e FROM " . self::lTable . " GROUP BY color_e");
			  $output = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($val2)), FALSE);
			  $colour = self::_implodeFields($output);
			  
			  // Add to core
			  $qdata = array(
				  'minprice' => $val->minprice,
				  'maxprice' => $val->maxprice,
				  'minsprice' => $val->minsprice,
				  'maxsprice' => $val->maxsprice,
				  'minyear' => $val->minyear,
				  'maxyear' => $val->maxyear,
				  'minkm' => $val->minkm,
				  'maxkm' => $val->maxkm,
				  'colour' => $colour
				  );
			  self::$db->update(Core::sTable, $qdata);
	
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }

      /**
       * Content::getGallery()
       * 
       * @return
       */
	   public function getGallery($lid = false)
	  {
		  $id = ($lid) ? $lid : Filter::$id;
		  
          $sql = "SELECT * FROM " . self::gTable
		  . "\n WHERE listing_id = " . $id
		  . "\n ORDER BY sorting";
          $row = self::$db->fetch_all($sql);
		  
		  return ($row) ? $row : 0;
	  }

      /**
       * Content::getContentPages()
       * 
       * @return
       */
      public function getContentPages()
      {
          $sql = "SELECT * FROM " . self::pTable . " ORDER BY title";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::processPage()
       * 
       * @return
       */
      public function processPage()
      {
          Filter::checkPost('title', Lang::$word->PAG_NAME);
		  Filter::checkPost('body', Lang::$word->PAG_BODY);

          if (empty(Filter::$msgs)) {
              $data = array(
				  'title' => sanitize($_POST['title']), 
				  'slug' => (empty($_POST['slug'])) ? doSeo($_POST['title']) : doSeo($_POST['slug']),
				  'body' => $_POST['body'],
				  'created' => sanitize($_POST['created']),
				  'contact' => intval($_POST['contact']),
				  'faq' => intval($_POST['faq']),
				  'home_page' => intval($_POST['home_page']),
				  'active' => intval($_POST['active'])
			  );

			  if ($data['home_page'] == 1) {
				  $home['home_page'] = "DEFAULT(home_page)";
				  self::$db->update(self::pTable, $home);
			  }
			  
			  if ($data['contact'] == 1) {
				  $contact['contact'] = "DEFAULT(contact)";
				  self::$db->update(self::pTable, $contact);
			  }

			  if ($data['faq'] == 1) {
				  $faq['faq'] = "DEFAULT(faq)";
				  self::$db->update(self::pTable, $faq);
			  }
			  
			  (Filter::$id) ? self::$db->update(self::pTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::pTable, $data);
			  $message = (Filter::$id) ? Lang::$word->PAG_UPDATED : Lang::$word->PAG_ADDED;

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
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
       * Content::getFaq()
       * 
       * @return
       */
      public function getFaq()
      {
          $sql = "SELECT * FROM " . self::faqTable . " ORDER BY position";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processFaq()
       * 
       * @return
       */
      public function processFaq()
      {
          Filter::checkPost('question', Lang::$word->FAQ_NAME);
		  Filter::checkPost('answer', Lang::$word->FAQ_BODY);

          if (empty(Filter::$msgs)) {
              $data = array(
				  'question' => sanitize($_POST['question']), 
				  'answer' => $_POST['answer'],
			  );
			  
			  (Filter::$id) ? self::$db->update(self::faqTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::faqTable, $data);
			  $message = (Filter::$id) ? Lang::$word->FAQ_UPDATED : Lang::$word->FAQ_ADDED;

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
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
       * Content::getEtemplates()
       * 
       * @return
       */
      public function getEtemplates()
      {
          $sql = "SELECT * FROM " . self::eTable . " ORDER BY name";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::processEtemplate()
       * 
       * @return
       */
      public function processEtemplate()
      {
          Filter::checkPost('name', Lang::$word->ETPL_NAME);
		  Filter::checkPost('subject', Lang::$word->ETPL_SUBJECT);
		  Filter::checkPost('body', Lang::$word->ETPL_BODY);

          if (empty(Filter::$msgs)) {
              $data = array(
				  'name' => sanitize($_POST['name']),
				  'subject' => sanitize($_POST['subject']), 
				  'help' => sanitize($_POST['help']),
				  'body' => $_POST['body'],
			  );
			  
			  self::$db->update(self::eTable, $data, "id='" . Filter::$id . "'");

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->ETPL_UPDATED, false);
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
	   * Content::processNewsletter()
	   * 
	   * @return
	   */
	  public function processNewsletter()
	  {		  
		  Filter::checkPost('subject', Lang::$word->NLT_SUBJECT);
		  Filter::checkPost('body', Lang::$word->NLT_BODY);
		  Filter::checkPost('recipient', Lang::$word->NLT_REC);
		  
		  if (empty(Filter::$msgs)) {
				  $to = sanitize($_POST['recipient']);
				  $subject = sanitize($_POST['subject']);
				  $body = cleanOut($_POST['body']);
				  $numSent = 0;
				  $failedRecipients = array();
				  
				  
			  switch ($to) {
				  case "all":	  
					  require_once(BASEPATH . "lib/class_mailer.php");
					  $mailer = $mail->sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100,30));
					  
					  $sql = "SELECT *  FROM " . Content::nlTable;
					  $userrow = self::$db->fetch_all($sql);
					  
					  $replacements = array();
					  if($userrow) {
						  foreach ($userrow as $cols) {
							  $replacements[$cols->email] = array('[EMAIL]' => $cols->email,'[SITE_NAME]' => Registry::get("Core")->site_name,'[URL]' => SITEURL);
						  }
						  
						  $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
						  $mailer->registerPlugin($decorator);
						  
						  $message = Swift_Message::newInstance()
									->setSubject($subject)
									->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
									->setBody($body, 'text/html');
						  
						  foreach ($userrow as $row) {
							  $message->setTo($row->email);
							  $numSent ++;
							  $mailer->send($message, $failedRecipients);
						  }
						  unset($row);
						  
						}
					  break; 
					  
				  default:
					  require_once(BASEPATH . "lib/class_mailer.php");
					  $mailer = $mail->sendMail();	
					  			  
					  $row = self::$db->first("SELECT email, CONCAT(fname,' ',lname) as name FROM " . Users::uTable . " WHERE email LIKE '%" . sanitize($to) . "%'");
					  
					  $newbody = str_replace(array('[NAME]', '[SITE_NAME]', '[URL]'), 
					  array($row->name, Registry::get("Core")->site_name, SITEURL), $body);

					  $message = Swift_Message::newInstance()
								->setSubject($subject)
							    ->setTo(array($to => $row->name))
								->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
								->setBody($newbody, 'text/html');
					  
					  $numSent ++;
					  $mailer->send($message, $failedRecipients);
					  break;
			  }	  

			  if($numSent) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($numSent . ' ' . Lang::$word->NLT_SEND_OK, false);
			  } else {
				  $json['type'] = 'error';
				  $res = '';
				  $res .= '<ul>';
				  foreach ($failedRecipients as $failed) {
					  $res .= '<li>' .  $failed . '</li>';
				  }
				  $res .= '</ul>';
				  $json['message'] = Filter::msgAlert(Lang::$word->NLT_SEND_ERR . $res, false);
				  
				  unset($failed);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }

      }
	  
      /**
       * Content::getSortMenuList()
       * 
       * @return
       */
	  public function getSortMenuList()
	  {
		  
		  if ($menurow = self::$db->fetch_all("SELECT * FROM " . Content::muTable . " ORDER BY position")) {
			  print "<ul class=\"sortMenu\">\n";
			  foreach ($menurow as $row) {
				  print '<li id="list_' . $row->id . '">'
				  .'<div><a data-id="' . $row->id . '" data-name="' . $row->name . '" data-title="' . Lang::$word->MENU_DELETE . '" data-option="deleteMenu" class="delete">'
				  . '<i class="icon red remove sign"></i></a><i class="icon reorder"></i>' 
				  .'<a href="index.php?do=menus&amp;action=edit&amp;id=' . $row->id . '">' . $row->name  . '</a></div>';
				  print "</li>\n";
			  }
		  }
		  unset($row);
		  print "</ul>\n";
	  }

      /**
       * Content::getMenus()
       * 
       * @return
       */
	  public function getMenus()
	  {
		  $sql = "SELECT m.*, p.slug, p.home_page" 
		  . "\n FROM " . self::muTable . " as m" 
		  . "\n LEFT JOIN " . self::pTable . " as p ON m.page_id = p.id" 
		  . "\n WHERE m.active = 1" 
		  . "\n AND p.active = 1" 
		  . "\n ORDER BY m.position";
		  $data = self::$db->fetch_all($sql);
	
		  $html = '';
		  if ($data) {
			  $html .= '<ul>';
			  foreach ($data as $row) {
				  $home = (preg_match('/index.php/', $_SERVER['PHP_SELF'])) ? " active" : "";
				  $active = ($this->pageslug == $row->slug) ? "active" : "normal";
				  if($row->home_page) {
					  $html .= '<li><a class="' . $home . '" href="' . SITEURL . '/' . '">' . $row->name . '</a></li>';
				  } else {
					  $html .= '<li><a class="' . $active . '" href="' . SITEURL . '/content/' . $row->slug . '/' . '">' . $row->name . '</a></li>';
				  }
				  
			  }
			  $html .= '</ul>';
		  }
	
		  return $html;
	  }
	  
	  /**
	   * Content::processMenu()
	   * 
	   * @return
	   */
	  public function processMenu()
	  {
		  Filter::checkPost('name', Lang::$word->MENU_NAME);
		  Filter::checkPost('content_type', Lang::$word->MENU_TYPE);
		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'name' => sanitize($_POST['name']), 
				  'page_id' => ($_POST['content_type'] == "web") ? 0 : intval($_POST['page_id']),
				  'content_type' => sanitize($_POST['content_type']),
				  'link' => (!empty($_POST['web'])) ? sanitize($_POST['web']) : "NULL",
				  'target' => (!empty($_POST['target'])) ? sanitize($_POST['target']) : "DEFAULT(target)",
				  'active' => intval($_POST['active'])
			  );

			  (Filter::$id) ? self::$db->update(self::muTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::muTable, $data);
			  $message = (Filter::$id) ? Lang::$word->MENU_UPDATED : Lang::$word->MENU_ADDED;

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
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
       * Content::getHomePageItems()
       * 
       * @return
       */
	  public function getHomePageItems()
	  {
		  
          $sql = "SELECT l.*, l.id AS id, cd.name as cond"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::cdTable . "  AS cd ON cd.id = l.condition"
		  . "\n WHERE l.featured = 1"
		  . "\n AND l.status = 1"
		  . "\n ORDER BY l.created DESC LIMIT " . Registry::get("Core")->featured;
		 $row = self::$db->fetch_all($sql); 
		 
		 return ($row) ? $row : 0; 
		  
	  }
	  
	  
      /**
       * Content::getContentType()
       * 
	   * @param bool $selected
       * @return
       */ 	  
      public static function getContentType($selected = false)
	  {
		  $arr = array(
				'page' => 'Content Page',
				'web' => 'External Link'
		  );
		  
		  $contenttype = '';
		  foreach ($arr as $key => $val) {
              if ($key == $selected) {
                  $contenttype .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $contenttype .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $contenttype;
      } 

	  /**
	   * Content::createSiteMap()
	   * 
	   * @return
	   */
	  private function createSiteMap()
	  {
		  
		  $sql1 = "SELECT idx, slug FROM " . self::lTable . " ORDER BY created";
		  $listings = self::$db->query($sql1);

		  $sql2 = "SELECT slug FROM " . self::cTable . " ORDER BY name";
		  $cats = self::$db->query($sql2);
		  
		  $smap = "";
		  
		  $smap .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
		  $smap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n";
		  $smap .= "<url>\r\n";
		  $smap .= "<loc>" . SITEURL . "/index.php</loc>\r\n";
		  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
		  $smap .= "</url>\r\n";

		  while ($row = self::$db->fetch($listings)) {
			 $url = doUrl($row->idx, $row->slug, "item");
			  
			  $smap .= "<url>\r\n";
			  $smap .= "<loc>" . $url . "</loc>\r\n";
			  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $smap .= "<changefreq>weekly</changefreq>\r\n";
			  $smap .= "</url>\r\n";
		  }
          unset($row);
		  while ($row = self::$db->fetch($cats)) {
			 $url = doUrl(false, $row->slug, "category");
			  
			  $smap .= "<url>\r\n";
			  $smap .= "<loc>" . $url . "</loc>\r\n";
			  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $smap .= "<changefreq>weekly</changefreq>\r\n";
			  $smap .= "</url>\r\n";
		  }
		  unset($row);
		  $smap .= "</urlset>";
		  
		  return $smap;
	  }
	  
      /**
       * Content::writeSiteMap()
       * 
       * @return
       */
	  public function writeSiteMap()
	  {
		  
		  $filename = BASEPATH . 'sitemap.xml';
		  if (is_writable($filename)) {
			  file_put_contents($filename, $this->createSiteMap());
			  $json['type'] = 'success';
			  $json['message'] = Filter::msgOk(Lang::$word->MAP_CREATED, false);
		  } else {
			  $json['type'] = 'error';
			  $json['message'] = Filter::msgAlert(str_replace("[FILENAME]", $filename, Lang::$word->MAP_ERROR), false);
		  }
		  
		  print json_encode($json);
	  }
			  
      /**
       * Content::topFive()
       * 
       * @return
       */
      public function topFive()
      {
          $sql = "SELECT title, hits FROM " . self::lTable . " ORDER BY hits DESC LIMIT 5";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }

      /**
       * Content::getHomePage()
       * 
       * @return
       */
      public function getHomePage()
      {
          $sql = "SELECT * FROM " . self::pTable . " WHERE home_page = 1";
          $row = self::$db->first($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::getSingleCategory()
       * 
       * @return
       */
      public function getSingleCategory()
      {

		  $sql = "SELECT *"
		  . "\n FROM " . self::cTable
		  . "\n WHERE slug = '" . $this->catname . "'";
          $row = self::$db->first($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::getItemsByCategory()
       * 
       * @return
       */
      public function getItemsByCategory($id)
      {

		  $pager = Paginator::instance();
		  
		  $counter = countEntries(self::lTable, "category" ,$id);
		  $pager->items_total = $counter;
		  $pager->default_ipp = Registry::get("Core")->ipp;

		  $psort = (isset($_GET['sort'])) ? "&amp;sort=" . sanitize($_GET['sort']) : null;
		  $porder = (isset($_GET['order'])) ? "&amp;order=" . sanitize($_GET['order']) : null;
		  $ptype = (isset($_GET['type'])) ? "&amp;type=" . sanitize($_GET['type']) : null;
		  $psep = (isset($_GET['sort'])) ? "?" : null;
		  $path_after = $psort.$porder.$ptype;
		  
		  $pager->path_after = $psep.$path_after;
		  $pager->path = (isset($_GET['sort'])) ? SITEURL . '/category/' . $this->catname . '/' : SITEURL . '/category/' . $this->catname . '/';
		  $pager->paginate();
		  
		  if (isset($_GET['sort'])) {
			  $sort = sanitize($_GET['sort'],8);
			  if (in_array($sort, array("created", "title", "price", "year", "milege"))) {
				  $sorting = ($sort == "title") ? "title" : "l." . $sort;
			  } else {
				  $sorting = " l.created";
			  }  
		  } else {
			  $sorting = " l.created";
		  }

		  if (isset($_GET['order'])) {
			  $ord = sanitize($_GET['order'],4);
			  $ord = strtolower($ord);
			  if (in_array($ord, array("asc", "desc"))) {
				  $order = ($ord == 'desc') ? "DESC" : "ASC";
			  } else {
				  $order = "DESC";
			  }  
		  } else {
			  $order = "DESC";
		  }
		  
          $sql = "SELECT l.*, l.id AS id, cd.name as cond"
		  . "\n FROM " . self::lTable . " as l"
		  . "\n LEFT JOIN " . self::cdTable . "  AS cd ON cd.id = l.condition"
		  . "\n WHERE category = $id"
		  . "\n ORDER BY $sorting $order" . $pager->limit;
		 $row = self::$db->fetch_all($sql); 
		 
		 return ($row) ? $row : 0; 
      }

	  /**
	   * Content::renderCategoryFilter()
	   * 
	   * @return
	   */
      public static function renderCategoryFilter($link, $page)
	  {
		  $sort = isset($_GET['sort']) ? sanitize($_GET['sort']): "created";
		  $order = isset($_GET['order']) ? sanitize($_GET['order']): "desc";
		  $type = isset($_GET['type']) ? sanitize($_GET['type']): "list";
		  $pg = !empty($_GET['pg']) ? sanitize($_GET['pg'] . '/?'): null;
		  
		  $link = $link.$pg;

		  $sort_by = array(
			  array(
				  'name' => Lang::$word->DATE,
				  'href' => parseUrl($link . '&amp;sort=created', $page),
				  'is_selected' => ($sort == 'created' ? true : false)),
			  array(
				  'name' => Lang::$word->TITLE,
				  'href' => parseUrl($link . '&amp;sort=title', $page),
				  'is_selected' => ($sort == 'title' ? true : false)),
			  array(
				  'name' => Lang::$word->MILEAGE,
				  'href' => parseUrl($link . '&amp;sort=milege', $page),
				  'is_selected' => ($sort == 'milege' ? true : false)),
			  array(
				  'name' => Lang::$word->YEAR,
				  'href' => parseUrl($link . '&amp;sort=year', $page),
				  'is_selected' => ($sort == 'year' ? true : false)),
			  array(
				  'name' => Lang::$word->PRICE,
				  'href' => parseUrl($link . '&amp;sort=price', $page),
				  'is_selected' => ($sort == 'price' ? true : false))
			  );
			  
		  $link .= '&amp;sort='. $sort;

		  $orders = array(
			  array(
				  'name' => Lang::$word->DESC,
				  'href' => parseUrl($link . '&amp;order=desc', $page),
				  'is_selected' => ($order == 'desc' ? true : false)), 
			  array(
				  'name' => Lang::$word->ACS,
				  'href' => parseUrl($link . '&amp;order=asc', $page),
				  'is_selected' => ($order == 'asc' ? true : false))
			  );
			  
		  $link .= '&amp;order='. $order;

		  $types = array(
			  array(
				  'name' => Lang::$word->GRID,
				  'href' => parseUrl($link . '&amp;type=grid', $page),
				  'is_selected' => ($type == 'grid' ? true : false)), 
			  array(
				  'name' => Lang::$word->LIST,
				  'href' => parseUrl($link . '&amp;type=list', $page),
				  'is_selected' => ($type == 'list' ? true : false))
			  );  
			  
			  return array($sort_by, $orders, $types);
	  }

      /**
       * Content::getMakeList()
       * 
       * @return
       */
      public function getMakeList()
      {
          $sql = "SELECT m.*"
		  . "\n FROM " . self::mTable . " as m"
		  . "\n LEFT JOIN " . self::lTable . " AS l ON l.make_id = m.id" 
		  . "\n WHERE l.status = 1"
		  . "\n GROUP BY m.id ORDER BY m.name";
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::getSearchResults()
       * 
       * @return
       */
      public function getSearchResults()
      {
		  $and = null;
		  if (isset($_GET['make_id'])) {
			  $make_id = intval($_GET['make_id']);
			  $and .= ($make_id) ? " AND l.make_id = " . $make_id : null;
		  }

		  if (isset($_GET['make_id'])) {
			  $model_id = intval($_GET['model_id']);
			  $and .= ($model_id) ? " AND model_id = " . $model_id : null;
		  }

		  if (isset($_GET['year_from']) and isset($_GET['year_to'])) {
			  $year_from = intval($_GET['year_from']);
			  $year_to = intval($_GET['year_to']);
			  $and .= " AND year BETWEEN " . $year_from . " AND " . $year_to;
		  } else {
			  if (isset($_GET['year_from'])) {
				  $and .= ($year_from) ? " AND YEAR(year) = " . $year_from : null;
			  } else if (isset($_GET['year_to'])) {
				  $and .= ($year_to) ? " AND YEAR(year) = " . $year_to : null;
			  } 
		  }

		  if (isset($_GET['price_range'])) {
			  $price = sanitize($_GET['price_range']);
			  $data = explode(";", $price);
			  if(count($data) == 2) {
				  $and .= " AND price_sale BETWEEN " . $data[0] . " AND " . $data[1];
			  }
		  }

		  if (isset($_GET['km_range'])) {
			  $kms = sanitize($_GET['km_range']);
			  $kdata = explode(";", $kms);
			  if(count($kdata) == 2) {
				  $and .= " AND milege BETWEEN " . $kdata[0] . " AND " . $kdata[1];
			  }
		  }

		  if (isset($_GET['category'])) {
			  $cats = self::_implodeFields($_GET['category']);
			  $ctegory = sanitize($cats);
			  $and .= " AND category IN (" . $ctegory . ")";
		  }

		  if (isset($_GET['color'])) {
			  $cols =  implode("','", $_GET['color']);
			  $colors = sanitize($cols);
			  $and .= " AND color_e IN ('$cols')";
		  }
		  
		  $q = "SELECT COUNT(*) FROM " . self::lTable . " as l WHERE status = 1 $and";
		  
          $record = self::$db->query($q);
          $total = self::$db->fetchrow($record);
          $counter = $total[0];
		  
		  $pager = Paginator::instance();
		  $pager->items_total = $counter;
		  $pager->default_ipp = Registry::get("Core")->ipp;
		  $pager->paginate();
		  
          $sql = "SELECT l.*, l.id AS id, CONCAT(m.name,' ',md.name) as name, md.make_id as mid"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::mTable . " AS m ON m.id = l.make_id" 
		  . "\n LEFT JOIN " . self::mdTable . "  AS md ON md.id = l.model_id"
		  . "\n WHERE status = 1"
		  . "\n $and"
		  . "\n ORDER BY l.created DESC" . $pager->limit;
		  
		 $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::getContent()
       * 
       * @return
       */
      public function getContent()
      {
          $sql = "SELECT * FROM " . self::pTable . " WHERE slug = '{$this->pageslug}' AND active = 1";
          $row = self::$db->first($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::renderListing()
       * 
       * @return
       */
      public function renderListing()
      {
          
          $sql = "SELECT l.*, li.*, c.*, l.id AS lid, CONCAT(li.make_name,' ',li.model_name) as name, cd.name as catname, cd.slug as catslug"
		  . "\n FROM ".self::lTable." as l"
		  . "\n LEFT JOIN " . self::liTable . " AS li ON li.listing_id = l.id" 
		  . "\n LEFT JOIN " . self::lcTable . " AS c ON c.id = l.location" 
		  . "\n LEFT JOIN " . self::cTable . " AS cd ON cd.id = l.category" 
		  . "\n WHERE l.idx = {$this->idx} AND l.slug = '{$this->itemslug}'";
		  
		 $row = self::$db->first($sql);

          if ($row) {
			  $this->doHits($row->lid);
              return $row;
          } else
              return 0;
      }

      /**
       * Content::doHits()
       * 
       * @return
       */
      private function doHits($id)
      {
          $data['hits'] = "INC(1)";
          self::$db->update(self::lTable, $data, "id = $id");
          
      }
	  
	  /**
	   * Content::_implodeFields()
	   * 
	   * @param mixed $array
	   * @return
	   */
	  public static function _implodeFields($array, $sep = ',')
	  {
          if (is_array($array)) {
			  $result = array();
			  foreach ($array as $row) {
				  if ($row != '') {
					  array_push($result, sanitize($row));
				  }
			  }
			  return implode($sep, $result);
          }
		  return false;
	  }

	  /**
	   * Content::getCoreMeta()
	   * 
	   * @return
	   */
	  private function getCoreMeta($row)
	  {
		  
		  $meta = '';
		  $sep = " | ";
		  $site = Registry::get("Core")->company;
		  $meta .= "<title>";
		  if ($this->catname and $row) {
			  $meta .= $row->name . $sep . $site;
		  } elseif (preg_match('/item.php/', $_SERVER['PHP_SELF']) and $row) {
			  $meta .= $row->year . ' ' . $row->title . $sep . $site;
		  } elseif ($this->pageslug and $row) {
			  $meta .= $row->title . $sep . $site;
		  } elseif (preg_match('/search.php/', $_SERVER['PHP_SELF'])) {
			  $meta .= Lang::$word->FRONT_SEARCH . $sep . $site;
		  } else {
			  $meta .= Registry::get("Core")->site_name;
		  }
		  $meta .= "</title>\n";
		  $meta .= "<meta name=\"keywords\" content=\"";
		  if ($this->catname and $row) {
			 $meta .= Registry::get("Core")->metakeys;
		  } elseif (preg_match('/item.php/', $_SERVER['PHP_SELF']) and $row) {
			  if ($row->metakey) {
				  $meta .= $row->metakey;
			  } else {
				  $meta .= Registry::get("Core")->metakeys;
			  }
		  } elseif ($this->pageslug and $row) {
			  $meta .= Registry::get("Core")->metakeys;
		  } else{
			  $meta .= Registry::get("Core")->metakeys;
		  }
		  $meta .= "\" />\n";
		  $meta .= "<meta name=\"description\" content=\"";
		  if ($this->catname and $row) {
			  $meta .= Registry::get("Core")->metadesc;
		  } elseif (preg_match('/item.php/', $_SERVER['PHP_SELF']) and $row) {
			  if ($row->metadesc) {
				  $meta .= $row->metadesc;
			  } else {
				  $meta .= cleanSanitize($row->description, 250);
			  }
		  } elseif ($this->pageslug and $row) {
			  $meta .= Registry::get("Core")->metadesc;
		  } else{
			  $meta .= Registry::get("Core")->metadesc;
		  }
		$meta .= "\" />\n";
		
		return $meta;
	  }
	  
      /**
       * Content::getMeta()
       * 
       * @return
       */ 
	  public function getMeta($row)
	  {
		  $meta = '';
		  $meta = "<meta charset=\"utf-8\">\n";
		  $meta .= $this->getCoreMeta($row);
		  
		  $meta .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">";
		  $meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"" .SITEURL ."/assets/favicon.ico\" />\n";
		  $meta .= "<link rel=\"icon\" type=\"image/png\" href=\"" .SITEURL ."/assets/favicon.png\" />\n";
		  $meta .= "<meta name=\"dcterms.rights\" content=\"" . Registry::get("Core")->company . " &copy; All Rights Reserved\" >\n";
		  $meta .= "<meta name=\"robots\" content=\"index, follow\" />\n";
		  $meta .= "<meta name=\"revisit-after\" content=\"1 day\" />\n";
		  $meta .= "<meta name=\"generator\" content=\"Powered by CDP v" . Registry::get("Core")->ver . "\" />\n";
		  return $meta;
	  }
	  
      /**
       * Content::getVisitors()
       * 
       * @return
       */
      public function getVisitors()
      {
          if (@getenv("HTTP_CLIENT_IP")) {
              $vInfo['ip'] = getenv("HTTP_CLIENT_IP");
          } elseif (@getenv("HTTP_X_FORWARDED_FOR")) {
              $vInfo['ip'] = getenv('HTTP_X_FORWARDED_FOR');
          } elseif (@getenv('REMOTE_ADDR')) {
              $vInfo['ip'] = getenv('REMOTE_ADDR');
          } elseif (isset($_SERVER['REMOTE_ADDR'])) {
              $vInfo['ip'] = $_SERVER['REMOTE_ADDR'];
          } else {
              $vInfo['ip'] = "Unknown";
          }

          if (!preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/i", $vInfo['ip']) &&
              $vInfo['ip'] != "Unknown") {
              $pos = strpos($vInfo['ip'], ",");
              $vInfo['ip'] = substr($vInfo['ip'], 0, $pos);
              if ($vInfo['ip'] == "")
                  $vInfo['ip'] = "Unknown";
          }

          $vInfo['ip'] = str_replace("[^0-9\.]", "", $vInfo['ip']);
          setcookie("CDP_HITS", time(), time() + 3600);
          $vCookie['is_cookie'] = (isset($_COOKIE['CDP_HITS'])) ? 1 : 0;
          $date = date('Y-m-d');

          if ($row = Registry::get("Database")->first("SELECT * FROM " . self::stTable . " WHERE DATE(day)='" . $date . "'")) {
              $hid = intval($row->id);
              $pageviews = $row->pageviews;
              $unique = $row->uniquevisitors;

              $stats['pageviews'] = "INC(1)";
              Registry::get("Database")->update(self::stTable, $stats, "id='" . $hid . "'");

              if (!isset($_COOKIE['CDP_UNIQUE']) && $vCookie['is_cookie']) {
                  setcookie("CDP_UNIQUE", time(), time() + 3600);
                  $stats['uniquevisitors'] = "INC(1)";
                  Registry::get("Database")->update(self::stTable, $stats, "id='" . $hid . "'");
              }
          } else {
              $istats = array(
                  'day' => "NOW()",
                  'pageviews' => 1,
                  'uniquevisitors' => 1,
              );
              Registry::get("Database")->insert(self::stTable, $istats);
          }
      }
  }
?>