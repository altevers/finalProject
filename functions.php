<?php

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	else {
		return '';
	}
}

function getChapterInfo($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/getChapterInfo.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$chapters = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $chapters;
}

?>