<?php

  /*
    Copyright (C) 2012 Robert Jensen, Thomas Anderser and Kenneth Nielsen
    
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

error_reporting (E_ALL ^ E_NOTICE);

# Get settings and initiate argument variables
$settings = plot_settings($_GET['type']);
$boolean_options='';

### Common
# Booleans
foreach (array('diff_left_y', 'linscale_left_y2', 'linscale_left_y1',
	       'linscale_left_y0', 'as_function_of', 'linscale_x0',
	       'linscale_x1', 'linscale_x2', 'linscale_right_y0',
	       'linscale_right_y1', 'linscale_right_y2',
	       'diff_right_y') as $value){
  $boolean_options .= ',' . $value . ':' . $_GET[$value];
}

# Scales
$left_yscale_bounding = $_GET['left_ymin'] . ',' . $_GET['left_ymax'];
$right_yscale_bounding = $_GET['right_ymin'] . ',' . $_GET['right_ymax'];
$xscale_bounding = $_GET['xmin'] . ',' . $_GET['xmax'];
# Plotlists
$left_plotlist = ''; $right_plotlist = '';
foreach (array('left_plotlist', 'right_plotlist') as $list){
  $$list = '';
  if (count($_GET[$list]) > 0){
    foreach($_GET[$list] as $id){
      $$list .= ',' . $id;
    }
  }
}

### Dateplot specific
$from_to  = $_GET['from'] . ',' . $_GET['to'];

# Call python plot backend
$command = './export_data.py --type ' . $_GET['type'] .
  ' --boolean_options "' . $boolean_options . '"' .
  ' --left_plotlist "' . $left_plotlist . '"' .
  ' --right_plotlist "' . $right_plotlist . '"' .
  ' --xscale_bounding "' . $xscale_bounding . '"' .
  ' --left_yscale_bounding "' . $left_yscale_bounding . '"' .
  ' --right_yscale_bounding "' . $right_yscale_bounding . '"' .
  ' --from_to "' . $from_to . '"' .
  ' 2>&1';

exec($command, $command_output);

header("Content-type: text/plain");
#echo('<pre>');
for($i=0;$i<count($command_output);$i++){
  echo($command_output[$i]."\n");
}
#echo('</pre>');

?>
