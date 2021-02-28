<?php
  /**
   * Main
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * Shared by LOLcLOL
   * @version $Id: main.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  
	  $popular = $content->topFive();
	  $color = array("bed3ea","fedd8c","a9d5be","d6909a","faae96");
	  $number = array(90,80,70,60,50);
?>
<h1 class="main-header"><?php echo Lang::$word->DASH_TITLE;?></h1>
<div class="wojo breadcrumb">
  <div class="active section"><?php echo Lang::$word->ADM_HOME;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="dashboard icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->DASH_SUB;?> </div>
    <p><?php echo Lang::$word->DASH_INFO;?></p>
  </div>
</div>
<div class="wojo segment">
  <div class="wojo selection dropdown push-right" data-select-range="true">
    <div class="text"><?php echo Lang::$word->DASH_RANGE;?></div>
    <i class="dropdown icon"></i>
    <div class="menu">
      <div class="item" data-value="day"><?php echo Lang::$word->DASH_RANGE_T;?></div>
      <div class="item" data-value="week"><?php echo Lang::$word->DASH_RANGE_W;?></div>
      <div class="item" data-value="month"><?php echo Lang::$word->DASH_RANGE_M;?></div>
      <div class="item" data-value="year"><?php echo Lang::$word->DASH_RANGE_Y;?></div>
    </div>
    <input name="range" type="hidden" value="">
  </div>
  <h4 class="wojo header"><?php echo Lang::$word->DASH_SUB1;?></h4>
  <div class="wojo divider"></div>
  <div id="chart" style="height:400px"></div>
</div>
<div class="wojo fitted divider"></div>
<div class="content-center">
  <h4 class="wojo header"><?php echo Lang::$word->DASH_TOP;?></h4>
  <?php if($popular):?>
  <div class="five columns small-gutters">
    <?php foreach($popular as $i => $row):?>
    <div class="row">
      <div class="chart" data-size="180" data-scale-length="7" data-percent="<?php echo $number[$i];?>" data-bar-color="#<?php echo $color[$i];?>" data-line-width="20"><span class="percent"><?php echo $row->hits;?></span></div>
      <div><?php echo sanitize($row->title,20);?></div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
<script type="text/javascript" src="assets/js/jquery.flot.js"></script> 
<script type="text/javascript" src="assets/js/flot.resize.js"></script> 
<script type="text/javascript" src="assets/js/excanvas.min.js"></script> 
<script type="text/javascript">
// <![CDATA[
function getVisitsChart(range) {
    $.ajax({
        type: 'GET',
        url: 'controller.php?getVisitsStats=1&timerange=' + range,
        dataType: 'json',
        async: false,
        success: function (json) {
            var option = {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                xaxis: {
                    ticks: json.xaxis
                }
            }
            $.plot($('#chart'), [json.hits, json.visits], option);
        }
    });
}
getVisitsChart('year');

function showTooltip(x, y, contents) {
    $('<div class="charts_tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y + 5,
        left: x + 5
    }).appendTo("body").fadeIn(200);
}
var previousPoint = null;

$("#chart").on("plothover", function (event, pos, item) {
    if (item) {
        if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            $(".charts_tooltip").fadeOut("fast").promise().done(function () {
                $(this).remove();
            });
            var x = item.datapoint[0].toFixed(2),
                y = item.datapoint[1].toFixed(2);
            i = item.series.xaxis.options.ticks[item.dataIndex][1]
            showTooltip(item.pageX, item.pageY, item.series.label + " for " + i + " = " + y);
        }
    } else {
        $(".charts_tooltip").fadeOut("fast").promise().done(function () {
            $(this).remove();
        });
        previousPoint = null;
    }
});
$(document).ready(function () {
    $("[data-select-range]").on('click', '.item', function () {
        v = $("input[name=range]").val();
        getVisitsChart(v)
    });
	$('.chart').easyPieChart({easing: 'easeOutQuad'});
});
// ]]>
</script>