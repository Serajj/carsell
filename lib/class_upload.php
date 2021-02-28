<?php
  /**
   * Uploader Class
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2011
   * @version $Id: class_upload.php,v 1.00 2011-06-01 21:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class Uploader
  {
	  const maxFile = 6145728;
	  const imgDir = "listings/pics";
	  private static $fileTypes = array("jpg","jpeg","png");

      /**
       * Uploader::__construct()
       * 
       * @return
       */
	  function __construct()
      {
      }

	  
	  /**
	   * Uploader::doUpload()
	   * 
	   * @return
	   */
	  public function doUpload($filename, $id)
	  {
		  $path = UPLOADS . self::imgDir.$id . '/';
	
		  if (isset($_FILES[$filename]) && $_FILES[$filename]['error'] == 0) {
	
			  $extension = pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
			  if (!in_array(strtolower($extension), self::$fileTypes)) {
				  $json['status'] = "error";
				  $json['msg'] = $json['msg'] = str_replace("[EXT]", $extension, Lang::$word->FM_FILE_ERR5);
				  print json_encode($json);
				  exit;
			  }
	
			  if (file_exists($path . $_FILES[$filename]['name'])) {
				  $json['status'] = "error";
				  $json['msg'] = Lang::$word->FM_FILE_ERR1;
				  print json_encode($json);
				  exit;
			  }
	
			  if (!is_writeable($path)) {
				  $json['status'] = "error";
				  $json['msg'] = Lang::$word->FM_FILE_ERR2;
				  print json_encode($json);
				  exit;
			  }
	
			  if (!is_dir($path)) {
				  $json['status'] = "error";
				  $json['msg'] = Lang::$word->FM_FILE_ERR4;
				  print json_encode($json);
				  exit;
			  }
	
			  if (self::maxFile != null && self::maxFile < $_FILES[$filename]['size']) {
				  $json['status'] = "error";
				  $json['msg'] = str_replace("[LIMIT]", self::getSize(self::maxFile), Lang::$word->FM_FILE_ERR3);
				  print json_encode($json);
				  exit;
			  }
	
			  $html = '';

			  $newName = "IMG_" . randName();
			  $fdata = pathinfo($_FILES[$filename]['name']);
			  $fullname = $path . $newName . "." . strtolower($fdata['extension']);
				  
			  if (move_uploaded_file($_FILES[$filename]['tmp_name'], $fullname)) {
			  
				  $data = array(
					  'listing_id' => $id,
					  'title' => sanitize($fdata['filename']),
					  'photo' => $newName . "." . strtolower($fdata['extension']),
					  );
	
				  $last_id = Registry::get("Database")->insert(Content::gTable, $data);
	
				  $html .= '
				  <div class="row">
					<div class="wojo basic image reveal slide"> <img src="' . SITEURL . '/thumbmaker.php?src=' . UPLOADURL.'/listings/pics' . $id . '/'.$data['photo'] . '&amp;w=400&amp;h=250" alt="">
					  <div class="mask">
						<div class="content"><a class="editinfo" data-id="' . $last_id . '" data-title="' . $data['title'] . '"><i class="circular success large inverted pencil icon link"></i></a> <a href="' . UPLOADURL.'/listings/pics' . Filter::$id . '/' . $data['photo'] . '" class="lightbox" title="' . $data['title'] . '"><i class="circular info large inverted unhide icon link"></i></a> <a class="imgdelete" data-lid="' . Filter::$id . '" data-id="' . $last_id . '" data-name="' . $data['title'] . '"><i class="circular danger large inverted trash icon link"></i></a></div>
					  </div>
					  <div class="caption"><span class="editable" contenteditable="true" data-id="' . $last_id . '" data-edit-type="gallery">' . $data['title'] . '</span></div>
					</div>
				  </div>';
	
				  $json['status'] = "success";
				  $json['msg'] = $html;
				  print json_encode($json);
				  exit;
			  }
		  }
	
		  $json['status'] = "error";
		  exit;
	  }

  }
?>