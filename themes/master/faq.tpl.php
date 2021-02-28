<?php
  /**
   * F.A.Q.
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: faq.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
	  $faqrow = $content->getFaq();
?>
<!-- Start F.A.Q. -->
<div class="wojo-grid">
  <div class="wojo-content">
    <div class="wojo breadcrumb">
      <div class="section"><?php echo Lang::$word->ADM_CONTENT;?></div>
      <div class="divider"> / </div>
      <a class="active section"><?php echo $row->title;?></a></div>
    <div class="wojo divider"></div>
    <div id="faq">
      <?php if($faqrow):?>
      <div class="clearfix"><a class="expand_all wojo small button push-right" data-hint="<?php echo Lang::$word->EXPAND;?>"><?php echo Lang::$word->COLLAPSE;?></a></div>
      <?php foreach ($faqrow as $fqrow):?>
      <section class="wojo info segment">
        <h3 class="question"><?php echo $fqrow->question;?></h3>
        <div class="answer clearfix"><?php echo cleanOut($fqrow->answer);?></div>
      </section>
      <?php endforeach;?>
      <?php unset($fqrow);?>
    </div>
  </div>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('h3.question').on('click', function () {
        var parent = $(this).parent();
		var active = $(this);
        var answer = parent.find('.answer');
        if (answer.is(':visible')) {
            answer.slideUp(100, function () {
                answer.slideUp();
				active.removeClass('active')
            });
        } else {
            answer.fadeIn(300, function () {
                answer.slideDown();
				active.addClass('active')
            });
        }
        return false;
    });

    $("a.expand_all").on("click", function () {
        if (!$('.answer').is(':visible')) {
            $(this).text('<?php echo Lang::$word->COLLAPSE;?>');
            $('.answer').slideDown(150);
			$('h3.question').addClass('active');
        } else {
            $(this).text('<?php echo Lang::$word->EXPAND;?>');
            $('.answer').slideUp(150);
			$('h3.question').removeClass('active');
        }
    });
});
// ]]>
</script>
<?php endif;?>
<!-- End F.A.Q. /-->