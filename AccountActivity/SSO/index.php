<?php
// Include FB config file && User class
require_once 'fbConfig.php';
require_once 'User.php';
require_once('../../libraries/language.php');
$lang = new Language();
$lang->load("mainPage");
$lang2 = new Language();
$lang2->load("select");

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
          // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirect the user back to the same page if url has "code" parameter in query string
    if(isset($_GET['code'])){
        header('Location: ./');
    }
    
    // Getting user facebook profile info
    try {
        $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
        $fbUserProfile = $profileRequest->getGraphNode()->asArray();
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // Redirect user back to app login page
        header("Location: ./");
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Initialize User class
    $user = new User();
    
    // Insert or update user data to the database
    $fbUserData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'    => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'email'         => $fbUserProfile['email'],
        'gender'        => $fbUserProfile['gender'],
        'locale'        => $fbUserProfile['locale'],
        'picture'       => $fbUserProfile['picture']['url'],
        'link'          => $fbUserProfile['link']
    );
    $userData = $user->checkUser($fbUserData);
    
    // Put user data into session
    $_SESSION['userData'] = $userData;
    
    // Get logout url
    $logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');
    
    // Render facebook profile data
    if(!empty($userData)){

        $output = '<form name="LoginForm" method="post" action="../loginController.php?action=connectAccount">
						<div class="form-group">
							<label for="InputAccount">請問這是您嗎？</label>
							<input type="text" class="form-control"  value="'.$userData['email'].'" name="user" readonly>
							
							<input type="hidden" class="form-control" value="0000" name="password" ></br>
							<input type="hidden" class="form-control" value="'.$userData['link'].'" name="userprofile" readonly></br>
							<!--用id 就不會在網址上面顯示了，但是用name會-->
							<input name="submit" type="submit" class="btn btn-default" value="確認" >
						</div>
					</form>';
        $output .= '<br/>Logout from <a href="'.$logoutURL.'">Facebook</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
}else{
    // Get login url
    $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    // Render facebook login button
    $output = '<a href="'.$loginURL.'">使用FB登入</a>';
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>BookChange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/css/sweetalert2.css" rel="stylesheet" type="text/css"/>
</head>
<script src="../../assets/Js/sweetalert2.js"></script>
<script src="../../assets/Js/JQuery.js"></script>
<script src="../../assets/Js/JQuery2.0.js"></script>
<script src="../../assets/Js/bootstrap.min.js"></script>
<script src="../../assets/Js/commonJS.js"></script>
<script src="../Js/Login.js"></script>
<script src="../Js/fbLogin.js"></script>

 <!--Append URL issue-->
<script>
    
$(document).on('page:change', function (e) {
      if (window.location.hash && window.location.hash == '#_=_') {
          window.location.hash = '';
          history.pushState('', document.title, window.location.pathname); // nice and clean

          e.preventDefault(); // no page reload

      }
});



</script>

<body>
<!--Navbar-->
<div id="header"></div>
<form id="searchbox" align="center" action="">
    <ul>
        <select id="select" name="select">
            <?php
            echo'<option value="book_name">'. $lang2->line("select.bookName"). '</option>';
            echo'<option value="publishingHouse">'. $lang2->line("select.publishingHouse"). '</option>';
            echo'<option value="author">'. $lang2->line("select.author"). '</option>';
            ?>
        </select>
        <?php
        echo'<input id="search" type="text" placeholder="'. $lang2->line("select.search"). '?">';
        ?>
        <input type="button" class="btn-danger" value="search" onclick="Search()">
    </ul>
</form>
<?php
echo'<h1 align="center">'. $lang->line("mainPage.declaration"). '!<br/></h1>';
?>
<!-- <p align="center">沒事多喝水，有事多上廁所</p><hr> -->
<!--登入表單-->
<div class="container">
<div align="center">
	<!--FB登入-->
	<h2>
	<?php echo $output; ?>
	</h2>
</div>
</div>
<!--<div id="footer"></div>-->
</body>
</html>