<?php
// need current logged buyer's id to be passed to this page alongside the boardingID
$cardtype = 'Credit card';
include('../php/Validation.php');
include('../php/Crud.php');

//pass the boarding id to this page

session_start();


if(isset($_SESSION['boardingID'])&&isset($_SESSION['email'])){
    $boardingID = $_SESSION['boardingID'];

    $con = mysqli_connect("localhost","root","","accomodate_me_1");

    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }

///////////////////////////////////////////////////////////////////////////////////////////
    $query = "SELECT * FROM `boarding_details` WHERE `boardingID`='".$boardingID."'";

    $comments = mysqli_query($con,$query);

    $row=mysqli_fetch_array($comments,MYSQLI_NUM);

    $boardingPrice = $row[4];       //will get both price and the boarding owner's user id
    $userID = $row[1];
///////////////////////////////////////////////////////////////////////////////////////////
    $query = "SELECT * FROM `users` WHERE `userID`='".$userID."'";

    $comments = mysqli_query($con,$query);

    $row=mysqli_fetch_array($comments,MYSQLI_NUM);

    $sellerEmail = $row[3];
    $buyerEmail = $_SESSION['email'];
///////////////////////////////////////////////////////////////////////////////////////////
    $_SESSION['buyerEmail'] = $buyerEmail;
    $_SESSION['sellerEmail'] = $sellerEmail;
    $_SESSION['boardingPrice']=$boardingPrice/1.5367;
   echo $_SESSION['boardingPrice'];
    mysqli_close($con);

}

//validation

$validation=new Validation();
$crud=new Crud();

$first=$last=$email=$address1=$address2=$city="";
$error_message_EM=$error_message_FN=$error_message_LN=$error_message_address=$error_message_terms="";

if(isset($_POST['payment-data2'])){
   // echo 'data set';

    $first=$crud->escape_string($_POST['first']);
    $last=$crud->escape_string($_POST['last']);
    $email=$crud->escape_string($_POST['email']);
    $address1=$crud->escape_string($_POST['address1']);
    $address2=$crud->escape_string($_POST['address2']);
    $city=$crud->escape_string($_POST['city']);

    $termsread=isset($_POST['termsread'])?"checked":"unchecked";
    $termsagree=isset($_POST['termsagree'])?"checked":"unchecked";

    $cardtype = $_POST['card'];

    $msg=$validation->check_empty($_POST,array('first','last','email','address1','address2','city'));
    $check_firstname=$validation->is_name_valid($_POST['first']);
    $check_lastname=$validation->is_name_valid($_POST['last']);
    $check_email=$validation->is_email_valid($_POST['email']);
    $check_address1=$validation->is_address_valid($_POST['address1']);
    $check_address2=$validation->is_address_valid($_POST['address2']);


    if($msg!=null){
        $fillAllData="*Fill all required fields.";
    }elseif(!$check_firstname){
        $error_message_FN='*Invalid First name.';
    }elseif(!$check_lastname){
        $error_message_LN='*Invalid Last name';
    }elseif(!$check_email){
        $error_message_EM= '*Invald email address.';
    }elseif(!$check_address1||!$check_address2){
        $error_message_address= '*Invalid address.';
    }elseif($termsread=='unchecked'||$termsagree=='unchecked'){
        $error_message_terms= '*You have to agree to our terms and conditions.';
    }else{
        //if all the fields are filled
        $_SESSION['user-data'] = array($first,$last,$email,$address1,$address2,$city,$cardtype);
       header("Location: payment-post.php");
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>AccomodateME - Payments</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

		
		<link id="wsite-base-style" rel="stylesheet" type="text/css" href="http://cdn2.editmysite.com/css/sites.css?buildTime=1234" />
<link rel="stylesheet" type="text/css" href="http://cdn2.editmysite.com/css/old/fancybox.css?1234" />
<link rel="stylesheet" type="text/css" href="http://cdn2.editmysite.com/css/social-icons.css?buildtime=1234" media="screen,projection" />
<link rel="stylesheet" type="text/css" href="files/main_style.css?1500119982" title="wsite-theme-css" />
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Varela&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Lato:400,300,300italic,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<style type='text/css'>
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) div.paragraph, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) p, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-block .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-description, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, #wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {font-family:"Times New Roman" !important;}
#wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {color:#818181 !important;}
.wsite-elements.wsite-footer div.paragraph, .wsite-elements.wsite-footer p, .wsite-elements.wsite-footer .product-block .product-title, .wsite-elements.wsite-footer .product-description, .wsite-elements.wsite-footer .wsite-form-field label, .wsite-elements.wsite-footer .wsite-form-field label{}
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) h2, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-long .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-large .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-small .product-title, #wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {font-family:"Open Sans" !important;font-weight:300 !important;text-transform:  none !important;}
#wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {color:#4a7a75 !important;}
.wsite-elements.wsite-footer h2, .wsite-elements.wsite-footer .product-long .product-title, .wsite-elements.wsite-footer .product-large .product-title, .wsite-elements.wsite-footer .product-small .product-title{}
#wsite-title {font-family:"Varela" !important;font-weight: bold !important;}
.wsite-not-footer h2.wsite-content-title a, .wsite-not-footer .paragraph a, .wsite-not-footer blockquote a, #blogTable .blog-sidebar a, #blogTable .blog-comments a, #blogTable .blog-comments-bottom a, #wsite-com-store a, #wsite-com-product-gen a {color:#d5d5d5 !important;}
.wsite-menu-default a {}
.wsite-menu a {}
.wsite-image div, .wsite-caption {}
.galleryCaptionInnerText {}
.fancybox-title {}
.wslide-caption-text {}
.wsite-phone {}
.wsite-headline,.wsite-header-section .wsite-content-title {font-family:"Open Sans" !important;font-weight:300 !important;font-style:normal !important;text-transform:  none !important;letter-spacing: 0px !important;}
.wsite-headline-paragraph,.wsite-header-section .paragraph {font-family:"Lora" !important;}
.wsite-button-inner {font-family:"Lato" !important;font-weight:700 !important;letter-spacing: 1px !important;}
.wsite-not-footer blockquote {}
.wsite-footer blockquote {}
.blog-header h2 a {}
#wsite-content h2.wsite-product-title {}
.wsite-product .wsite-product-price a {}
.wsite-not-footer h2.wsite-content-title a:hover, .wsite-not-footer .paragraph a:hover, .wsite-not-footer blockquote a:hover, #blogTable .blog-sidebar a:hover, #blogTable .blog-comments a:hover, #blogTable .blog-comments-bottom a:hover, #wsite-com-store a:hover, #wsite-com-product-gen a:hover {color:#818181 !important;}
.wsite-button-small .wsite-button-inner {font-size:12px !important;}
.wsite-button-large .wsite-button-inner {font-size:12px !important;}
@media screen and (min-width: 767px) {.wsite-elements.wsite-not-footer:not(.wsite-header-elements) div.paragraph, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) p, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-block .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-description, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, #wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
#wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
.wsite-elements.wsite-footer div.paragraph, .wsite-elements.wsite-footer p, .wsite-elements.wsite-footer .product-block .product-title, .wsite-elements.wsite-footer .product-description, .wsite-elements.wsite-footer .wsite-form-field label, .wsite-elements.wsite-footer .wsite-form-field label{}
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) h2, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-long .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-large .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-small .product-title, #wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {font-size:30px !important;line-height:39px !important;}
#wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
.wsite-elements.wsite-footer h2, .wsite-elements.wsite-footer .product-long .product-title, .wsite-elements.wsite-footer .product-large .product-title, .wsite-elements.wsite-footer .product-small .product-title{}
#wsite-title {}
.wsite-menu-default a {}
.wsite-menu a {}
.wsite-image div, .wsite-caption {}
.galleryCaptionInnerText {}
.fancybox-title {}
.wslide-caption-text {}
.wsite-phone {}
.wsite-headline,.wsite-header-section .wsite-content-title {font-size:70px !important;}
.wsite-headline-paragraph,.wsite-header-section .paragraph {font-size:21px !important;}
.wsite-button-inner {}
.wsite-not-footer blockquote {}
.wsite-footer blockquote {}
.blog-header h2 a {}
#wsite-content h2.wsite-product-title {}
.wsite-product .wsite-product-price a {}
}</style>
<style>
.wsite-background {background-image: url("/uploads/4/3/0/7/4307940/background-images/391317221.jpg") !important;background-repeat: no-repeat !important;background-position: 50% 50% !important;background-size: 100% !important;background-color: transparent !important;background: inherit;}
body.wsite-background {background-attachment: fixed !important;}.wsite-background.wsite-custom-background{ background-size: cover !important}
</style>
		<script>
var STATIC_BASE = '//cdn1.editmysite.com/';
var ASSETS_BASE = '//cdn2.editmysite.com/';
var STYLE_PREFIX = 'wsite';
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>

<script type="text/javascript" src="http://cdn2.editmysite.com/js/lang/en/stl.js?buildTime=1234&"></script>
<script src="http://cdn2.editmysite.com/js/site/main.js?buildTime=1234"></script><script type="text/javascript">_W.configDomain = "www.weebly.com";</script><script>_W.relinquish && _W.relinquish()</script>
<script type="text/javascript" src="http://cdn2.editmysite.com/js/lang/en/stl.js?buildTime=1234&"></script><script> _W.themePlugins = {"navpane":{"condense":1024,"forced":1}};</script><script src='http://cdn2.editmysite.com/js/site/theme-plugins.js?buildTime=1234'></script><script type="text/javascript"> _W.recaptchaUrl = "https://www.google.com/recaptcha/api.js"; </script><script type="text/javascript"><!--
	var IS_ARCHIVE = 1;
	
	function initFlyouts(){
		initPublishedFlyoutMenus(
			[{"id":"675572425717657735","title":"Home","url":"index.html","target":"","nav_menu":false,"nonclickable":false}],
			"675572425717657735",
			'',
			'active',
			false,
			{"navigation\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}} class=\"wsite-menu-item-wrap\">\n\t<a\n\t\t{{^nonclickable}}\n\t\t\t{{^nav_menu}}\n\t\t\t\thref=\"{{url}}\"\n\t\t\t{{\/nav_menu}}\n\t\t{{\/nonclickable}}\n\t\t{{#target}}\n\t\t\ttarget=\"{{target}}\"\n\t\t{{\/target}}\n\t\t{{#membership_required}}\n\t\t\tdata-membership-required=\"{{.}}\"\n\t\t{{\/membership_required}}\n\t\tclass=\"wsite-menu-item\"\n\t\t>\n\t\t{{{title_html}}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n","navigation\/flyout\/list":"<div class=\"wsite-menu-wrap\" style=\"display:none\">\n\t<ul class=\"wsite-menu\">\n\t\t{{#children}}{{> navigation\/flyout\/item}}{{\/children}}\n\t<\/ul>\n<\/div>\n","navigation\/flyout\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}}\n\tclass=\"wsite-menu-subitem-wrap {{#is_current}}wsite-nav-current{{\/is_current}}\"\n\t>\n\t<a\n\t\t{{^nonclickable}}\n\t\t\t{{^nav_menu}}\n\t\t\t\thref=\"{{url}}\"\n\t\t\t{{\/nav_menu}}\n\t\t{{\/nonclickable}}\n\t\t{{#target}}\n\t\t\ttarget=\"{{target}}\"\n\t\t{{\/target}}\n\t\tclass=\"wsite-menu-subitem\"\n\t\t>\n\t\t<span class=\"wsite-menu-title\">\n\t\t\t{{{title_html}}}\n\t\t<\/span>{{#has_children}}<span class=\"wsite-menu-arrow\">&gt;<\/span>{{\/has_children}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n"},
			{"hasCustomMinicart":true}
		)
	}
//-->
</script>
		
		
	</head>
	<body class="header-page landing-page  wsite-page-index wsite-theme-light"><div class="wrapper">

		<div class="page-content w-navpane-slide">
			<div id="background">
				<div id="header">
					<div class="container">
						<div id="logo"><span class="wsite-logo">

	<a href="">
	
	<span id="wsite-title">MiLKY Payment Gateway</span>
	
	</a>

</span></div>

					</div>
				</div>
				<div class="wsite-elements wsite-not-footer wsite-header-elements">
	<div class="wsite-section-wrap">
	<div  class="wsite-section wsite-header-section wsite-section-bg-image" style="vertical-align: middle;background-image: url(&quot;/uploads/4/3/0/7/4307940/background-images/552028374.jpg&quot;) ;background-repeat: no-repeat ;background-position: 50% 50% ;background-size: 100% ;background-color: transparent ;background-size: cover;" >
		<div class="wsite-section-content">
			
					<div id="banner-wrap">
						<div id="gradient">
							<div class="container">
								<div id="banner">
				<div class="wsite-section-elements">
					<h2 class="wsite-content-title" style="text-align:left;">Ready to pay?</h2>

<div class="paragraph"><span>&#65279;</span>Fill out the following information in order to continue.</div>
				</div>
			</div>
							</div>
							<a id="landing-scroll" href="#main"></a>
						</div>
					</div>
				
		</div>
		<div class=""></div>
	</div>
</div>

</div>

			</div>
			<div id="main">
				<div id="wsite-content" class="wsite-elements wsite-not-footer">
	<div class="wsite-section-wrap">
	<div class="wsite-section wsite-body-section wsite-background-8 wsite-custom-background"  >
		<div class="wsite-section-content">
					<div class="container">
			<div class="wsite-section-elements">
				<div>
				<form enctype="multipart/form-data" action="pay.php"	method="POST">
					<div id="680408517929276928-form-parent" class="wsite-form-container"
					style="margin-top:10px;">
						<ul class="formlist" id="680408517929276928-form-list">
							<h2 class="wsite-content-title">Fields marked in * are compulsory.</h2>

<div><div class="wsite-form-field wsite-name-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-113940083397995996">Name <span class="form-required">*</span></label>
				<div style="clear:both;"></div>
				<div class="wsite-form-input-container wsite-form-left wsite-form-input-first-name">
					<input id="first" class="wsite-form-input wsite-input" type="text" name="first" value="<?php echo $first ?>"/>
                    <span><?php echo $error_message_FN ?></span>
					<label class="wsite-form-sublabel" for="input-113940083397995996">First</label>
				</div>
				<div class="wsite-form-input-container wsite-form-right wsite-form-input-last-name">
					<input id="last" class="wsite-form-input wsite-input" type="text" name="last" value="<?php echo $last ?>" />
                    <span><?php echo $error_message_LN ?></span>
					<label class="wsite-form-sublabel" for="input-113940083397995996-1">Last</label>
				</div>
				<div id="instructions-113940083397995996" class="wsite-form-instructions" style="display:none;"></div>
			</div>
			<div style="clear:both;"></div></div>

<div><div class="wsite-form-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-588931208464825502">Email <span class="form-required">*</span></label>
				<div class="wsite-form-input-container">
					<input id="email" class="wsite-form-input wsite-input wsite-input-width-370px" type="email" name="email" value="<?php echo $email ?>" />
                </div>
                 <span><?php echo $error_message_EM ?></span>
				<div id="instructions-588931208464825502" class="wsite-form-instructions" style="display:none;"></div>
			</div></div>

<div><div class="wsite-form-field wsite-address-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-252126718950259290">Address <span class="form-required">*</span></label>
				<div class="wsite-form-input-container">
					<input id="address1" class="wsite-form-input wsite-input" type="text" name="address1" value="<?php echo $address1 ?>"/>
					<label class="wsite-form-sublabel" for="input-252126718950259290">Line 1</label>
				</div>
				
				<div class="wsite-form-input-container">
					<input id="address2" class="wsite-form-input" type="text" name="address2" value="<?php echo $address2 ?>" />
					<label class="wsite-form-sublabel" for="input-252126718950259290-1">Line 2</label>
				</div>

				<div class="wsite-form-input-container wsite-form-left wsite-address-short">
					<input id="city" class="wsite-form-input" type="text" name="city"  value="<?php echo $city ?>"/>
					<label class="wsite-form-sublabel" for="input-252126718950259290-2">City</label>
				</div>

				<div id="instructions-252126718950259290" class="wsite-form-instructions" style="display:none;"></div>

			</div>

			<div style="clear:both;"></div></div>
                            <span><?php echo $error_message_address ?></span>
<div><div class="wsite-form-field" style="margin:5px 0px 0px 0px;">
  <label class="wsite-form-label" for="input-594154934508798724">Card type <span class="form-required">*</span></label>
  <div class="wsite-form-radio-container">
    <span class='form-radio-container'><input type='radio' id='radio-0-_u594154934508798724' name='card' value='Credit card' <?php if($cardtype=='Credit card'){echo 'checked';}else{echo 'unchecked';} ?> /><label for='radio-0-_u594154934508798724'>Credit card</label></span>
<span class='form-radio-container'><input type='radio' id='radio-1-_u594154934508798724' name='card' value='Debit card' <?php if($cardtype=='Debit card'){echo 'checked';}else{echo 'unchecked';} ?>/><label for='radio-1-_u594154934508798724'>Debit card</label></span>

  </div>
  <div id="instructions-Card type" class="wsite-form-instructions" style="display:none;"></div>
        <span><?php //echo $error_message_cardtype ?></span>
</div></div>

<div><div class="wsite-form-field" style="margin:5px 0px 0px 0px;">
  <label class="wsite-form-label" for="input-710447836305389263"> <span class="form-required"></span></label>
  <div class="wsite-form-radio-container">
    <span class='form-radio-container'><input type='checkbox' id='checkbox-0-_u710447836305389263' name='termsread' value='1' <?php if(isset($termsread)) {echo $termsread; }?> /><label for='checkbox-0-_u710447836305389263'>I have read the terms and conditions.</label></span>
<span class='form-radio-container'><input type='checkbox' id='checkbox-1-_u710447836305389263' name='termsagree' value='1' <?php if(isset($termsagree)) {echo $termsagree; }?> /><label for='checkbox-1-_u710447836305389263'>I agree to the terms and conditions.</label></span>

  </div>
  <div id="instructions-Choose Any" class="wsite-form-instructions" style="display:none;"></div>
        <span><?php echo $error_message_terms ?></span>
</div></div>
						</ul>
					</div>
					<div style="display:none; visibility:hidden;">
						<input type="text" name="wsite_subject" />
					</div>
					<div style="text-align:left; margin-top:10px; margin-bottom:10px;">
						<input type="hidden" name="form_version" value="2" />
						<input type="hidden" name="wsite_approved" id="wsite-approved" value="approved" />
						<input type="hidden" name="ucfid" value="680408517929276928" />
						<input type="hidden" name="payment-data2" value="set"/>

                        <input type="submit" name="payment-data" style="position:absolute;top:0;left:-9999px;width:1px;height:1px" />

                        <a class="wsite-button">
                            <span class="wsite-button-inner">Submit</span>
                        </a>
                        <br>
                        <span><?php if(!empty($fillAllData)) {echo $fillAllData; } ?></span>

					</div>
				</form>
				<div id="g-recaptcha-680408517929276928" class="recaptcha" data-size="invisible" data-recaptcha="0" data-sitekey="6Ldf5h8UAAAAAJFJhN6x2OfZqBvANPQcnPa8eb1C"></div>
			

			</div>
			</div>
		</div>
				</div>

	</div>
</div>

</div>

			</div>
			</div>

		<div id="desktop-nav" class="w-navlist nav">
			<div class="nav-wrap"><ul class="wsite-menu-default">
		<li id="active" class="wsite-menu-item-wrap">
			<a
						href="index.html"
				class="wsite-menu-item"
				>
				Home
			</a>
			
		</li>
</ul>
</div>
			<div class="social"></div>
		</div>

		<div id="nav" class="w-navpane nav w-navpane-slide">
			<div class="nav-wrap"><ul class="wsite-menu-default">
		<li id="active" class="wsite-menu-item-wrap">
			<a
						href="index.html"
				class="wsite-menu-item"
				>
				Home
			</a>
			
		</li>
</ul>
</div>
		</div>

	</div>
	<!-- JavaScript -->
	<script type="text/javascript" src="files/theme/plugins.js"></script>
	<script type="text/javascript" src="files/theme/custom.js"></script>
	<script type="text/javascript" src="files/theme/mobile.js"></script>


	</body>
</html>


