<!doctype html>  
<?php 
if(session_id() == '' || !isset($_SESSION)) { session_start(); }


function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

if($_SERVER['REQUEST_URI'] == '/' ){
       wp_redirect( AWP_WEBSITE_URL.'my-open-'.strtolower(OBJECT_NAME_PLURAL).'/' );
       exit;
 }
 
if(!isUserSet()){
	$is_login_page=false;
	$is_login_page=endsWith($_SERVER['REQUEST_URI'], "/register/");
	$is_login_page = endsWith($_SERVER['REQUEST_URI'], "/emplogin/");
	$is_login_page = endsWith($_SERVER['REQUEST_URI'], "/sso/");
	
	if(!$is_login_page){
		wp_redirect( PORTAL_LOGIN_URL);
		exit;
	
	}
}

if(isset($_REQUEST['a']) && $_REQUEST['a'] == 'logout'){
    $_SESSION['user'] = '';

}
//print_r($_SESSION);
//$emailId = $_SESSION['user']['email'];

 if(!isEmployeeSet()){
$username=$_SESSION['contactName'];
 }
 else 
 {
 	$username = getEmpDetails()->fullName;
 }
//echo $emailId;
?>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<?php  $login_case_url=esc_url( get_permalink( get_page_by_title( 'Login' ) ) );
	$change_pwd_url=esc_url( get_permalink( get_page_by_title( 'Change Password' ) ) );
	?>
	<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     <script type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		<!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
			<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->	
		
			<!-- respond.js -->
		<!--[if lt IE 9]>
		          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<![endif]-->	
		
		
	</head>
	
	<body <?php body_class(); ?>>
		<div class="filterotr">
		<header role="banner">
				
			<div class="navbar navbar-inverse">
				<div class="container-fluid">
          
					<div class="navbar-header">
						

						<a class="navbar-brand" title="Portal Home" href="<?php echo home_url().'/my-open-'.strtolower(OBJECT_NAME_PLURAL); ?>/"><img src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png"/></a>
					</div>

					
						<div class="dropdown pull-right top-user mrgtp15 nav-txt">
						<?php if(isEmployeeSet()){?>
						<a href="<?php echo APPTIVO_API_URL.'/app/home.jsp';?>"><button aria-expanded="true" aria-haspopup="true"  id="access_apptivo" name="access_apptivo" type="button" class="btn btn-primary access_apptivo">Access Apptivo</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php }?>
        <button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default dropdown-toggle"> <span class="fa fa-user"></span>   <?php echo $username;?></button>
        <ul aria-labelledby="dropdownMenu1" class="dropdown-menu">
        	     
          <li><a href="<?php echo $login_case_url.'?a=logout';?>"><span class="fa fa-sign-out"></span>  Log off</a></li>
          </ul>
      </div>
<div class="clearfix"></div>


				</div> <!-- end .container -->
			</div> <!-- end .navbar -->

<div class="title-bg">
<div class="title-sec">
<button type="button" class="navbar-toggle maintgle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						
						<ul id="menu-header-menu" class="nav navbar-nav">
						<?php 
						
							$ticketingURL = PORTAL_MYCASES_URL;
							$answersURL = PORTAL_ANSWERS_URL;
						
							if('Y' == ENABLE_SPLAH_SCREEN){
							
								$ticketingURL = "#";
								$answersURL = "#";
								
							}
						?>	
							
						<li <?php if(is_page('my-open-'.strtolower(OBJECT_NAME_PLURAL)) || is_page('all-open-'.strtolower(OBJECT_NAME_PLURAL)) || is_page('all-closed-'.strtolower(OBJECT_NAME_PLURAL)) || is_page(strtolower(OBJECT_NAME_PLURAL).'-pending-client-action') || is_page('all-'.strtolower(OBJECT_NAME_PLURAL)) || is_page('create-ticket')  ){$class='class=active'; echo $class;}?>><a href="<?php echo $ticketingURL.'">'.OBJECT_NAME_PLURAL;?></a></li>
                        
                        </ul>
						
<?php //wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
</div>

</div>

		
		</header> <!-- end header -->
		
		<div class="containerwhole">