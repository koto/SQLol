<?php
/*
SQLol - A configurable SQL injection testbed
Daniel "unicornFurnace" Crowley
Copyright (C) 2012 Trustwave Holdings, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
include('includes/inject_cookie.php');
?>
<html>
<head>
<title>SQLol - INSERT query</title>
</head>
<body>
<center><h1>SQLol - INSERT query</h1></center><br>
<?
include('includes/nav.inc.php');
?>

<tr><td>Injection Location:</td><td>
	<select name="location">
		<option value="string_value">Value (string)</option>
		<option value="int_value">Value (int)</option>
		<option value="column_name">Column Name</option>
		<option value="table_name">Table Name</option>
	</select></td></tr></table>
	
<input type="submit" name="submit" value="Inject!">

<?
if(isset($_REQUEST['submit'])){ //Injection time!
				
	$display_column_name = $column_name = 'username, isadmin';
	$display_table_name = $table_name = 'users';
	$display_string_value = $string_value = 'haxotron9000';
	$display_int_value = $int_value = '0';

	switch ($sqlol_vars['location']){ //Rewrite the appropriate variable for the injection location
		case 'column_name':
			$column_name = $sqlol_vars['inject_string'] . ', isadmin';
			$display_column_name = '<u>' . $sqlol_vars['inject_string'] . '</u>' . ', isadmin';
			break;
		case 'table_name':
			$table_name = $sqlol_vars['inject_string'];
			$display_table_name = '<u>' . $sqlol_vars['inject_string'] . '</u>';
			break;
		case 'string_value':
			$string_value = $sqlol_vars['inject_string'];
			$display_string_value = '<u>' . $sqlol_vars['inject_string'] . '</u>';
			break;
		case 'int_value':
			$int_value = $sqlol_vars['inject_string'];
			$display_int_value = '<u>' . $sqlol_vars['inject_string'] . '</u>';
			break;
	}
	
	$query = "INSERT INTO $table_name ($column_name) VALUES ('$string_value', $int_value)";
	$displayquery = "INSERT INTO $display_table_name ($display_column_name) VALUES ('$display_string_value', $display_int_value)";
	
	include('includes/database.inc.php');

}
?>

</body>
</html>