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

include("graphsettings.php");
include("../common_functions_v2.php");
echo(html_header());

function file_element($file){
  $bad_names = Array("..", ".", "dygraph", "dygraph_old", "graphsettings.xml");
  if (in_array($file, $bad_names)){
    return 0;
  }
  $bad_endings = Array("~", "#");
  if (in_array(substr($file, -1), $bad_endings)){
    return 0;
  }
  $types = Array("py"=>"python", "php"=>"php");
  $split = explode(".", $file);
  $type = $types[$split[1]];
  $lines = count(file("../sym-files2/{$file}")) - 1;
  echo("<tr>\n");
  echo "<td><a href=\"../code-documentation/code.php?dir=sym-files2&file=$file&type=$type\">$file</a></td><td>$lines</td>\n";
  echo("</tr>\n");
  return $lines;
}
?>
<div class=\"statistics\">
<p>This page contains various statistics for the database and for the
data presentation webpage code</p>

<h1>Code statistics</h1>
<p>The data presentations webpage consist of the following files. Click the files to view the code.</p>


<table border="1" cellpadding="3">
<tr><th align="left">File</th><th align="left">Number of lines</th></tr>
<?php

if ($handle = opendir("../sym-files2")) {
    /* This is the correct way to loop over the directory. */
  $files = Array();
  while (false !== ($entry = readdir($handle))) {
    array_push($files, $entry);
  }
  closedir($handle);
  sort($files);
  $total_lines = 0;
  foreach($files as $file){
    $total_lines += file_element($file);
  }
  echo("<tr>\n<td><b>Total</b></td><td><b>$total_lines</b></td>\n</tr>\n");
}

?>
</table>

</div>
<?php echo(html_footer());?>
