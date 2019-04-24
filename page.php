<?php if(!is_page('login') && !is_page('register') && !is_page('emplogin') && !is_page('sso')){ ?>
<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						
					
						
				
						<section class="row post_content">
 
<?php if ( !is_page(array('contact','about','services','login','register','emplogin'))) { ;
get_sidebar('sidebar2');
} 

?>
<div class="mncntr">


<?php if(!is_page('view-answers')){ ?>
<div class="titlebg">
                <h4 id="articleTitle"><?php if(is_page('answers')){ echo "All Articles"; }
                
                else if(is_page('ticket-overview')){
                	$url=home_url();
                	$createtic_url=$_SERVER['HTTP_REFERER'];
                	
                	if($_SESSION['url'] == $url.'/search-'.strtolower(OBJECT_NAME_PLURAL).'/'){
                		session_start ();
                		//$_SESSION['flag']=1;
                			$_SESSION['search_flag']=false;
                	}
                
                	if(empty($_SESSION['url'])){
                		$urlRef = $url . '/my-open-'.strtolower(OBJECT_NAME_PLURAL).'/';
                	}else{
                		$urlRef =$_SESSION['url'];
                	}

      	?>
                	
                
                <h4 id="articleTitle"><a class="btn btn-default fltlft pd6p12p" href="<?php echo $urlRef;?>"><i class="fa fa-arrow-left"></i></a><?php echo OBJECT_NAME; ?> Overview</h4> <?php
				
                
                }
                
                else
                {
                	if($_GET['tid']==''){ 
               the_title();}
					else{
						$optionId = $_GET['tid'];
						$optionValue = getInternalGroupOptions($optionId);
						echo 'All' .' '.$optionValue.' '. OBJECT_NAME_PLURAL;
					}
                }
                ?></h4>
</div>
<?php } ?>
						
								<?php the_content(); ?>
								
							</div>
							
						
						
					</article> <!-- end article -->
					
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
<?php } ?>
                        
<?php if(is_page('login') && !is_page('register')){ 
	
	 $login_url=esc_url( get_permalink( get_page_by_title( 'Login' ) ) );
$my_case_url=esc_url( get_permalink( get_page_by_title( 'My Open '.OBJECT_NAME_PLURAL ) ) );
?>
                        <section class="container-fluid GrayBg aboutsec BookMarkWell">
	<a id="whychooseus" class="bookmark whychoosebmrk"></a>
	<div class="jumbotron TransBg ResetPadding">
    <div class="container ResetPaddingLR whychoosesec">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<script type="text/javascript" language="javascript">
$ = jQuery;
$(document).ready(function () {
	
	$('.change_pwd_frm').hide();
	$(".secure_code_frm").hide();
	$('.new_pswd_frm').hide();
	
	$('.frgt_pwd').click(function(){
		$('.form-signin').hide();
		$('.change_pwd_frm').show();
	});


	$("#change_pwd_frm").validate({
		rules: {
			email: {required: true,email: true},
		},
		messages: {
			email: { 
				required :"Please enter  email address",
				email :"Please enter valid email address"
			}
		},
		submitHandler: function(form) { 
			var emailId=$('#email').val();
			$.ajax({
				type: 'POST',
				url : '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {'action':'forgot_password',"emailid":emailId},
				success: function(data){                        
					if(data == 100){
						$("#change_pwd_frm").hide();
						$("#card_container").hide();
						$("#email_id").html(emailId);
						$(".secure_code_frm").show();
					}           
				}
			});
		}
	});

	
	$("#secure_code_frm").validate({
		rules: {
			sec_code: {required: true},
		},
		messages: {
			sec_code: { 
				required :"Please enter verification code"
			}
		},
		submitHandler: function(form) {  
			$("#secure_code_frm").hide();
			$("#card_container").hide();
			$("#ent_code").val($("#sec_code").val());
			$("#new_pswd_frm").show();
		}   
	});


	$("#new_pswd_frm").validate({
		rules: {
			new_pswd: {required: true},
		},
		messages: {
			new_pswd: { 
				required :"Please enter your new pswd"
			}
		},
		submitHandler: function(form) {  
			var secCode = $("#ent_code").val();
		 	var emailId =  $("#email_id").html();
		 	var newPswd = $("#new_pswd").val();
     		$.ajax({
         		type: 'POST',
         		url : '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {'action':'update_password',"newPswd":newPswd,"emailId":emailId,"secCode":secCode},
                success: function(data){
                    if(data == 100){
                        alert("Password Changed Successfully!");
                        window.location.href = '<?php echo $login_url;?>';
                    
                    }
                    else{
                        alert("Try again later");
                        window.location.href = '<?php echo $login_url;?>';  
                    }
                }       
     		});
		}   
	});



     
	 $("#sign_in").validate({
	        rules: {
	            login_email: {required: true,email: true},
	            login_password: {required: true}
	        },
	        messages: {
	            login_email: "Please enter your email address",
	            login_password: "Please enter valid password"
	        },
	               
	        submitHandler: function(form) { 
	            var user_name=$('#login_email').val(); 
	            var password=$('#login_password').val();
	            $('#loadimage').show();
	            $.ajax(
	            {
	                type: 'POST',
	                url : '<?php echo admin_url('admin-ajax.php'); ?>',
	                data: {'action':'cases_login',"user_name":user_name,"password":password},
	                success: function(data)
	                {              
						console.log(data);
	                    if(data == 100){
	                        window.location.href = '<?php echo $my_case_url; ?>';
	                    }
	                    else if(data == 'No Previlege'){
	                        window.location.href = '<?php echo $login_url;?>';
	                    }
	                    else{
	                        $("#loginmessage").html("<span style='color:red'>Username/ password is invalid</span>");
	                        $('#loadimage').hide();
	                    }
	                }
	            });
	        }
	    });
	     
});
</script>
   
   <style>
    body{background:#4b5058;  font-family: 'Nunito', sans-serif;}

.card-container.card {
  max-width: 240px;
  padding: 40px 40px;  
  margin: 0 auto;
  margin-top: 150px;
}
input, .btn, button, textarea, select{outline:none !improtant;  font-size: 14px;
  color: #333;}
.profile-name-card {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin: 10px 0 0;
  min-height: 1em;
}
.form-control:focus {
  border-color: #2fade7;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.reauth-email {
  display: block;
  color: #404040;
  line-height: 2;
  margin-bottom: 10px;
  font-size: 14px !important;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.btn.btn-signin {
  background-color: #2fade7;
  padding: 0px;
  font-weight: 700;
  font-size: 14px;
  height: 36px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  border: none;
  -o-transition: all 0.218s;
  -moz-transition: all 0.218s;
  -webkit-transition: all 0.218s;
  transition: all 0.218s;
  color:#fff;
}
.reset-btn{
	background-color: #2fade7;
    padding: 13px 35px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}
.card {
  background-color: #F7F7F7;
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  margin-top: 150px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.form-signin input[type=email], .form-signin input[type=password], .form-signin input[type=text], .form-signin button {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.change_pwd_frm input[type=email], .change_pwd_frm input[type=password], .change_pwd_frm input[type=text], .change_pwd_frm button {
  /*width: 100%;*/
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 5px 10px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 0px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
a.btn-signin {
  line-height: 36px;
  cursor: pointer;
}
.btn.btn-signin:hover, .btn.btn-signin:active, .btn.btn-signin:focus {
  background-color: #2fade7;
}
.card-container a:hover {
  text-decoration: none !important;
}
.signin_frm input {width:100% !important}
label.error {font-size: 12px;font-weight: normal;color: red;}    

button#reset {
  padding: 8px 20px 8px 20px;
  color: white;
  background-color: #2fade7;
  border: 2px solid #2fade7;
  font-weight: bold;
}
.reset-dialog li{margin-right:15px;} 
.btn-sec ul{display:inline-block;list-style:none;margin:10px;padding-top:20px;padding-left: 51%;}
.btn-sec ul li{display:inline-block;}
button.btn.btn-continue {
  padding: 6px 25px 6px 25px;
  background-color: #2fade7;
  border: 2px solid #2fade7;
  color: white;
}
button.btn.btn-cancel {
padding: 6px 25px 6px 25px;
  background-color: rgba(228, 227, 224, 0.99);
  border: 2px solid rgba(219, 218, 214, 0.99);
  color: rgb(31, 28, 28);
    margin-left: 15px;
}
.security-modal{
width:500px;
background-color:#ffffff;
margin: 0 auto;
  /* top: 50px; */
  margin-top: 15%;
  padding:25px;
}
</style>



<div class="container" id="card_container">
	<div class="card card-container">
		<div class="text-center">
			<center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
		</div>
		<p id="profile-name" class="profile-name-card"></p>
		<form id="sign_in" action="" method="post" name="sign_in" class="form-signin" novalidate="novalidate" >
			<div id="loginmain1">
				<div class="signin_frm">
					<div class="signin_input" id=""> 
						<span id="loginmessage" class="validationerror"> </span>
					</div>
					<input type="text" placeholder="Email address" name="login_email" title="Email" id="login_email" tabindex="2" class="form-control">
					<input type="password" placeholder="Password" name="login_password" title="Password" id="login_password" tabindex="3" class="form-control">
					<div class="logindiv">
						<center>
							<p class="lead">
								<span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
								<button type="submit" class="btn btn-primary btn-signin" id="login" name="login">Login</button>
							</p>
						</center>
						<center><p class="frgt_pwd"><a style="color: #2fade7;text-decoration:none;">Forgot Password?</a></p></center>
					</div>
				</div>
			</div>                                
		</form>
		
		<form id="change_pwd_frm" action="" method="post" name="change_pwd" class="change_pwd_frm" novalidate="novalidate" >
			<div id="loginmain1">
				<div class="change_pwd_fm">
					<div class="signin_input" id=""> 
						<span id="loginmessage" class="validationerror"> </span>
					</div>
					<input type="text" placeholder="Email address" name="email" title="Email" id="email" tabindex="2" class="form-control">
					<div class="logindiv" style="margin-top:30px;text-align:center;">
						<span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
						<ul class="list-inline reset-dialog" style="display:inline-block;list-style:none;margin:0px;padding:0px;"> 
                                              <li style="display:inline-block;"><button type="submit" class="btn btn-primary btn-lg btn-reset" id="reset" name="reset">Reset</button></li>
                                                <li style="display:inline-block;"><a href="<?php echo $login_url;?>" style="color: #2fade7;text-decoration:none; class="cancel_sign" alt="Cancel" title="Cancel">Cancel</a></li>
                                              </ul>
                                              
                                               </div>
                                             
                                    </div>
                                </div>                                
                            </form>
                            
                           
                           	
                              <div id="forgot_response" style="border-style: groove;display:none;padding: 20px;" ></div>
               
           
        </div><!-- /card-container -->
    </div>

    
  
    <form id="secure_code_frm" action="" method="post" name="secure_code_frm" class="secure_code_frm" novalidate="novalidate" >
                            <div class="security-modal">
                             <div class="text-center">
           <center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
           </div>
                            <div class="header-sec" style="margin-top:25px;">
                            <h3 style="margin:0px;font-size: 17px;color: rgb(69, 69, 69);font-weight: normal;">Enter Security Code</h3>
                           
                            </div>
                            <div class="body-cnt">
                            <p style="font-size: 13px;color: rgb(75, 80, 88);">Please check your email for a message with your code. Your code is 6 digits long.</p>
                            
                            <input type="text" class="form-control"  style="float:left; width:50%;font-size:20px;" placeholder="######" id="sec_code" name="sec_code" maxlength="6">
                          <div style="margin-top:10px;margin-top: -5px;float: right;width: 50%;">
                            <p style="margin:0px;padding-left:15px;color: rgb(69, 69, 69);font-weight: normal;">We sent your code to:</p>
                            <p style="margin:0px;padding-left:15px;font-size: 13px;color: rgb(75, 80, 88);" id="email_id"></p>
                            
                            </div>
                           <div class="btn-sec">
                           <ul>
                           <li><button type="submit" class="btn btn-continue" id="send_code" name="send_code">continue</button></li>
                           
                           <li><button type="button" class="btn btn-cancel" onclick="window.location.href='<?php echo PORTAL_LOGIN_URL;?>';">cancel</button></li>
                           
                           </ul> </div>
                            
                            </div>
                            
                            
                            
                            </div>
                            
                            </form>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
              
    <form id="new_pswd_frm" action="" method="post" name="new_pswd_frm" class="new_pswd_frm" novalidate="novalidate" >
                            <div class="security-modal">
                             <div class="text-center">
           <center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
           </div>
                            <div class="header-sec" style="margin-top:25px;">
                            <h3 style="margin:0px;font-size: 17px;color: rgb(69, 69, 69);font-weight: normal;">Choose a new password</h3>
                           
                            </div>
                            <div class="body-cnt">
                            <p style="font-size: 13px;color: rgb(75, 80, 88);">A strong password is a combination of letters and punctuation marks. It must be at least 6 characters long.</p>
                            <div style="margin-top:10px;margin-top: 5px;float:left;width: 27%;">
                            <p style="margin:0px;padding-left:15px;color: rgb(69, 69, 69);font-weight: normal;">New password</p>
                            
                            
                            </div>
                            <input type="password" class="form-control"  style="float:right; width:70%;font-size:20px;" placeholder="" id="new_pswd" name="new_pswd">
                            <input type="hidden" name="ent_code" id="ent_code" value="">
                          
                           <div class="btn-sec">
                           <ul>
                           <li><button type="submit" class="btn btn-continue" id="update_pswd" name="update_pswd">Continue</button></li>
                           
                           <li><button type="button" class="btn btn-cancel" onclick="window.location.href='<?php echo PORTAL_LOGIN_URL;?>';">cancel</button></li>
                           
                           </ul> </div>
                            
                            </div>
                            
                            
                            
                            </div>
                            
                            </form>
                  
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
    
            </div>
    </div>
</section>
                        
<?php }?>

                        
<?php if(is_page('register') && !is_page('login') ){ 

	
    $login_url=esc_url( get_permalink( get_page_by_title( 'Login' ) ) );
    
    ?>
                        <section class="container-fluid GrayBg aboutsec BookMarkWell">
	<a id="whychooseus" class="bookmark whychoosebmrk"></a>
	<div class="jumbotron TransBg ResetPadding">
    <div class="container ResetPaddingLR whychoosesec">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<script type="text/javascript" language="javascript">
$ = jQuery;
$(document).ready(function () {
    $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}
    $("#register_ticket").validate(
    {
        rules: {
            new_password: {required: true},
            confirm_password: {equalTo: "#new_password"}
        },
        messages: {
            new_password: "Please enter your password",
            confirm_password: "Password does not match"
        },
               
        submitHandler: function(form) { 
            var password=$('#new_password').val(); 
            var confirm_password=$('#confirm_password').val();
            var ticket_code=$.urlParam('uniqueCode');
            $('#loadimage').show();
            $.ajax(
            {
                type: 'POST',
                url : '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {'action':'register_ticket',"password":password,"confirm_password":confirm_password,"ticket_code":ticket_code},
                success: function(data)
                {                        
                    if(data == 100){
                        alert('Registration successful. Click ok to login');
                        $("#loginmessage").html("<span style='color:green'>Registration successful. Click ok to login</span>");
                        $('#loadimage').hide();
                        window.location.href = '<?php echo $login_url; ?>';
                    }
                    else{
                        alert('Please try after 5 minutes.');
                        $("#loginmessage").html("<span style='color:red'>Please try after 5 minutes.</span>");
                        $('#loadimage').hide();
                    }
                }
            });
        }
    });
});
</script>
   
   <style>
    body{background:#4b5058;  font-family: 'Nunito', sans-serif;}

.card-container.card {
  max-width: 240px;
  padding: 40px 40px;  
  margin: 0 auto;
  margin-top: 150px;
}
input, .btn, button, textarea, select{outline:none !improtant;  font-size: 14px;
  color: #333;}
.profile-name-card {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin: 10px 0 0;
  min-height: 1em;
}
.form-control:focus {
  border-color: #2fade7;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.reauth-email {
  display: block;
  color: #404040;
  line-height: 2;
  margin-bottom: 10px;
  font-size: 14px !important;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.btn.btn-signin {
  background-color: #2fade7;
  padding: 0px;
  font-weight: 700;
  font-size: 14px;
  height: 36px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  border: none;
  -o-transition: all 0.218s;
  -moz-transition: all 0.218s;
  -webkit-transition: all 0.218s;
  transition: all 0.218s;
  color:#fff;
}

.card {
  background-color: #F7F7F7;
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  margin-top: 150px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.form-signin input[type=email], .form-signin input[type=password], .form-signin input[type=text], .form-signin button {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 5px 10px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 0px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
a.btn-signin {
  line-height: 36px;
  cursor: pointer;
}
.btn.btn-signin:hover, .btn.btn-signin:active, .btn.btn-signin:focus {
  background-color: #2fade7;
}
.card-container a:hover {
  text-decoration: none !important;
}
.signin_frm input {width:100% !important}
label.error {font-size: 12px;font-weight: normal;color: red;}    
</style>



<div class="container">
        <div class="card card-container">
        <div class="text-center">
           <center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
           </div>
            <p id="profile-name" class="profile-name-card"></p>
           <form id="register_ticket" action="" method="post" name="register_ticket" class="form-signin" novalidate="novalidate">
                                <div id="loginmain1">
                                    <div class="signin_frm">
                                        <div class="signin_input" id=""> 
                                            <span id="loginmessage" class="validationerror"> </span>
                                        </div>
                                        
                                        <input type="password" placeholder="Password" name="new_password" title="New Password" id="new_password" tabindex="3" class="form-control">
                                         <input type="password" placeholder="Confirm Password" name="confirm_password" title="Confirm Password" id="confirm_password" tabindex="3" class="form-control">
                                        <div class="logindiv">
                                            <center><p class="lead"><span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
                                                <button type="submit" class="btn btn-primary btn-signin" id="register" name="register">Register</button></p></center>
                                        </div>
                                    </div>
                                </div>                                
                            </form>
           
        </div><!-- /card-container -->
    </div>

    
  
   
    
            </div>
    </div>
</section>
                        
<?php }

/*
 * Employee Login
 */

 if(is_page('emplogin') && !is_page('register') && !is_page('login')){ 
 	
 		
$my_case_url=esc_url( get_permalink( get_page_by_title( 'My Open '.OBJECT_NAME_PLURAL ) ) );
$emp_login_url=esc_url( get_permalink( get_page_by_title( 'EmpLogin' ) ) );
?>
                        <section class="container-fluid GrayBg aboutsec BookMarkWell">
	<a id="whychooseus" class="bookmark whychoosebmrk"></a>
	<div class="jumbotron TransBg ResetPadding">
    <div class="container ResetPaddingLR whychoosesec">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<script type="text/javascript" language="javascript">
$ = jQuery;
$(document).ready(function () {

	$('.change_pwd_frm').hide();
	$('.frgt_pwd').click(function(){
		$('.form-signin').hide();
	$('.change_pwd_frm').show();
		});
	
    $("#sign_in").validate(
    {
        rules: {
            login_email: {required: true,email: true},
            login_password: {required: true}
        },
        messages: {
            login_email: "Please enter your email address",
            login_password: "Please enter valid password"
        },
               
        submitHandler: function(form) { 
            var user_name=$('#login_email').val(); 
            var password=$('#login_password').val();
            $('#loadimage').show();
            $.ajax(
            {
                type: 'POST',
                url : '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {'action':'cases_login',"user_name":user_name,"password":password, "emp":"1"},
                success: function(data)
                {                        
                    if(data == 100){
                        window.location.href = '<?php echo $my_case_url; ?>';
                    }
                    else{
                        $("#loginmessage").html("<span style='color:red'>Username/ password is invalid</span>");
                        $('#loadimage').hide();
                    }
                }
            });
        }
    });
});
</script>
   
   <style>
    body{background:#4b5058;  font-family: 'Nunito', sans-serif;}

.card-container.card {
  max-width: 240px;
  padding: 40px 40px;  
  margin: 0 auto;
  margin-top: 150px;
}
input, .btn, button, textarea, select{outline:none !improtant;  font-size: 14px;
  color: #333;}
.profile-name-card {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin: 10px 0 0;
  min-height: 1em;
}
.form-control:focus {
  border-color: #2fade7;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.reauth-email {
  display: block;
  color: #404040;
  line-height: 2;
  margin-bottom: 10px;
  font-size: 14px !important;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.btn.btn-signin {
  background-color: #2fade7;
  padding: 0px;
  font-weight: 700;
  font-size: 14px;
  height: 36px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  border: none;
  -o-transition: all 0.218s;
  -moz-transition: all 0.218s;
  -webkit-transition: all 0.218s;
  transition: all 0.218s;
  color:#fff;
}

.reset-btn{
	background-color: #2fade7;
    padding: 13px 35px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}

.card {
  background-color: #F7F7F7;
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  margin-top: 150px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.form-signin input[type=email], .form-signin input[type=password], .form-signin input[type=text], .form-signin button {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 5px 10px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 0px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
a.btn-signin {
  line-height: 36px;
  cursor: pointer;
}
.btn.btn-signin:hover, .btn.btn-signin:active, .btn.btn-signin:focus {
  background-color: #2fade7;
}
.card-container a:hover {
  text-decoration: none !important;
}
.signin_frm input {width:100% !important}
label.error {font-size: 12px;font-weight: normal;color: red;}    
</style>



<div class="container">
        <div class="card card-container">
        <div class="text-center">
           <center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
           </div>
            <p id="profile-name" class="profile-name-card"></p>
           <form id="sign_in" action="" method="post" name="sign_in" class="form-signin" novalidate="novalidate">
                                <div id="loginmain1">
                                    <div class="signin_frm">
                                        <div class="signin_input" id=""> 
                                            <span id="loginmessage" class="validationerror"> </span>
                                        </div>
                                        <input type="text" placeholder="Email address" name="login_email" title="Email" id="login_email" tabindex="2" class="form-control">
                                        <input type="password" placeholder="Password" name="login_password" title="Password" id="login_password" tabindex="3" class="form-control">
                                        <div class="logindiv">
                                            <center><p class="lead"><span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
                                                <button type="submit" class="btn btn-primary btn-signin" id="login" name="login">Login</button></p></center>
                                               <!-- <center><p class="frgt_pwd"><a href="#" style="color: #2fade7;">Forgot Password?</a></p></center> --> 
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                            
                               <form id="change_pwd_frm" action="" method="post" name="change_pwd" class="change_pwd_frm" novalidate="novalidate">
                                <div id="loginmain1">
                                    <div class="change_pwd_fm">
                                        <div class="signin_input" id=""> 
                                            <span id="loginmessage" class="validationerror"> </span>
                                        </div>
                                        <input type="text" placeholder="Email address" name="email" title="Email" id="email" tabindex="2" class="form-control">
                                       
                                        <div class="logindiv" style="margin-top:30px;text-align:center;">
                                            <span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
                                                <button type="submit" class="btn btn-primary btn-signin" id="cpwd" name="cpwd" style="padding:10px 20px;">Reset</button>  <a href="<?php echo $emp_login_url;?>" style="color: #2fade7;text-decoration:none; class="cancel_sign" alt="Cancel" title="Cancel">Cancel</a>
                                              
                                               </div>
                                    </div>
                                </div>                                
                            </form>
           
           
        </div><!-- /card-container -->
    </div>

    
  
   
    
            </div>
    </div>
</section>
 		
 		<?php 

  }?>



<?php 

/*
 * SSO Login
 */

 if(is_page('sso') && !is_page('register') && !is_page('login')){ 
 	
 		
$my_case_url=esc_url( get_permalink( get_page_by_title( 'My Open '.OBJECT_NAME_PLURAL ) ) );
$emp_login_url=esc_url( get_permalink( get_page_by_title( 'EmpLogin' ) ) );


if(isset($_GET['st']) && $_GET['st']){
$sessionToken = $_GET['st'];
//echo $sessionToken;
$response = getSession($sessionToken);

//echo $empSessionKey .'<br>';
if (isset ( $response->responseCode ) && $response->responseCode == 0) {
	$_SESSION['setemp']="employees";
	setSessionKey($response->responseObject->authenticationKey);
	$emp = getEmpDetails();
	$email = $emp->emailId;
	setUserEmail($email);
	
	$teams = getAllEmployeeTeams();
			//po1($teams);
			$empTeams = array();
			foreach($teams as $team){
				//error_log("MOHAMMED - TEAM NAME => " . $team->name);
				$empTeams[] = $team->name;
			}
	setEmpTeams($empTeams);
	
	
	$caseConfigurationData = getAllCasesConfigData ();

	$KBConfigData=getAnswersConfigData();

	setKBConfigData ( $KBConfigData );
	
	if($caseConfigurationData == null){
			echo '102';
			exit;
		}
		setCaseConfigData ( $caseConfigurationData );

		$leadConfigData = getAllLeadConfigData1();
		
		
		if($leadConfigData == null){
			echo '103';exit;
		}

		setLeadConfigData ( $leadConfigData );
		
		$contactConfigData = getAllContactConfigData1 ();

		// 		error_log("KORADA - CONTACT CONFIG DATA  => " . json_encode($contactConfigData));

		if($contactConfigData == null){
			echo '104';exit;
		}

		setContactConfigData($contactConfigData);




		$customerConfigData = getAllCustomerConfigData();

		// 		error_log("KORADA - CUSTOMER CONFIG DATA  => " . json_encode($customerConfigData));

		if($customerConfigData == null){
			echo '105';exit;
		}

		setCustomerConfigData($customerConfigData);


		// 		error_log("KORADA - CONTACT CONFIG DATA  => " . json_encode($contactConfigData));
		// 		error_log("KORADA - CONTACT CONFIG DATA in sesssion => " . json_encode(getContactConfigData()));

		retrieveAccreditedOption();

		$contactConfigData = json_decode ( $contactConfigData->webLayout, true );

		$contact_sections = $contactConfigData ['sections'];
		// 		// po1($contact_sections);

		$ca_accredited_user_id = '';
		foreach ( $contact_sections as $cont_sections ) {
			// echo $cont_sections['id'].'<br />';
			// if ( $cont_sections['id'] == 'contact_inf_section' ) {
			if ($cont_sections ['id'] == 'addtional_inf_section' || $cont_sections ['id'] == 'contact_inf_section') {
				// echo 'aa'; exit;
				foreach ( $cont_sections ['attributes'] as $add_info_attributes ) {
						
					if ($add_info_attributes ['type'] == 'Custom' && $add_info_attributes ['label'] ['modifiedLabel'] == 'Accredited User') {
						$ca_accredited_user_id = $add_info_attributes ['attributeId'];
						// echo $ca_accredited_user_id;
						$_SESSION ['ACC_USER_OPTION'] = $add_info_attributes ['right'];
					}
				}
			}
			}
			$_SESSION ['isAccreditedUser'] = 'NO';
			
			if($response->responseObject->firmId != APPTIVO_FIRM_ID) {
						
					$customerData = get_customer_by_objectId($contactDetails->accountId);
						
					if(!isset($customerData)) {
						echo "106";exit;
					}
						
					setCustomerSessionData($customerData);
					setAccreditedUserInfo();
						
				} else {

					$userPrevilege = getuserPrivilegeMap();
					foreach($userPrevilege as $key => $value) {
						if($key == 'INTERNAL_PORTAL_USER'){
							$previlege = $key;
								
						}
					}
					if($previlege == 'INTERNAL_PORTAL_USER'){
						$_SESSION['setemp']="employees";
					}else{
					
					 	wp_redirect(PORTAL_EMPLOGIN_URL);
					 	exit ();
					}
				
				}
				$support_config_weblayout = $caseConfigurationData->webLayout;
				$support_weblayout = json_decode ( $support_config_weblayout, true );
				$support_weblayout_sections = $support_weblayout ['sections'];
				// echo "<pre>";print_r($support_weblayout_sections);
				$case_form_data = array ();
				foreach ( $support_weblayout_sections as $layout_sections ) {
					$section_attributes = $layout_sections ['attributes'];
					//echo "<pre>";print_r($section_attributes);
					foreach ( $section_attributes as $sec_attrivbutes ) {
						$labe_name = $sec_attrivbutes ['label'] ['modifiedLabel'];
							
						switch ($labe_name) {
							case 'Solution' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Severity' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Your current Ascender Pay Version' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
									
							case 'Sub-Status':
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;

							case 'Support Request Type':
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
									
							case 'Service Request Type':
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Incident Type':
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
									
							case 'Your Current Ascender Pay Critical Patch' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
									
							case 'AP Environment':
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Email' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Problem #' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Release' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'TSC Assignee' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							case 'Internal Group' : // Custom
								$case_form_data [$labe_name] = $sec_attrivbutes;
								break;
							default :
								break;
						}
					}
				}
					
				$_SESSION ['solution_option_lists'] = $case_form_data ['Solution'] ['right'] ['0'] ['optionValueList'];
				$_SESSION ['solution_attribute_id'] = $case_form_data ['Solution'] ['attributeId'];
				$_SESSION ['solution_tag_name'] = $case_form_data ['Solution'] ['right'] ['0'] ['tagName'];
				$_SESSION ['solution_options'] = $case_form_data ['Solution'] ['right'] ['0'] ['options'];
				// echo "<pre>";print_r($case_form_data['Severity']);
				$_SESSION ['severity_attribute_id'] = $case_form_data ['Severity'] ['attributeId'];
				$_SESSION ['severity_tag_name'] = $case_form_data ['Severity'] ['right'] ['0'] ['tagName'];
				$_SESSION ['severity_option_lists'] = $case_form_data ['Severity'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['pay_version_attribute_id'] = $case_form_data ['Your current Ascender Pay Version'] ['attributeId'];
				$_SESSION ['pay_version_tag_name'] = $case_form_data ['Your current Ascender Pay Version'] ['right'] ['0'] ['tagName'];
				$_SESSION ['pay_version_option_lists'] = $case_form_data ['Your current Ascender Pay Version'] ['right'] ['0'] ['optionValueList'];
				// po1($case_form_data['Your current Ascender Pay Version']['right']['0']['optionValueList']);
					
				$_SESSION ['substatus_attribute_id'] = $case_form_data ['Sub-Status'] ['attributeId'];
				$_SESSION ['substatus_tag_name'] = $case_form_data ['Sub-Status'] ['right'] ['0'] ['tagName'];
				$_SESSION ['substatus_option_lists'] = $case_form_data ['Sub-Status'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['suppreqtype_attribute_id'] = $case_form_data ['Support Request Type'] ['attributeId'];
				$_SESSION ['suppreqtype_tag_name'] = $case_form_data ['Support Request Type'] ['right'] ['0'] ['tagName'];
				$_SESSION ['suppreqtype_option_lists'] = $case_form_data ['Support Request Type'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['servreqtype_attribute_id'] = $case_form_data ['Service Request Type'] ['attributeId'];
				$_SESSION ['servreqtype_tag_name'] = $case_form_data ['Service Request Type'] ['right'] ['0'] ['tagName'];
				$_SESSION ['servreqtype_option_lists'] = $case_form_data ['Service Request Type'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['incitype_attribute_id'] = $case_form_data ['Incident Type'] ['attributeId'];
				$_SESSION ['incitype_tag_name'] = $case_form_data ['Incident Type'] ['right'] ['0'] ['tagName'];
				$_SESSION ['incitype_option_lists'] = $case_form_data ['Incident Type'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['apenv_attribute_id'] = $case_form_data ['AP Environment'] ['attributeId'];
				$_SESSION ['apenv_tag_name'] = $case_form_data ['AP Environment'] ['right'] ['0'] ['tagName'];
				$_SESSION ['apenv_option_lists'] = $case_form_data ['AP Environment'] ['right'] ['0'] ['optionValueList'];
					
					
				$_SESSION ['critical_patch_attribute_id'] = $case_form_data ['Your Current Ascender Pay Critical Patch'] ['attributeId'];
				$_SESSION ['critical_patch_tag_name'] = $case_form_data ['Your Current Ascender Pay Critical Patch'] ['right'] ['0'] ['tagName'];
				$_SESSION ['critical_patch_option_lists'] = $case_form_data ['Your Current Ascender Pay Critical Patch'] ['right'] ['0'] ['optionValueList'];
					
				$_SESSION ['reference_customfield1_attribute_id'] = $case_form_data ['Problem #'] ['attributeId'];
				$_SESSION ['reference_customfield1_tag_name'] = $case_form_data ['Problem #'] ['right'] ['0'] ['tagName'];
					
				$_SESSION ['reference_customfield2_attribute_id'] = $case_form_data ['Release'] ['attributeId'];
				$_SESSION ['reference_customfield2_tag_name'] = $case_form_data ['Release'] ['right'] ['0'] ['tagName'];
					
				$_SESSION ['reference_customfield3_attribute_id'] = $case_form_data ['TSC Assignee'] ['attributeId'];
				$_SESSION ['reference_customfield3_tag_name'] = $case_form_data ['TSC Assignee'] ['right'] ['0'] ['tagName'];
					
				$_SESSION ['email_attribute_id'] = $case_form_data ['Email'] ['attributeId'];
				$_SESSION ['email_tag_name'] = $case_form_data ['Email'] ['right'] ['0'] ['tagName'];
				$_SESSION ['email_field_type'] = $case_form_data ['Email'] ['right'] ['0'] ['tag'];
				$_SESSION ['email_tag_id'] = $case_form_data ['Email'] ['right'] ['0'] ['tagId'];
					
					
				$_SESSION ['internal_group_attribute_id'] = $case_form_data ['Internal Group'] ['attributeId'];
				$_SESSION ['internal_group_tag_name'] = $case_form_data ['Internal Group'] ['right'] ['0'] ['tagName'];
				$_SESSION ['internal_group_option_lists'] = $case_form_data ['Internal Group'] ['right'] ['0'] ['optionValueList'];
	
				
			wp_redirect(PORTAL_MYCASES_URL);
			exit ();
			}

else{
	
	wp_redirect(PORTAL_EMPLOGIN_URL);
	exit ();
}
}

?>
                        <section class="container-fluid GrayBg aboutsec BookMarkWell">
	<a id="whychooseus" class="bookmark whychoosebmrk"></a>
	<div class="jumbotron TransBg ResetPadding">
    <div class="container ResetPaddingLR whychoosesec">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<script type="text/javascript" language="javascript">


$ = jQuery;
$(document).ready(function () {

	    $("#login").click(function(){ 
      
            $('#loadimage').show();
            $.ajax(
            {
                type: 'POST',
                url : '<?php echo admin_url('admin-ajax.php'); ?>',
                dataType : 'json',
                data: {'action':'cases_login',"sso":"1"},
                success: function(data)
                {   
                    console.log(data);
                  var url = data.responseUrl;
                    if(data.responseCode == 100 ){
                    
                    	window.location.href = url;
                    	
                        }
                    else{
                        $("#loginmessage").html("<span style='color:red'>Username/ password is invalid</span>");
                        $('#loadimage').hide();
                    }
                }
            });
    });

 
 	
    
 
});
</script>
   
   <style>
    body{background:#4b5058;  font-family: 'Nunito', sans-serif;}

.card-container.card {
  max-width: 240px;
  padding: 40px 40px;  
  margin: 0 auto;
  margin-top: 150px;
}
input, .btn, button, textarea, select{outline:none !improtant;  font-size: 14px;
  color: #333;}
.profile-name-card {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin: 10px 0 0;
  min-height: 1em;
}
.form-control:focus {
  border-color: #2fade7;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.reauth-email {
  display: block;
  color: #404040;
  line-height: 2;
  margin-bottom: 10px;
  font-size: 14px !important;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.btn.btn-signin {
  background-color: #2fade7;
  padding: 0px;
  font-weight: 700;
  font-size: 14px;
  height: 36px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  border: none;
  -o-transition: all 0.218s;
  -moz-transition: all 0.218s;
  -webkit-transition: all 0.218s;
  transition: all 0.218s;
  color:#fff;
}

.reset-btn{
	background-color: #2fade7;
    padding: 13px 35px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}

.card {
  background-color: #F7F7F7;
  padding: 20px 25px 30px;
  margin: 0 auto 25px;
  margin-top: 150px;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.form-signin input[type=email], .form-signin input[type=password], .form-signin input[type=text], .form-signin button {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.form-control {
  display: block;
  width: 100%;
  height: 34px;
  padding: 5px 10px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 0px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
a.btn-signin {
  line-height: 36px;
  cursor: pointer;
}
.btn.btn-signin:hover, .btn.btn-signin:active, .btn.btn-signin:focus {
  background-color: #2fade7;
}
.card-container a:hover {
  text-decoration: none !important;
}
.signin_frm input {width:100% !important}
label.error {font-size: 12px;font-weight: normal;color: red;}   

button#reset {
  padding: 8px 20px 8px 20px;
  color: white;
  background-color: #2fade7;
  border: 2px solid #2fade7;
  font-weight: bold;
}
.reset-dialog li{margin-right:15px;}  
</style>



<div class="container">
        <div class="card card-container">
        <div class="text-center">
           <center><img id="profile-img" src="<?php echo SITEURL;?>/wp-content/themes/apptivoportal/images/apptivo-logo1.png" alt="logo"></center>
           </div>
            <p id="profile-name" class="profile-name-card"></p>
           <form id="sign_in" action="" method="post" name="sign_in" class="form-signin" novalidate="novalidate">
                                <div id="loginmain1">
                                    <div class="signin_frm">
                                        <div class="signin_input" id=""> 
                                            <span id="loginmessage" class="validationerror"> </span>
                                        </div>
                                      <!--   <input type="text" placeholder="Email address" name="login_email" title="Email" id="login_email" tabindex="2" class="form-control">
                                        <input type="password" placeholder="Password" name="login_password" title="Password" id="login_password" tabindex="3" class="form-control"> -->
                                        <div class="logindiv">
                                            <center><p class="lead"><span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
                                             <div id='success_msg'><?php echo $response_msg;?></div>
                                                <button type="button" class="btn btn-primary btn-signin" id="login" name="login">Login With SSO</button></p></center>
                                                <input type="hidden" id="second_page" name="second_page" value="">
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                            
                         <!--       <form id="change_pwd_frm" action="" method="post" name="change_pwd" class="change_pwd_frm" novalidate="novalidate">
                                <div id="loginmain1">
                                    <div class="change_pwd_fm">
                                        <div class="signin_input" id=""> 
                                            <span id="loginmessage" class="validationerror"> </span>
                                        </div>
                                        <input type="text" placeholder="Email address" name="email" title="Email" id="email" tabindex="2" class="form-control">
                                       
                                        <div class="logindiv" style="margin-top:30px;text-align:center;">
                                            <span style="display:none;" id="loadimage"><img src="https://apptivoapp.cachefly.net/site/v1.0.5/images/aloading.gif" style="padding:6px 10px 10px;"></span>
                                               <ul class="list-inline reset-dialog" style="display:inline-block;list-style:none;margin:0px;padding:0px;"> 
                                              <li style="display:inline-block;"><button type="submit" class="btn btn-primary btn-lg btn-reset" id="reset" name="reset">Reset</button></li>
                                                <li style="display:inline-block;"><a href="<?php echo $emp_login_url;?>" style="color: #2fade7;text-decoration:none; class="cancel_sign" alt="Cancel" title="Cancel">Cancel</a></li>
                                              </ul>
                                              
                                               </div>
                                    </div>
                                </div>                                
                            </form> -->
           
           
        </div><!-- /card-container -->
    </div>

    
  
   
    
            </div>
    </div>
</section>
 		
 		<?php 

  }?>