<?php
  /**
   * Footer
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * Shared by LOLcLOL
   * @version $Id: footer.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!-- Start Footer-->
<footer>
  <div class="wojo-grid">Copyright &copy;<?php echo date('Y').' '.$core->company;?> &bull; Powered by: Car Dealer Pro v<?php echo $core->ver;?></div><?php /*Shared by LOLcLOL*/ ?> Shared by LOLcLOL
</footer>
<!-- End Footer-->
<script src="assets/js/fullscreen.js"></script>
<?php if (Filter::$do && is_file('assets/js/' . Filter::$do.".js")):?>
<script type="text/javascript" src="assets/js/<?php echo Filter::$do;?>.js"></script>
<?php endif;?>
</body></html>