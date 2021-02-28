<?php
  /**
   * Contact
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: contact.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  $locrow = $content->getLocations();
?>
<!-- Start Content-->
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="wojo breadcrumb">
      <div class="section"><?php echo Lang::$word->ADM_CONTENT;?></div>
      <div class="divider"> / </div>
      <a class="active section"><?php echo $row->title;?></a></div>
    <div class="wojo divider"></div>
    <div class="wojo fitted segment">
      <div id="map" style="width:100%;height:350px"></div>
    </div>
    <div class="wojo section divider"></div>
    <div class="columns gutters">
      <div class="screen-40 tablet-50 phone-100">
        <div class="wojo black message">
          <h4 class="wojo header"><?php echo $row->title;?></h4>
          <div class="wojo inverted divider"></div>
          <div class="wojo list">
            <p class="item"><i class="icon map marker"></i> <?php echo $core->address;?>, <?php echo $core->city;?>, <?php echo $core->state;?> <?php echo $core->zip;?> </p>
            <p class="item"><i class="icon phone"></i> <?php echo $core->phone;?></p>
            <?php if($core->fax):?>
            <p class="item"><i class="icon phone"></i> <?php echo $core->phone;?></p>
            <?php endif;?>
            <p class="item"><i class="icon mail"></i> <?php echo $core->site_email;?></p>
          </div>
          <div class="wojo inverted divider"></div>
          <?php echo cleanOut($row->body);?> </div>
      </div>
      <div class="screen-60 tablet-50 phone-100">
        <div class="wojo tertiary form segment">
          <h4 class="wojo header"><?php echo $row->title;?></h4>
          <div class="wojo inverted divider"></div>
          <form method="post" id="quick_form" name="quick_form">
            <div class="field">
              <label class="input"><i class="icon-prepend icon user"></i> <i class="icon-append icon asterisk"></i>
                <input type="text" placeholder="<?php echo Lang::$word->WDG_CF_NAME;?>" name="name">
              </label>
            </div>
            <div class="field">
              <label class="input"> <i class="icon-prepend icon mail"></i> <i class="icon-append icon asterisk"></i>
                <input type="text" placeholder="<?php echo Lang::$word->WDG_CF_EMAIL;?>" name="email">
              </label>
            </div>
            <div class="field">
              <label class="input"> <i class="icon-prepend icon chat"></i> <i class="icon-append icon asterisk"></i>
                <input type="text" placeholder="<?php echo Lang::$word->WDG_CF_SUB;?>" name="subject">
              </label>
            </div>
            <div class="field">
              <label class="textarea"> <i class="icon-append icon asterisk"></i>
                <textarea name="message" placeholder="<?php echo Lang::$word->WDG_CF_MSG;?>"></textarea>
              </label>
            </div>
            <div class="field">
              <button class="wojo positive button" type="submit"><?php echo Lang::$word->WDG_CF_SEND;?></button>
            </div>
            <input name="main_contact" type="hidden" value="1">
          </form>
        </div>
      </div>
    </div>
    <div id="emsg"></div>
  </div>
</div>
<?php if($locrow):?>
<div class="sub-footer">
  <div class="wojo-grid">
    <div class="wojo-content">
      <h3 class="wojo header shadow content-center"><?php echo Lang::$word->WDG_OTHER;?></h3>
      <div class="<?php echo numberToWords(count($locrow));?> columns gutters">
        <?php foreach($locrow as $row):?>
        <div class="row">
          <div class="wojo tertiary segment">
            <h4><?php echo $row->name;?></h4>
            <div class="wojo divided list">
              <div class="item"><i class="icon building"></i><?php echo $row->address;?></div>
              <div class="item"><i class="icon building"></i><?php echo $row->city . ' ' . $row->state . ', ' . $row->zip;?></div>
              <div class="item"><i class="icon building"></i><?php echo $row->country;?></div>
              <div class="item"><i class="icon mail"></i><?php echo $row->email;?></div>
              <div class="item"><i class="icon globe"></i><?php echo $row->url;?></div>
              <div class="item"><i class="icon phone"></i>p: <?php echo $row->phone;?></div>
              <?php if ($row->fax):?>
              <div class="item"><i class="icon phone"></i>f: <?php echo $row->fax;?></div>
              <?php endif;?>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script> 
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(43.652527, -79.381961),
        zoom: 15,
        mapTypeControl: false,
        streetViewControl: true,
        overviewMapControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var address = "<?php echo $core->address . ',' . $core->city . ',' . $core->state . ',' . $core->zip;?>";
    geocoder.geocode({
        'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                title: "<?php echo $core->address . ',' . $core->city . ',' . $core->state . ',' . $core->zip;?>",
                position: results[0].geometry.location,
                draggable: false,
                raiseOnDrag: false,
                icon: image
            });
        }
    });

	var options = {
		target: "#emsg",
		beforeSubmit:  showLoader,
		success: showResponse,
		url: SITEURL + "/ajax/controller.php",
		dataType: 'json'
	};
	$('#quick_form').ajaxForm(options);
});
	function showResponse(json) {
		if (json.type == "success") {
			$(".wojo.form").removeClass("loading");
			$("#emsg").html(json.message);
			$("#quick_form").slideUp();
		} else {
			$(".wojo.form").removeClass("loading");
			$("#emsg").html(json.message);
		}
	}
	function showLoader() {
		$(".wojo.form").addClass("loading");
	}
// ]]>
</script>