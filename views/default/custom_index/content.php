<?php
/**
 * Elgg custom index layout
 * 
 * This is just a helper view to make it easier to use Elgg's
 * page-rendering helper functions like elgg_view_page.
 */

$mod_params = array('class' => 'elgg-module-highlight');
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$site = elgg_get_site_entity();
$siteName = $site->name;
$siteUrl = elgg_get_site_url();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        echo elgg_view('resources/tutor-lms-elements/custom_index/header', array('site'=>$site, 'siteUrl'=>$siteUrl));
    ?>
    
</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== HEADER PART START ======-->
    
    <?php
        echo elgg_view('resources/tutor-lms-elements/custom_index/main', array('siteUrl'=>$siteUrl));
    ?>
       
    <!--====== HEADER PART ENDS ======-->
    
   </br>
    
    <!--====== SERVICES PART START ======-->
    
    
    
    <!--====== SERVICES PART ENDS ======-->
    
    <?php
        echo elgg_view('resources/tutor-lms-elements/custom_index/services', array('siteUrl'=>$siteUrl));
    ?>
    
    <!--====== ABOUT PART START ======-->
    
    <?php
        echo elgg_view('resources/tutor-lms-elements/custom_index/about', array('siteUrl'=>$siteUrl));
    ?>
    
    <!--====== ABOUT PART ENDS ======-->
        
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->   

<?php
        echo elgg_view('resources/tutor-lms-elements/custom_index/footer_scripts', array('site'=>$site));
    ?>

    
</body>

</html>
	 