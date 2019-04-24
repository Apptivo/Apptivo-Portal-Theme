<?php 
$my_case_url=esc_url( get_permalink( get_page_by_title( 'My Cases' ) ) );

?>

<div id="sidebar" class="sidebar-offcanvas lftmnu collapse"
	role="complementary">
	<div class="side-section">
	<a href="<?php echo PORTAL_CREATECASES_URL;?>">
	<?php if('Y' == ENABLE_SPLAH_SCREEN){ ?>
		<button type="button" class="btn btn-primary btn-md" id="create_ticket" disabled>
			<?php }else { echo '<button type="button" class="btn btn-primary btn-md" id="create_ticket">';}?>
				<i class="fa fa-plus-circle"></i> Create <?php echo OBJECT_NAME; ?>
			</button> </a>
			<?php if(!isEmployeeSet()){?>
		<div class="menu">
			<ul id="menu-ticketing" class="menu">
				<li <?php if(is_page('my-open-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_MYCASES_URL;?>" disabled='disabled'>My Open <?php echo OBJECT_NAME_PLURAL; ?></a></li>
				<li <?php if(is_page('opened-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_OPENTICK_URL;?>" disabled='disabled'>All Open <?php echo OBJECT_NAME_PLURAL; ?></a></li>
				<li <?php if(is_page('closed-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_CLOSETICK_URL;?>" disabled='disabled'>All Closed <?php echo OBJECT_NAME_PLURAL; ?></a></li>
				<li <?php if(is_page('client-action-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_CLIENTACTION_URL;?>" disabled='disabled'><?php echo OBJECT_NAME_PLURAL; ?> Pending Action</a></li>
				<li <?php if(is_page('all-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_ALLTICKETS_URL;?>" disabled='disabled'>All <?php echo OBJECT_NAME_PLURAL; ?></a></li>
			</ul>
		</div>
		<?php  } else {?>
		<div class="menu">
			<ul id="menu-ticketing" class="menu">
			<?php $val = $_GET['tid']; ?>
				<li <?php if(is_page('my-open-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_MYCASES_URL;?>" disabled='disabled'>My Open <?php echo OBJECT_NAME_PLURAL; ?></a></li>
				<li <?php if(is_page(strtolower(OBJECT_NAME_PLURAL).'-pending-client-action')){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_CLIENTACTION_URL;?>"disabled='disabled'><?php echo OBJECT_NAME_PLURAL; ?> Pending Action</a></li>
				<li <?php if(is_page('all-closed-'.strtolower(OBJECT_NAME_PLURAL))){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_CLOSETICK_URL;?>"disabled='disabled'>My Closed <?php echo OBJECT_NAME_PLURAL; ?></a></li>
				<?php 

					
					$internalGroupValues = getInternalGroupValues();
					
					$empTeams = getEmpTeams();
 	
				foreach($internalGroupValues as $intGroup){

						if(in_array($intGroup->optionObject, $empTeams)){
							$optionId = $intGroup->optionId;
							?>
							<li id="<?php echo $intGroup->optionId;?>" <?php if($val == $intGroup->optionId){$class='class=active'; echo $class;} ?>><a href="<?php echo PORTAL_ALLMYTEAMSTICKETS_URL.'?tid='.$intGroup->optionId;?>" disabled='disabled'>All <?php echo $intGroup->optionObject;?> Tickets</a> </li>
						<?php 							
						}
						
				}
				?>
				<!-- <li <?php if(is_page('my-teams-open-tickets')){$class='class=active'; echo $class;}?>><a href="<?php echo PORTAL_MYTEAMSOPENTICKETS_URL;?>">My Team’s Open Tickets</a></li>
				<li  <?php if(is_page('all-my-teams-tickets')){
					if($val==''){$class='class=active'; echo $class;}}?>><a href="<?php echo PORTAL_ALLMYTEAMSTICKETS_URL;?>">All My Team’s Tickets</a></li> -->
			</ul>
		</div>
		<?php }?>
		
		
	</div>
</div>