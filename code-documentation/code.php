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

  /* This file is used to document the code on the webpage */

include("../common_functions.php");

if (!(array_key_exists('file', $_GET) and array_key_exists('type', $_GET))){
  exit('Both parameters "file" and "type" are mandatory, "dir" is optional');
}

$basedir = '/var/www/cinfdata';
$dir = array_key_exists('dir', $_GET) ? $_GET['dir'] : 'sym-files';
$path = $basedir.'/'.$dir.'/'.$_GET['file'];
$type = $_GET['type'];

# To prevent command injection
if (!file_exists($path)){
  exit("This file \"$path\" does not exit");
}

# For php file we use the builtin highlight_string command
if ($type == 'php'){
  echo(html_code_header($dir.'/'.$_GET['file']));
  $lines = file($path);
  $code = implode('', $lines);
  highlight_string($code);
  echo(new_html_footer());
    }
# For python or xml we use the pygmentize command
elseif ($type == 'python' || $type == 'xml') {
  $command = "pygmentize -f html -O full -l " . $type . " " . $path;
  system($command, $command_output);
  echo(implode('', $command_output));
}
else {
  exit('Unknown type: ' . $type . '</br>You can use: php, python or '. 'xml');
}
?>
