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
</br>
</br>
        <form class="form-signin" action="<?php echo $siteUrl?>action/login" method="post">
            <?php
                    $ts = time();
                    $token = generate_action_token($ts);
                ?>
            
          <div class="panel periodic-login">
              <a href="<?php echo $siteUrl?>"><span class="atomic-number">< <?php echo elgg_echo('tutor-lms:login:goback'); ?></span></a>
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol" style="font-size: 52px !important;"><?php echo elgg_echo('tutor-lms:login:branding'); ?></h1>
                   

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" required  name="username" id="login">
                    <span class="bar"></span>
                    <label><?php echo elgg_echo('tutor-lms:login:username'); ?></label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" required name="password" id="password">
                    <span class="bar"></span>
                    <label><?php echo elgg_echo('tutor-lms:login:password'); ?></label>
                  </div>
                  <label class="pull-left">
                  <input type="checkbox" class="icheck pull-left" name="checkbox1"/> <?php echo elgg_echo('tutor-lms:login:remember'); ?>
                  </label>
                  <input type="hidden" name="__elgg_token" value="<?php echo $token; ?>"/>
                <input type="hidden" name="__elgg_ts" value="<?php echo $ts; ?>" />

                  <input type="submit" class="btn col-md-12" value="<?php echo elgg_echo('tutor-lms:login:button'); ?>"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="<?php echo $siteUrl?>forgotpassword"><?php echo elgg_echo('tutor-lms:login:forgotpassword'); ?></a>
                    <a href="<?php echo $siteUrl?>register">| <?php echo elgg_echo('tutor-lms:login:register'); ?></a>
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
