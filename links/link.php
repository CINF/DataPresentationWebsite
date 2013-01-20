<?php

  /*
    Copyright (C) 2012 Robert Jensen, Thomas Andersen and Kenneth Nielsen
    
    The CINF Data Presentation Website is free software: you can
    redistribute it and/or modify it under the terms of the GNU
    General Public License as published by the Free Software
    Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    The CINF Data Presentation Website is distributed in the hope
    that it will be useful, but WITHOUT ANY WARRANTY; without even
    the implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.  See the GNU General Public License for more
    details.
    
    You should have received a copy of the GNU General Public License
    along with The CINF Data Presentation Website.  If not, see
    <http://www.gnu.org/licenses/>.
  */

include("../common_functions.php");
include("graphsettings.php");
$db = std_db();

$URL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$REFERER = $_SERVER["HTTP_REFERER"];

$comment = $_POST["comment"];

echo(new_html_header());

if($_GET["url"] == "checked") {
  $query = "INSERT INTO short_links (url,comment) VALUES (\"" . $REFERER . "\",\"" . $comment . "\")";
  $result  = mysql_query($query,$db);
  $query = "SELECT max(id) from short_links";
  $max_id = single_sql_value($db,$query,0);
  echo("<br><b>Your full URL:</b> " . $REFERER . " <br> <b>Can now be reached at:</b> <a href=\"http://www.cinfdata.fysik.dtu.dk/links/link.php?id=" . $max_id . "\">http://www.cinfdata.fysik.dtu.dk/links/link.php?id=" . $max_id . "</a><br>");
  echo("<input type=\"button\" value=\"Back to Previous Page\" onClick=\"javascript: history.go(-1)\">");
} else {
  $id = $_GET["id"];
  $query = "SELECT url from short_links WHERE id=" . $id . "";
  $url = single_sql_value($db,$query,0);
  header("Location: $url");
  exit;
}

echo(new_html_footer());

?>
