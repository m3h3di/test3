<!--<li><a href="portfolio.html"><span>portfolio</span></a></li>-->
<li>
<?php
$status = $session->read('Auth.User.status');
if( $status == 1 ){

	echo '<a href="'.$html->url('/admin').'"><span>Control Panel</span></a>';
}
else	echo '<a href="'.$html->url('/') .'"><span>Home</span></a>';
?>

</li>
<li>
<?php
$id = $session->read('Auth.User.id');
if( !empty($id)  ){
	//echo $html->link( $html->image("logout.jpg", array("alt" => "Logout", "style"=>"padding-right:20px")), "/users/logout", array('escape'=>false));
	//echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout'));
	echo '<a href="'.$html->url('/users/logout') .'"><span>Logout</span></a>';
}
?>
</li>