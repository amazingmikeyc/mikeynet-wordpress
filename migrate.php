<?php

mysql_connect('127.0.0.1','root','r00t');

mysql_select_db('mikeyc_mikeynet');

echo mysql_error();
$sql = 'select 
	s.content, 
	p.id as page_id, 
	s.created, 
	s.lastchanged, 
	s.id as subpage_id, 
	p.title as page_title,
	s.title as subpage_title,
	p.url as page_url, 
	s.url as subpage_url,
	s.description as subpage_excerpt,
	p.description as page_excerpt,
	p.image as icon
from page p, subpage s where s.parent = p.id
ORDER BY s.created DESC';

$result = mysql_query($sql);

echo mysql_error();

$newPages = array();

mysql_query('DELETE FROM mikeynetwordpress.wp_posts');

while ($row = mysql_fetch_assoc($result)) {
	
//	print_r($row);
	
	$insert = array();

	
	$insert['post_author'] = 1;
	$insert['post_date']   		= $row['created'];
	$insert['post_date_gmt'] 	= $row['created'];
	$insert['post_modified']	= $row['lastchanged'];
	$insert['post_modified_gmt']= $row['lastchanged'];
	$insert['post_type']		= 'page';
	//$insert['post_name']
	$insert['post_excerpt']		= $row['page_excerpt'];	
	$insert['post_icon']		= '/wp-content/uploads/icons/'.$row['icon'];
		
	if (!isset($newPages[$row['page_id']])) {
//	$insert['post_name']	= strtolower(str_replace(' ','_',$row['page_title']));
		$insert['post_name'] = strtolower(str_replace(' ','_',$row['page_url']));
		$insert['post_title']	= $row['page_title'];

	
		$insert['post_excerpt'] = $row['page_excerpt'];	
		doInsert($insert);
		
		$newPages[$row['page_id']] = mysql_insert_id();
	}
	
	   $insert['post_excerpt']         = $row['subpage_excerpt'];

	$insert['post_content'] 	= addslashes($row['content']);
	$insert['post_title'] 		= $row['subpage_title'];
	$insert['post_name']		= strtolower(str_replace(' ','_',$row['subpage_url']));

	$insert['post_parent']		= $newPages[$row['page_id']];
	
//print_r($insert);continue;	
	
	doInsert($insert);
	
	//print_r($sql);	
		
}



function doInsert($insert) {
		$sql = 'INSERT INTO mikeynetwordpress.wp_posts ('.
		implode(',',array_keys($insert)).') VALUES ("'.implode('","',($insert)).'")';

		return mysql_query($sql);
}




