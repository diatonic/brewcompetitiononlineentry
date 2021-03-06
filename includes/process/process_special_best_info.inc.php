<?php 
/*
 * Module:      process_special_best_info.inc.php
 * Description: This module does all the heavy lifting for adding/editing info in the "special_best_info" table
 */
 
if ((isset($_SERVER['HTTP_REFERER'])) && ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] <= 1))) {
	
	if ($action == "add") {
		
			$insertSQL = sprintf("INSERT INTO $special_best_info_db_table (sbi_name, sbi_description, sbi_places, sbi_rank, sbi_display_places) VALUES (%s, %s, %s, %s, %s)",
							   GetSQLValueString(strip_tags($_POST['sbi_name']), "text"),
							   GetSQLValueString(strip_newline($_POST['sbi_description']), "text"),
							   GetSQLValueString($_POST['sbi_places'], "int"),
							   GetSQLValueString($_POST['sbi_rank'], "int"),
							   GetSQLValueString($_POST['sbi_display_places'], "int")
							   );
		
			mysqli_real_escape_string($connection,$insertSQL);
			$result = mysqli_query($connection,$insertSQL) or die (mysqli_error($connection));
			
			$pattern = array('\'', '"');
			$insertGoTo = str_replace($pattern, "", $insertGoTo); 
			header(sprintf("Location: %s", stripslashes($insertGoTo)));
								   
		}
		
		if ($action == "edit") {
			
			$updateSQL = sprintf("UPDATE $special_best_info_db_table SET sbi_name=%s, sbi_description=%s, sbi_places=%s, sbi_rank=%s, sbi_display_places=%s WHERE id=%s",
							   GetSQLValueString(strip_tags($_POST['sbi_name']), "text"),
							   GetSQLValueString(strip_newline($_POST['sbi_description']), "text"),
							   GetSQLValueString($_POST['sbi_places'], "int"),
							   GetSQLValueString($_POST['sbi_rank'], "int"),
							   GetSQLValueString($_POST['sbi_display_places'], "int"),
							   GetSQLValueString($id, "int"));
		
			mysqli_real_escape_string($connection,$updateSQL);
			$result = mysqli_query($connection,$updateSQL) or die (mysqli_error($connection));
			
			$pattern = array('\'', '"');
			$updateGoTo = str_replace($pattern, "", $updateGoTo); 
			header(sprintf("Location: %s", stripslashes($updateGoTo)));	
							   
		}
		
} else { 
	header(sprintf("Location: %s", $base_url."index.php?msg=98"));
	exit;
}
?>