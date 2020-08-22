<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['head']        Parameters for the <head> element
 * @uses $vars['body_attrs']  Attributes of the <body> tag
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */

// render content before head so that JavaScript and CSS can be loaded. See #4032
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));

$header = elgg_view('page/elements/header', $vars);
$navbar = elgg_view('page/elements/navbar', $vars);
$content = elgg_view('page/elements/body', $vars);
$footer = elgg_view('page/elements/footer', $vars);
$site = elgg_get_site_entity();
$siteName = $site->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php

echo elgg_view('tutor_lms_theme/elements/header');
echo elgg_view('page/elements/head', $vars['head']);
?>
</head>
<body id="mimin" class="dashboard">
      <!-- start: Header -->
        <?php
          echo elgg_view('tutor_lms_theme/elements/topbar');
        ?>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
          <?php
          echo elgg_view('tutor_lms_theme/elements/left_menu');
          ?>
          <!-- end: Left Menu -->
<div class="elgg-page-messages">
		<?php echo $messages ?>
	</div>
          <!-- start: Content -->
          <div id="content">
            <div class="col-md-12 padding-0">
              <div class="col-md-12 padding-0">
                <div class="col-md-12 padding-0">
                  <div class="panel box-shadow-none content-header">
                      <div class="panel-body">
                        <div class="col-md-12">
                            <h3 class="animated fadeInLeft"> </h3>
                            <p class="animated fadeInDown" style="line-height:.4;">
                              Welcome To <?php echo $siteName; ?>
                            </p>
                        </div>
                      </div>
                  </div>
                </div>
                   <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="panel">
                      <div class="panel-heading">
                        <h4><?php echo elgg_echo('tutor-lms:main:title'); ?></h4>
                      </div>
                      <div class="panel-body">
                            
                            <div class="col-md-12">
                                 <?php
                                 echo $content;
                                 ?>
                            </div>

                      </div>
                    </div>
                </div>
                  </div>
                
              </div>
            </div>
          </div>
          <!-- end: Content -->

            <!-- start: right menu -->
           <?php
            //    echo elgg_view('tutor_lms_theme/elements/right_menu');
           ?>
          <!-- end: right menu -->
          
      </div>

      <!-- start: Mobile -->
      <?php
          echo elgg_view('tutor_lms_theme/elements/mobile_menu');
      ?>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
       <!-- end: Mobile -->
<?php 
echo elgg_view('tutor_lms_theme/elements/footer');
echo elgg_view('page/elements/foot');

?>
<!-- end: Javascript -->
</body>
</html>