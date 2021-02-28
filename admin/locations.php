<?php
  /**
   * Locations
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: locations.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
   
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = Core::getRowById(Content::lcTable, Filter::$id);?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<h1 class="main-header"><?php echo Lang::$word->LOC_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=locations" class="section"><?php echo Lang::$word->ADM_LOCS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LOC_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="showroom"><i class="icon help"></i></a> <i class="map marker icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LOC_EDIT;?> </div>
    <p><?php echo Lang::$word->LOC_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->LOC_SUB . $row->name;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->LOC_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->name;?>" name="name">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->email;?>" name="email">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_ADDRESS;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->address;?>" name="address">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_CITY;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->city;?>" name="city">
        </label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_STATE;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->state;?>" name="state">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_ZIP;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" value="<?php echo $row->zip;?>" name="zip">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LOC_COUNTRY;?></label>
        <input type="text" value="<?php echo $row->country;?>" name="country">
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_PHONE;?></label>
        <input type="text" value="<?php echo $row->phone;?>" name="phone">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FAX;?></label>
        <input type="text" value="<?php echo $row->fax;?>" name="fax">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_URL;?></label>
        <input type="text" value="<?php echo $row->url;?>" name="url">
      </div>
    </div>
    <div class="field">
      <div style="position:absolute;z-index:5000;right:.5em;top:.5em">
        <div class="wojo action input">
          <input placeholder="<?php echo Lang::$word->SEARCH;?>" type="text" name="adrs" id="address">
          <a id="lookup" class="wojo icon button"><i class="search icon"></i></a> </div>
      </div>
      <div id="map" style="width:100%;height:350px;z-index:4000"></div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->LOC_UPDATE;?></button>
    <a href="index.php?do=locations" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processLocation" type="hidden" value="1" />
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>">
    <input name="lat" id="lat" type="hidden" value="<?php echo $row->lat;?>">
    <input name="lng" id="lng" type="hidden" value="<?php echo $row->lng;?>">
    <input name="zoom" id="zoomlevel" type="hidden" value="<?php echo $row->zoom;?>">
  </form>
</div>
<div id="msgholder"></div>
<script type="text/javascript"> 
// <![CDATA[
 var map = null;
  $(document).ready(function () {
	  var geocoder;
	  geocoder = new google.maps.Geocoder();
	  var latitude = parseFloat("<?php echo $row->lat;?>");
	  var longitude = parseFloat("<?php echo $row->lng;?>");
	  loadMap(latitude, longitude);
	  setupMarker(latitude, longitude);

	  $('#lookup').click(function () {
		  var address = document.getElementById('address').value;
		  geocoder.geocode({
			  'address': address
		  }, function (results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				  map.setCenter(results[0].geometry.location);
				  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
				  var marker = new google.maps.Marker({
					  map: map,
					  draggable: true,
					  raiseOnDrag: false,
					  icon: image,
					  position: results[0].geometry.location
				  });

				  $("#lat").val(results[0].geometry.location.lat());
				  $("#lng").val(results[0].geometry.location.lng());
			  
				  google.maps.event.addListener(marker, 'dragend', function (event) {
					  $("#lat").val(this.getPosition().lat());
					  $("#lng").val(this.getPosition().lng());
				  });			  
			  } else {
                  $.sticky('Geocode was not successful for the following reason: ' + status,{type: 'error'});
			  }

		  });
	  });

	  google.maps.event.addListener(map, 'zoom_changed', function () {
		  document.getElementById('zoomlevel').value = map.getZoom();
	  });
  });
   // Loads the maps
  loadMap = function (latitude, longitude) {
	  var latlng = new google.maps.LatLng(latitude, longitude);
	  var myOptions = {
		  zoom: <?php echo $row->zoom;?>,
		  center: latlng,
		  mapTypeControl: false,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map"), myOptions);
  }
  
  setupMarker = function (latitude, longitude) {
	  var pos = new google.maps.LatLng(latitude, longitude);
	  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
	  var marker = new google.maps.Marker({
		  position: pos,
		  map: map,
          draggable: true,
          raiseOnDrag: false,
		  icon: image,
		  title: name
	  });
	  google.maps.event.addListener(marker, 'dragend', function (event) {
		  $("#lat").val(this.getPosition().lat());
		  $("#lng").val(this.getPosition().lng());
	  });
  }
</script>
<?php break;?>
<?php case"add": ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<h1 class="main-header"><?php echo Lang::$word->LOC_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=locations" class="section"><?php echo Lang::$word->ADM_LOCS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->LOC_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="showroom"><i class="icon help"></i></a> <i class="map marker icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LOC_ADD;?> </div>
    <p><?php echo Lang::$word->LOC_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->LOC_SUB1;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->LOC_NAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->LOC_NAME;?>" name="name">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->EMAIL;?>" name="email">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_ADDRESS;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_ADDRESS;?>" name="address">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_CITY;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_CITY;?>" name="city">
        </label>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_STATE;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_STATE;?>" name="state">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_ZIP;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_ZIP;?>" name="zip">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LOC_COUNTRY;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->LOC_COUNTRY;?>" name="country">
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_PHONE;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_PHONE;?>" name="phone">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FAX;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_FAX;?>" name="fax">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_URL;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_URL;?>" name="url">
      </div>
    </div>
    <div class="field">
      <div style="position:absolute;z-index:5000;right:.5em;top:.5em">
        <div class="wojo action input">
          <input placeholder="<?php echo Lang::$word->SEARCH;?>" type="text" name="adrs" id="address">
          <a id="lookup" class="wojo icon button"><i class="search icon"></i></a> </div>
      </div>
      <div id="map" style="width:100%;height:350px;z-index:4000"></div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->LOC_ADD;?></button>
    <a href="index.php?do=locations" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processLocation" type="hidden" value="1" />
    <input name="lat" id="lat" type="hidden" value="0">
    <input name="lng" id="lng" type="hidden" value="0">
    <input name="zoom" id="zoomlevel" type="hidden" value="14">
  </form>
</div>
<div id="msgholder"></div>
<script type="text/javascript"> 
// <![CDATA[
 var map = null;
  $(document).ready(function () {
	  var geocoder;
	  geocoder = new google.maps.Geocoder();
	  var latitude = 43.652527;
	  var longitude = -79.381961;
	  loadMap(latitude, longitude);

	  $('#lookup').click(function () {
		  var address = document.getElementById('address').value;
		  geocoder.geocode({
			  'address': address
		  }, function (results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				  map.setCenter(results[0].geometry.location);
				  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
				  var marker = new google.maps.Marker({
					  map: map,
					  draggable: true,
					  raiseOnDrag: false,
					  icon: image,
					  position: results[0].geometry.location
				  });
				  $("#lat").val(results[0].geometry.location.lat());
				  $("#lng").val(results[0].geometry.location.lng());
			  
				  google.maps.event.addListener(marker, 'dragend', function (event) {
					  $("#lat").val(this.getPosition().lat());
					  $("#lng").val(this.getPosition().lng());
				  });			  
			  } else {
				  $.sticky('Geocode was not successful for the following reason: ' + status,{type: 'error'});
			  }

		  });
	  });

	  google.maps.event.addListener(map, 'zoom_changed', function () {
		  document.getElementById('zoomlevel').value = map.getZoom();
	  });
  });
   // Loads the maps
  loadMap = function (latitude, longitude) {
	  var latlng = new google.maps.LatLng(latitude, longitude);
	  var myOptions = {
		  zoom: 13,
		  center: latlng,
		  mapTypeControl: false,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map"), myOptions);
  }
// ]]>
</script>
<?php break;?>
<?php default: ?>
<?php $locrow = $content->getLocations();?>
<a class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->LOC_ADD;?>" href="index.php?do=locations&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->LOC_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->ADM_LOCS;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="map marker icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->LOC_SUB2;?> </div>
    <p><?php echo Lang::$word->LOC_INFO2;?></p>
  </div>
</div>
<?php if(!$locrow):?>
<?php echo Filter::msgSingleInfo(Lang::$word->LOC_NOLOC);?>
<?php else:?>
<div class="three columns small-gutters">
  <?php foreach($locrow as $row):?>
  <div class="row">
    <div class="wojo segment">
      <h4><?php echo $row->name;?></h4>
      <div class="wojo top right attached label">
        <div class="wojo right pointing dropdown"><i class="setting icon"></i>
          <div class="menu"> <a class="item" href="index.php?do=locations&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="edit icon"></i> <?php echo Lang::$word->EDIT;?></a> <a class="ldelete item" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="icon trash"></i> <?php echo Lang::$word->DELETE;?></a> </div>
        </div>
      </div>
      <div class="wojo divided list">
        <div class="item"><i class="icon building"></i><?php echo $row->address;?></div>
        <div class="item"><i class="icon building"></i><?php echo $row->city . ' ' . $row->state . ', ' . $row->zip;?></div>
        <div class="item"><i class="icon building"></i><?php echo $row->country;?></div>
        <div class="item"><i class="icon mail"></i><a href="index.php?do=mailer&amp;emailid=<?php echo urlencode($row->email);?>"><?php echo $row->email;?></a></div>
        <div class="item"><i class="icon globe"></i><?php echo $row->url;?></div>
        <div class="item"><i class="icon phone"></i>p: <?php echo $row->phone;?></div>
        <div class="item"><i class="icon phone"></i>f: <?php echo $row->fax;?></div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>