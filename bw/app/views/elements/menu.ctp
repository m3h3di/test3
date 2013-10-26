<ul class="menu">
    <?php
    $status = $session->read('Auth.User.status');
    if( $status == 1 ){?>
        <li>
			<a href="<?= $html->url('/admins') ?>"><span><strong>Control Panel</strong></span></a>
		</li>
        
        <li><a href="#"><span><strong>Facility Analysis</strong></span></a>
            <ul>
                <li><a href="<?= $html->url('/admins/ByFacility') ?>">All Facilies </a></li>
                <li><a href="<?= $html->url('/admins/ByStandard') ?>">Different Standard</a>
                <li><a href="<?= $html->url('/admins/ByOverview') ?>">By Overview</a>
                <li><a href="<?= $html->url('/admins/ByBuyer') ?>">By Buyer</a>
                <li><a href="<?= $html->url('/admins/BySection') ?>">Section(s) Analysis</a>
                <li><a href="<?= $html->url('/admins/SingleFacilityAnalysis') ?>">Single Facility Analysis</a></li>
                <li><a href="<?= $html->url('/admins/ByQuestion') ?>">By Specific Question</a></li>
                <li><a href="<?= $html->url('/admins/ComparisonAnalysis') ?>">Comparison Analysis</a></li>
                
            </ul>
        </li>
		<? 
	}
	else	{
		echo '<li><a href="'. $html->url('/') .'"><span><strong>Home</strong></span></a></li>';
	}?>
    
    <li>
    <?php
    $id = $session->read('Auth.User.id');
    if( !empty($id)  ){
        //echo $html->link( $html->image("logout.jpg", array("alt" => "Logout", "style"=>"padding-right:20px")), "/users/logout", array('escape'=>false));
        //echo $this->Html->link('Logout', array('action' => 'index'));
        echo '<a href="'.$html->url('/users/logout') .'"><span><strong>Logout</strong></span></a>';
    }
    ?>
    </li>
</ul>
