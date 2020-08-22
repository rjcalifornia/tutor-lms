<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * 
 */
$siteUrl = elgg_get_site_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

echo elgg_view('tutor_lms_theme/elements/header');
//echo elgg_view('page/elements/head', $vars['head']);
?>
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

        <form class="form-signin" action="<?php echo $siteUrl?>action/login" method="post">
            <?php
                    $ts = time();
                    $token = generate_action_token($ts);
                ?>

          <div class="panel periodic-login">
              <a href="<?php echo $siteUrl?>"><span class="atomic-number">< Go back</span></a>
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol">Mi</h1>
                  <p class="atomic-mass">14.072110</p>
                  <p class="element-name">Miminium</p>

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" required  name="username" id="login">
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" required name="password" id="password">
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <label class="pull-left">
                  <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Remember me
                  </label>
                  <input type="hidden" name="__elgg_token" value="<?php echo $token; ?>"/>
                <input type="hidden" name="__elgg_ts" value="<?php echo $ts; ?>" />

                  <input type="submit" class="btn col-md-12" value="SignIn"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="forgotpass.html">Forgot Password </a>
                    <a href="reg.html">| Signup</a>
                </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <?php 
echo elgg_view('tutor_lms_theme/elements/footer');
echo elgg_view('page/elements/foot');

?>
     <!-- end: Javascript -->
   </body>
   </html>
