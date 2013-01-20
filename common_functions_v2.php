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

/** Returns a handle to the standard database
    @return object 
  */
function std_db($user = "cinf_reader"){
    $db = mysql_connect("localhost", $user, $user);    
    mysql_select_db("cinfdata",$db);
    return($db);
}

function single_sql_value($db,$query,$column){
    $result  = mysql_query($query,$db);  
    $row = mysql_fetch_array($result);
    $value = $row[$column];
    return($value);
}

function get_xy_values($query,$db,$offset=0){
    $result  = mysql_query($query,$db);
    while ($row = mysql_fetch_array($result)){
        $data["y"][] = $row[1] + $offset;
        $data["x"][] = $row[0];
    }
    return($data);
}

function xscale($max,$min,$manual,$log){
    if ($log){
        $max = log10($max);
        $min = log10($min);
    }
    $xscale["max"] = ($max == "") ? 2 : $max; //Default values if no values is given: 2 and 1
    $xscale["min"] = ($min == "") ? 1 : $min;
    $xscale["manual"] = $manual==="checked"; // If a manual scale is chosen the variable
                                             // $manual will have the value "checked"
    return($xscale);
}

/** Formats a given number as a scientific number (exponentials of 10 notation) in HTML 
    @param real $number The number to be html-formatted
    @return string
  */
function science_number($number){
    if($number == 0){
        $result = 0;
    }
    else {
        $exponent = floor(log10($number));
        $digits = $number * pow(10,-1*$exponent);
        $digits = round($digits,2);
        $result = $digits . " &times " . "10<sup>" . $exponent . "</sup>";
    }
    return($result);
}

/** Makes sure that a string only contains a-zA-Z0-9 \{} characters and replace
    the string with a warning if that is not the case
    $str string
    @return string
 */
function weed($str){
  $expressions = Array('/\"/', '/&/', '/=/', '/Æ/', '/Ø/','/Å/','/æ/','/ø/',
		       '/å/');
  foreach($expressions as $expr){
    $str = preg_replace($expr, "?", $str);
  }
  return $str;
}

/** Returns strings with standard html-header and -footer
 *  @return string
 */

function html_header(){

  $header = "";
  $header = $header . "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
  $header = $header . "<html>\n";
  $header = $header . "  <head>\n";
  $header = $header . "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
  $header = $header . "    <title>CINF data logging</title>\n";
  $header = $header . "    <link rel=\"StyleSheet\" href=\"../css/style.css\" type=\"text/css\" media=\"screen\">\n";
  $header = $header . "    <script type=\"text/javascript\" src=\"dygraph/dygraph-dev.js\"></script>\n";
  $header = $header . "    <script type=\"text/javascript\" src=\"../js/update.js\"></script> \n";
  $header = $header . "    <script type=\"text/javascript\" src=\"../js/toogle.js\"></script>\n";
  $header = $header . "  </head>\n";
  $header = $header . "  <body>\n";
  $header = $header . "    <div class=\"container\">\n";
  $header = $header . "    <div class=\"caption\">\n";
  $header = $header . "      Data viewer\n";
  $header = $header . "      <a href=\"/\"><img class=\"logo\" src=\"../images/cinf_logo_beta_greek.png\" alt=\"CINF data viewer\"></a>\n";
  $header = $header . "        <div class=\"header_utilities\">\n";
  $header = $header . "          <a class=\"header_links\" href=\"https://cinfwiki.fysik.dtu.dk/cinfwiki/Software/DataWebPageUserDocumentation\">Help</a><br>\n";
  $header = $header . "          <a class=\"header_links\" href=\"test_configuration_file.php\">Config</a>\n";
  $header = $header . "        </div>\n";
  $header = $header . "    </div>\n";
  $header = $header . "    <div class=\"plotcontainer\">\n";

  return($header);
}


function header_v2(){
  $header = "";
  $header = $header . "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
  $header = $header . "<html>\n";
  $header = $header . "  <head>\n";
  $header = $header . "    <title>CINF data logging</title>\n";
  $header = $header . "    <link rel=\"StyleSheet\" href=\"../css/style.css\" type=\"text/css\" media=\"screen\">\n";
  $header = $header . "  </head>\n";
  $header = $header . "  <body>\n";
  $header = $header . "    <div class=\"container\">\n";
  $header = $header . "      <div class=\"caption\">Data viewer\n";
  $header = $header . "        <a href=\"/\"><img class=\"logo\" src=\"../images/cinf_logo_beta_greek.png\"></a>\n";
  $header = $header . "        <div class=\"header_utilities\">\n";
  $header = $header . "          <a class=\"header_links\" href=\"https://cinfwiki.fysik.dtu.dk/cinfwiki/Software/DataWebPageUserDocumentation\">Help</a><br>\n";
  $header = $header . "          <a class=\"header_links\" href=\"test_configuration_file.php\">Config</a>\n";
  $header = $header . "        </div>\n";
  $header = $header . "      </div>\n";

  return($header);
}

function html_footer(){
  $footer = "";
  $footer = $footer . "      </div>\n";
  $footer = $footer . "      <div class=\"copyright\">...</div>\n";
  $footer = $footer . "    </div>\n";
  $footer = $footer . "  </body>\n";
  $footer = $footer . "</html>\n";
  return($footer);
}

function html_footer_v2(){
  $footer = "";
  $footer = $footer . "      <div class=\"copyright\">...</div>\n";
  $footer = $footer . "    </div>\n";
  $footer = $footer . "  </body>\n";
  $footer = $footer . "</html>\n";
  return($footer);
}

function html_code_header($file){
    $header = "";
    $header = $header . "<head><title>CINF data logging</title>\n";
    $header = $header . "<link rel=\"StyleSheet\" href=\"../css/screen.css\" type=\"text/css\" media=\"screen\">\n";
    $header = $header . "</head>\n";
    $header = $header . "<body>\n";
    $header = $header . "<div class=\"container\">\n";
    $header = $header . "<div class=\"caption\">Code viewer: ".$file."\n";
    $header = $header . "<a href=\"/\"><img class=\"logo\" src=\"../images/cinf_logo_beta_greek.png\"></a>\n";
    $header = $header . "</div>\n";
    return($header);
}

?>
