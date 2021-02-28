<?php
  /**
   * Login
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: login.php, v1.00 2014-03-05 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require("init.php");
?>
<?php
  if ($user->is_Admin())
      redirect_to("index.php");
	  
  if (isset($_POST['submit']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  //Login successful 
  if ($result)
      : redirect_to("index.php");
  endif;
  endif;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">
<title><?php echo $core->site_name;?></title>
<link href="assets/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../assets/jquery.js"></script>
</head>
<body>
<div class="wrapper">
  <div id="loginform">
    <form id="admin_form" name="admin_form" method="post">
      <h1>admin panel</h1>
      <div class="fields">
        <input id="username" name="username" placeholder="<?php echo Lang::$word->USERNAME;?>" type="text">
        <input id="password" name="password" placeholder="******" type="password">
      </div>
      <div class="footer">
        <p class="clearfix"><a id="passreset"><?php echo Lang::$word->PASSWORD_L;?>?</a></p>
        <button class="button" type="submit" name="submit" id="submit"><?php echo Lang::$word->LOGIN;?></button>
        <p class="copy">Copyright &copy; <?php echo date('Y').' '.$core->site_name;?></p><?php /*Shared by LOLcLOL*/ ?>Shared by LOLcLOL
      </div>
    </form>
  </div>
  <div id="passform" style="display:none">
    <h1>password reset</h1>
    <div class="fields">
      <input id="email" name="email" placeholder="<?php echo Lang::$word->EMAIL;?>" type="text">
      <p class="info"><?php echo Lang::$word->PASSWORD_RES_T;?></p>
    </div>
    <div class="footer">
      <p class="clearfix"><a id="backto"><?php echo 'back to login';?></a></p>
      <button class="button" type="submit" name="dopass" id="dopass"><?php echo Lang::$word->PASSWORD_RES;?></button>
      <p class="copy">Copyright &copy; <?php echo date('Y').' '.$core->site_name;?></p>
    </div>
  </div>
  <div id="message-box"><?php print Filter::$showMsg;?></div>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function () {
    $('#backto').click(function () {
        $("#passform").slideUp("slow");
        $("#loginform").slideDown("slow");
    });
    $('#passreset').click(function () {
        $("#loginform").slideUp("slow");
        $("#passform").slideDown("slow");
    });
    $('#dopass').click(function () {
        var email = $("#email").val();
        $.ajax({
            type: 'post',
            url: "../ajax/passreset.php",
            data: 'passReset=' + email,
            success: function (msg) {
                if (msg == 'Y') {
				  $("#loginform").slideUp("slow");
				  $("#passform").slideDown("slow")
					result = '<?php echo Filter::msgOk(Lang::$word->PASSWORD_RES_D);?>';
                } else if (msg == 'N') {
                    result = '<?php echo Filter::msgError(Lang::$word->EMAIL_R4);?>';
                } else {
                    result = msg;
                }
                $("#message-box").html(result);
            }
        });
    });
});
// ]]>
</script>
</body>
</html>