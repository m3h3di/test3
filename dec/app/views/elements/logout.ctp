<?php


$id = $session->read('Auth.User.id');

if( !empty($id)  ){
	echo $html->link( $html->image("logout.jpg", array("alt" => "Logout", "style"=>"padding-right:20px")), "/users/logout", array('escape'=>false));
}

?>