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
<title>SQLol - DELETE query</title>
</head>
<body>
<center><h1>SQLol - DELETE query</h1></center><br>
<?
include('includes/nav.inc.php');
?>

<tr><td>Injection Location:</td><td>
	<select name="location">
		<option value="where_string">String in WHERE clause</option>
		<option value="where_int">Integer in WHERE clause</option>
		<option value="column_name">Column Name</option>
		<option value="table_name">Table Name</option>
	</select></td></tr></table>
	
<input type="submit" name="submit" value="Inject!">

<?
if(isset($_REQUEST['submit'])){ //Injection time!
	
	$display_table_name = $table_name = 'users';
	$display_where_clause = $where_clause = 'WHERE isadmin = 0';

	switch ($sqlol_vars['location']){
		case 'table_name':
			$table_name = $sqlol_vars['inject_string'];
			$display_table_name = '<u>' . $sqlol_vars['inject_string'] . '</u>';
			break;
		case 'where_string':
			$where_clause = "WHERE username = '" . $sqlol_vars['inject_string'] . "'";
			$display_where_clause = "WHERE username = '" . '<u>' . $sqlol_vars['inject_string'] . '</u>' . "'";
			break;
		case 'where_int':
			$where_clause = 'WHERE isadmin = ' . $sqlol_vars['inject_string'];
			$display_where_clause = 'WHERE isadmin = ' . '<u>' . $sqlol_vars['inject_string'] . '</u>';
			break;
		case 'column_name':
			$where_clause = 'WHERE ' . $sqlol_vars['inject_string'] . ' = 1';
			$display_where_clause = 'WHERE ' . '<u>' . $sqlol_vars['inject_string'] . '</u>' . ' = 1';
	}
	
	$query = "DELETE FROM $table_name $where_clause";
	$displayquery = "DELETE FROM $display_table_name $display_where_clause";
	
	include('includes/database.inc.php');

}
?>

</body>
</html>