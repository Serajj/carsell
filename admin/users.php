<?php
  /**
   * Users
   *
   * @package Car Dealer Pro
   * @author wojocms.com
   * @copyright 2014
   * @version $Id: users.php,v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Filter::$action): case "edit": ?>
<?php $row = $core->getRowById(Users::uTable, Filter::$id);?>
<?php if($user->userlevel == 8 and $user->uid != Filter::$id): print Filter::msgInfo(Lang::$word->NOACCESS, false); return; endif;?>
<h1 class="main-header"><?php echo Lang::$word->USR_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=users" class="section"><?php echo Lang::$word->USR_USERS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->USR_EDIT;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="user"><i class="icon help"></i></a> <i class="user icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->USR_EDIT;?> </div>
    <p><?php echo Lang::$word->USR_INFO . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->USR_SUB . $row->username;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USERNAME;?></label>
        <input name="username" type="text" disabled="disabled" value="<?php echo $row->username;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PASSWORD;?></label>
        <input name="password" type="text">
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->FNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="fname" type="text" value="<?php echo $row->fname;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="lname" type="text" value="<?php echo $row->lname;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="email" type="text" value="<?php echo $row->email;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LOCATIONS;?></label>
        <?php echo $user->getLocationList($row->access);?> </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->REGD;?></label>
        <?php echo $row->created;?> </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_LASTLOGIN;?></label>
        <?php echo $row->lastlogin;?></div>
      <div class="field">
        <label><?php echo Lang::$word->USR_LASTIP;?></label>
        <?php echo $row->lastip;?> </div>
    </div>
    <div class="wojo divider"></div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="userlevel" type="radio" value="9" <?php getChecked($row->userlevel, 9); ?>>
            <i></i><?php echo Lang::$word->USR_ADMIN;?></label>
          <label class="radio">
            <input name="userlevel" type="radio" value="8" <?php getChecked($row->userlevel, 8); ?>>
            <i></i><?php echo Lang::$word->USR_EDITOR;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="y" <?php getChecked($row->active, "y"); ?>>
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
          <label class="radio">
            <input name="active" type="radio" value="n" <?php getChecked($row->active, "n"); ?>>
            <i></i><?php echo Lang::$word->INACTIVE;?></label>
        </div>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->USR_UPDATE;?></button>
    <a href="index.php?do=users" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processUser" type="hidden" value="1" />
    <input name="id" type="hidden" value="<?php echo Filter::$id;?>" />
    <input name="username" type="hidden" value="<?php echo $row->username;?>" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php case"add": ?>
<?php if($user->userlevel == 8): print Filter::msgInfo(Lang::$word->NOACCESS, false); return; endif;?>
<h1 class="main-header"><?php echo Lang::$word->USR_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a href="index.php" class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <a href="index.php?do=users" class="section"><?php echo Lang::$word->USR_USERS;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->USR_ADD;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <a class="helper wojo top right corner label" data-help="user"><i class="icon help"></i></a><i class="user icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->USR_ADD;?> </div>
    <p><?php echo Lang::$word->USR_INFO1 . Lang::$word->REQFIELD1 . '<i class="icon asterisk"></i>' . Lang::$word->REQFIELD2;?></p>
  </div>
</div>
<div class="wojo form segment">
  <div class="wojo header"><?php echo Lang::$word->USR_SUB1;?></div>
  <div class="wojo double fitted divider"></div>
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->USERNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="username" type="text" placeholder="<?php echo Lang::$word->USERNAME;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PASSWORD;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="password" type="text" placeholder="<?php echo Lang::$word->PASSWORD;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->FNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="fname" type="text" placeholder="<?php echo Lang::$word->FNAME?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LNAME;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="lname" type="text" placeholder="<?php echo Lang::$word->LNAME;?>">
        </label>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label><?php echo Lang::$word->EMAIL;?></label>
        <label class="input"><i class="icon-append icon asterisk"></i>
          <input name="email" type="text" placeholder="<?php echo Lang::$word->EMAIL;?>">
        </label>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->LOCATIONS;?></label>
        <?php echo $user->getLocationList();?> </div>
    </div>
    <div class="three fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="userlevel" type="radio" value="9">
            <i></i><?php echo Lang::$word->USR_ADMIN;?></label>
          <label class="radio">
            <input name="userlevel" type="radio" value="8" checked="checked">
            <i></i><?php echo Lang::$word->USR_EDITOR;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_LEVEL;?></label>
        <div class="inline-group">
          <label class="radio">
            <input name="active" type="radio" value="y" checked="checked">
            <i></i><?php echo Lang::$word->ACTIVE;?></label>
          <label class="radio">
            <input name="active" type="radio" value="n">
            <i></i><?php echo Lang::$word->INACTIVE;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->USR_NOTIFY;?></label>
        <label class="checkbox">
          <input name="notify" type="checkbox" value="1">
          <i></i><?php echo Lang::$word->USR_NOTIFY;?></label>
      </div>
    </div>
    <div class="wojo double fitted divider"></div>
    <button type="button" name="dosubmit" class="wojo positive button"><?php echo Lang::$word->USR_ADD;?></button>
    <a href="index.php?do=users" class="wojo basic button"><?php echo Lang::$word->CANCEL;?></a>
    <input name="processUser" type="hidden" value="1" />
  </form>
</div>
<div id="msgholder"></div>
<?php break;?>
<?php default:?>
<?php  $userrow = $user->getUsers();?>
<a class="wojo icon positive button push-right lc" data-content="<?php echo Lang::$word->USR_ADD;?>" href="index.php?do=users&amp;action=add"><i class="icon add"></i> <?php echo Lang::$word->ADD;?></a>
<h1 class="main-header"><?php echo Lang::$word->USR_TITLE;?></h1>
<div class="wojo breadcrumb"><i class="icon home"></i> <a class="section"><?php echo Lang::$word->ADM_HOME;?></a>
  <div class="divider"> / </div>
  <div class="active section"><?php echo Lang::$word->USR_TITLE;?></div>
</div>
<div class="wojo double fitted divider"></div>
<div class="wojo icon message"> <i class="user icon"></i>
  <div class="content">
    <div class="header"> <?php echo Lang::$word->USR_SUB2;?> </div>
    <p><?php echo Lang::$word->USR_INFO2;?></p>
  </div>
</div>
<div class="wojo segment">
  <table class="wojo sortable table">
    <thead>
      <tr>
        <th data-sort="int">#</th>
        <th data-sort="string"><?php echo Lang::$word->USERNAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->USR_FULLNAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->STATUS;?></th>
        <th data-sort="int"># <?php echo Lang::$word->LISTINGS;?></th>
        <th class="disabled"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($userrow as $row):?>
      <tr>
        <td><?php echo $row->id;?>.</td>
        <td><a href="index.php?do=newsletter&amp;emailid=<?php echo urlencode($row->email);?>"><?php echo $row->username;?></a></td>
        <td><?php echo $row->name;?></td>
        <td><span class="wojo label <?php echo ($row->active == "y") ? "success" : "negative";?>"><?php echo ($row->active == "y") ? Lang::$word->ACTIVE : Lang::$word->INACTIVE;?></span></td>
        <td><span class="wojo circular black label"><?php echo $row->totalitems;?></span></td>
        <td><a href="index.php?do=users&amp;action=edit&amp;id=<?php echo $row->id;?>"><i class="rounded inverted success icon pencil link"></i></a>
          <?php if($row->id == 1):?>
          <i class="rounded black inverted trash icon"></i>
          <?php else:?>
          <a class="delete" data-title="<?php echo Lang::$word->USR_DELUSER;?>" data-option="deleteUser" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->username;?>"><i class="rounded danger inverted trash icon link"></i></a>
          <?php endif;?></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </tbody>
  </table>
</div>
<?php break;?>
<?php endswitch;?>