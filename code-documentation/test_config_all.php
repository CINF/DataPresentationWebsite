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

$chambers = Array("system1", "system2");
?>

<h1>Test configuration files</h1>
<p>If you are unable to check your configuration files from one of
your own pages because the do not load, you can test them from
here. Simply click the link below for your chamber.</p>

<ul>
<?php

  foreach($chambers as $chamber){
    echo("<li><a href=\"../{$chamber}/test_configuration_file.php\">{$chamber}</a></li>");
  }
?>
</ul>

<?php echo(html_footer());?>
