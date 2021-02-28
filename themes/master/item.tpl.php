<?php
  /**
   * Item
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: item.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
	  $galdata = $content->getGallery($row->lid);
	  $featurerow = $content->getFeaturesById($row->features);
?>
<!-- Start Content-->
<div class="wojo-grid">
  <div class="wojo-content">
  <a class="wojo negative label push-right" data-content="Print Summary" onclick="javascript:void window.open('<?php echo SITEURL;?>/print.php?id=<?php echo $row->lid;?>','printer','width=880,height=600,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;"><i class="icon print"></i> <?php echo Lang::$word->PRINT;?></a>
    <div class="wojo breadcrumb">
      <div class="section"><?php echo Lang::$word->FRT_LIST;?></div>
      <div class="divider"> / </div>
      <a href="<?php echo doUrl(false, $row->catslug, "category");?>" class="active section"><?php echo $row->catname;?></a>
      <div class="divider"> / </div>
      <a class="active section"><?php echo $row->title;?></a> </div>
    <div class="wojo divider"></div>
    <div class="columns horizontal-gutters">
      <div class="screen-50 tablet-50 phone-100">
        <div class="wojo tetriary segment">
          <?php if($row->featured):?><div class="wojo ribbon"><div class="ribbon negative inverted"><?php echo Lang::$word->FEATURED;?></div></div><?php endif;?>
          <div class="wojo-carousel" 
        data-pagination="false" 
        data-navigation="true" 
        data-single-item="true"
        data-auto-play="false"
        data-transition-style="fade"
        data-gallery="true"
        >
            <?php if($row->thumb):?>
            <section> <a href="<?php echo UPLOADURL.'/listings/'.$row->thumb;?>" title="<?php echo $row->title;?>"><img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/'.$row->thumb;?>&amp;w=600&amp;h=400" alt=""></a>
              <h4 class="wojo header"><?php echo $row->title;?></h4>
            </section>
            <?php else:?>
            <section> <img src="<?php echo UPLOADURL;?>/listings/nopic.jpg" alt="">
              <p><?php echo $row->title;?></p>
            </section>
            <?php endif;?>
            <?php if($galdata):?>
            <?php foreach ($galdata as $grow):?>
            <section><a href="<?php echo UPLOADURL.'/listings/pics'.$row->lid . '/'.$grow->photo;?>" title="<?php echo $grow->title;?>"><img src="<?php echo SITEURL;?>/thumbmaker.php?src=<?php echo UPLOADURL.'/listings/pics' . $row->lid . '/'.$grow->photo;?>&amp;w=600&amp;h=400" alt=""></a>
              <h4 class="wojo header"><?php echo $grow->title;?></h4>
            </section>
            <?php endforeach;?>
            <?php endif;?>
          </div>
        </div>
      </div>
      <div class="screen-50 tablet-50 phone-100">
        <div class="wojo black message">
          <?php if(compareNumbers($row->price_sale, $row->price, '<')):?>
          <div class="wojo top right success large attached label"><?php echo $core->formatMoney($row->price_sale);?></div>
          <?php endif;?>
          <p><span<?php if(compareNumbers($row->price_sale, $row->price, '<')):?> class="strike inverted"<?php endif;?>><?php echo $core->formatMoney($row->price);?></span></p>
          <div class="wojo inverted divider"></div>
          <div class="wojo three cols horizontal inverted divided list">
            <div class="item"> <i class="icon calendar"></i> <?php echo Filter::doDate("short_date",$row->created);?> </div>
            <div class="item"> <i class="icon dashboard"></i> <?php echo number_format($row->milege, 0, '.', '.');?></div>
            <div class="item"> <i class="icon lab"></i> <?php echo $row->engine;?></div>
          </div>
          <div class="wojo inverted divider"></div>
          <h4 class="content-center"><?php echo $row->year;?> <?php echo $row->make_name;?> <?php echo $row->model_name;?><span class="subtext">#<?php echo $row->stock_id;?></span></h4>
          <div class="wojo inverted divided list">
            <div class="item">
              <div class="right floated"><?php echo $row->fuel_name;?></div>
              <div class="content"> <?php echo Lang::$word->LST_FUEL;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo Core::has($row->horse_power);?></div>
              <div class="content"> <?php echo Lang::$word->LST_POWER;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo $row->trans_name;?></div>
              <div class="content"> <?php echo Lang::$word->LST_TRANS;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo Core::has($row->top_speed);?> <?php echo ($core->odometer == "km") ? 'km/h' : 'mph';?></div>
              <div class="content"> <?php echo Lang::$word->LST_SPEED;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo Core::has($row->drive_train);?></div>
              <div class="content"> <?php echo Lang::$word->LST_TRAIN;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo Core::has($row->torque);?></div>
              <div class="content"> <?php echo Lang::$word->LST_TORQUE;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo $row->color_i;?></div>
              <div class="content"> <?php echo Lang::$word->LST_INTC;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo $row->color_e;?></div>
              <div class="content"> <?php echo Lang::$word->LST_EXTC;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo $row->doors;?></div>
              <div class="content"> <?php echo Lang::$word->LST_DOORS;?> </div>
            </div>
            <div class="item">
              <div class="right floated"><?php echo $row->condition_name;?></div>
              <div class="content"> <?php echo Lang::$word->LST_COND;?> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo section divider"></div>
    <div class="wojo fitted segment">
      <div id="tabs" class="clearfix"> <a data-tab="#general"><?php echo Lang::$word->TAB_OVERVIEW;?></a> <a data-tab="#desc"><?php echo Lang::$word->TAB_DEC;?></a> <a id="ghack" data-tab="#location"><?php echo Lang::$word->TAB_CONTACT;?> </a></div>
      <div class="wojo-double-content">
        <div id="general" class="tab_content">
          <?php if($featurerow):?>
          <div class="wojo relaxed list">
            <div class="three columns small-horizontal-gutters">
              <?php foreach ($featurerow as $frow):?>
              <div class="row">
                <div class="item"><i class="icon check"></i> <?php echo $frow->name;?> </div>
              </div>
              <?php endforeach;?>
              <?php unset($frow);?>
            </div>
          </div>
          <?php endif;?>
        </div>
        <div id="desc" class="tab_content"> <?php echo cleanOut($row->body);?> </div>
        <div id="location" class="tab_content">
          <div class="columns horizontal-gutters">
            <div class="screen-50 tablet-50 phone-100">
              <div class="wojo main form">
                <form method="post" id="quick_form" name="quick_form">
                  <div class="field">
                    <label><?php echo Lang::$word->WDG_CF_S_TITLE;?></label>
                    <div class="inline-group">
                      <label class="radio">
                        <input name="title" type="radio" value="Mrs.">
                        <i></i>Mrs.</label>
                      <label class="radio">
                        <input name="title" type="radio" value="Mr." checked="checked">
                        <i></i>Mr.</label>
                      <label class="radio">
                        <input name="title" type="radio" value="<?php echo Lang::$word->WDG_CF_COMPANY;?>">
                        <i></i><?php echo Lang::$word->WDG_CF_COMPANY;?></label>
                    </div>
                  </div>
                  <div class="field">
                    <label><?php echo Lang::$word->WDG_CF_NAME;?></label>
                    <label class="input"><i class="icon-append icon asterisk"></i>
                      <input name="name" type="text" placeholder="<?php echo Lang::$word->WDG_CF_NAME;?>">
                    </label>
                  </div>
                  <div class="field">
                    <label><?php echo Lang::$word->WDG_CF_EMAIL;?></label>
                    <label class="input"><i class="icon-append icon asterisk"></i>
                      <input name="email" type="text" placeholder="<?php echo Lang::$word->WDG_CF_EMAIL;?>">
                    </label>
                  </div>
                  <div class="field">
                    <label><?php echo Lang::$word->WDG_CF_MSG;?></label>
                    <label class="textarea"><i class="icon-append icon asterisk"></i>
                      <textarea name="message" placeholder="<?php echo Lang::$word->WDG_CF_MSG;?>"></textarea>
                    </label>
                  </div>
                  <div class="field">
                    <button class="wojo positive button" type="submit"><?php echo Lang::$word->WDG_CF_SEND;?></button>
                  </div>
                  <input name="main_contact" type="hidden" value="1">
                  <input name="subject" type="hidden" value="<?php echo doUrl($row->idx, $row->slug, "item");?>">
                  <input name="toemail" type="hidden" value="<?php echo $row->email;?>">
                </form>
              </div>
              <div id="emsg"></div>
            </div>
            <div class="screen-50 tablet-50 phone-100">
              <div class="wojo form">
                <div class="field">
                  <label><?php echo Lang::$word->WDG_CF_ADDRESS;?></label>
                  <div class="wojo tertiary segment">
                    <h4><?php echo $row->location_name;?></h4>
                    <div class="wojo relaxed divided list">
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
                  <div class="wojo section divider"></div>
                  <div class="field">
                    <label><?php echo Lang::$word->WDG_CF_SHARE;?></label>
                    <div class="wojo three fluid buttons"> <a class="wojo facebook button" rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php echo doUrl($row->idx, $row->slug, "item");?>&amp;t=<?php echo urlencode($row->title);?>" title="Share this post on Facebook"><i class="facebook icon"></i>Share on Facebook</a> <a class="wojo twitter button" rel="nofollow" href="http://twitter.com/home?status=<?php echo urlencode("Currently reading: "); ?><?php echo doUrl($row->idx, $row->slug, "item");?>" title="Share this article with your Twitter followers"><i class="twitter icon"></i>Tweet this!</a> <a class="wojo google plus button" href="https://plus.google.com/share?url=<?php echo doUrl($row->idx, $row->slug, "item");?>"><i class="google plus icon"></i>Google Plus</a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="wojo divider"></div>
          <div id="map" style="height:350px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sub-footer">
  <div class="wojo-grid">
    <div class="wojo-content">
      <?php if($cats):?>
      <div class="content-center">
        <h3 class="wojo shadow header"><?php echo Lang::$word->HEAD_CHOOSE;?></h3>
      </div>
      <div class="wojo section divider"></div>
      <div class="four columns small-gutters">
        <?php $color = array("positive","info","warning","negative","purple","black","teal","linkedin","positive","info","warning","negative","purple","black","teal","linkedin");?>
        <?php foreach($cats as $i => $crow):?>
        <div class="row">
          <div class="wojo <?php echo $color[$i];?> fluid button"><a href="<?php echo doUrl(false,$crow->slug,"category");?>"> <img src="<?php echo SITEURL;?>/assets/images/catico/<?php echo $crow->image;?>" alt=""></a>
            <p><?php echo $crow->name;?> (<?php echo $crow->total;?>)</p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script> 
<script type="text/javascript"> 
// <![CDATA[
 var map = null;
  $(document).ready(function () {
	  $('#ghack').on('click', function() {
			var geocoder;
			geocoder = new google.maps.Geocoder();
			var latitude = parseFloat("<?php echo $row->lat;?>");
			var longitude = parseFloat("<?php echo $row->lng;?>");
			loadMap(latitude, longitude);
			setupMarker(latitude, longitude);  
	  
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
			$(".wojo.main.form").removeClass("loading");
			$("#emsg").html(json.message);
			$("#quick_form").slideUp();
		} else {
			$(".wojo.main.form").removeClass("loading");
			$("#emsg").html(json.message);
		}
	}
	function showLoader() {
		$(".wojo.main.form").addClass("loading");
	}
	
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
          draggable: false,
          raiseOnDrag: false,
		  icon: image,
		  title: name
	  });
	  
  }
</script> 