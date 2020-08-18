<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$siteUrl = elgg_get_site_url();
$site = elgg_get_site_entity();
$site_name = $site->name;
?>

<!-- start: Javascript -->
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/jquery.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/jquery.ui.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/moment.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/flot/jquery.flot.navigate.min.js"></script>
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/flot/jquery.flot.stack.min.js"></script>

<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/js/main.js"></script>
