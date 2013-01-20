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

echo(new_html_header());

$query = "SELECT id,url,comment FROM short_links"; 
$result = mysql_query($query,$db);
echo("<table border='1' class=\"links\">"); 
echo("<tr><td><b>Id</b></td><td><b>Comment</b></td><td><b>Link</b></td></tr>"); 
while($row = mysql_fetch_array($result)) { 
  echo("<tr><td>"); 
  echo($row['id']); 
  echo("</td><td>"); 
  echo($row['comment']);
  echo("</td><td>");
  echo("<a href=\"http://www.cinfdata.fysik.dtu.dk/links/link.php?id=" . $row['id'] . "\">cinfdata.fysik.dtu.dk/links/link.php?id=" . $row['id'] . "</a>");
  echo("</td></tr>");
} 
echo("</table>");

echo(new_html_footer());
?>
