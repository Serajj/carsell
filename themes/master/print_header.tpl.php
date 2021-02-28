<?php
  /**
   * Print Header
   *
   * @package Car Dealer Pro
   * @author wojoscripts.com
   * @copyright 2014
   * @version $Id: print_header.tpl.php, v 1.00 2014-01-10 21:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Listing &rsaquo;<?php echo $row->title;?></title>
<style type="text/css">
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
  margin: 5px;
  background-color: #FFF;
  background-image: none;
}
.display {
  border: 1px solid #C9C9C9
}
.display tr td {
  border-bottom: 1px solid #C9C9C9;
  padding:0.5em
}
.display tr th {
  background-color: #E0E4E7;
  padding:0.5em
}
.display img {
  box-shadow: none;
  width: auto;
  max-width: 100%;
  max-height: 100%;
  vertical-align: top;
  border: 0
}
@media print {
* {
  background: transparent !important;
  color: black !important;
  text-shadow: none !important;
  filter: none !important;
  -ms-filter: none !important;
}
a,
a:visited {
  text-decoration: underline;
}
a[href]:after {
  content: " (" attr(href) ")";
}
abbr[title]:after {
  content: " (" attr(title) ")";
}
.ir a:after,
a[href^="javascript:"]:after,
a[href^="#"]:after {
  content: "";
}
pre,
blockquote {
  border: 1px solid #999;
  page-break-inside: avoid;
}
thead {
  display: table-header-group;
}
tr,
img {
  page-break-inside: avoid;
}
img {
  max-width: 100% !important;
}
 @page {
margin: 0.5cm;
}
p,
h2,
h3 {
  orphans: 3;
  widows: 3;
}
h2,
h3 {
  page-break-after: avoid;
}
}
</style>
</head>
<body>