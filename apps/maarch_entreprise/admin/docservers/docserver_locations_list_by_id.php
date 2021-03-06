<?php
/*
*   Copyright 2010 Maarch
*
*  	This file is part of Maarch Framework.
*
*   Maarch Framework is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   Maarch Framework is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details.
*
*   You should have received a copy of the GNU General Public License
*   along with Maarch Framework.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* @brief  List of docserver_locations for autocompletion
*
*
* @file
* @author Laurent Giovannoni <dev@maarch.org>
* @date $date$
* @version $Revision$
* @ingroup life_cycle
*/

require_once("core".DIRECTORY_SEPARATOR."class".DIRECTORY_SEPARATOR."class_request.php");
require_once("core".DIRECTORY_SEPARATOR."core_tables.php");
$db = new Database();

$stmt = $db->query("SELECT docserver_location_id as tag FROM "._DOCSERVER_LOCATIONS_TABLE_NAME
	." WHERE lower(docserver_location_id) like lower(?) order by docserver_location_id",
	array($_REQUEST['what'].'%'));

$listArray = array();
while($line = $stmt->fetchObject()) {
	array_push($listArray, $line->tag);
}
echo "<ul>\n";
$authViewList = 0;
$flagAuthView = false;
foreach($listArray as $what) {
	if($authViewList >= 10) {
		$flagAuthView = true;
	}
    if(stripos($what, $_REQUEST['what']) === 0) {
        echo "<li>".$what."</li>\n";
		if($flagAuthView) {
			echo "<li>...</li>\n";
			break;
		}
		$authViewList++;
    }
}
echo "</ul>";
