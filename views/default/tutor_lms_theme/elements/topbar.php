<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$user = elgg_get_logged_in_user_entity();
$siteUrl = elgg_get_site_url();
?>

<nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="<?php echo $siteUrl;?>" class="navbar-brand"> 
                 <b><?php echo elgg_echo('tutor-lms:main:title');?></b>
                </a>

              <ul class="nav navbar-nav search-nav">
                <li>
                   <div class="search">
                    <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                    <div class="form-group form-animate-text">
                      <input type="text" class="form-text" required>
                      <span class="bar"></span>
                      <label class="label-search">Type anywhere to <b>Search</b> </label>
                    </div>
                  </div>
                </li>
              </ul>
<?php 
if (elgg_is_logged_in())
{
    ?>

    
              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?php echo $user->name;?></span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="<?php echo $user->getIconURL('small');?>" 
                        class="img-circle avatar" alt="user name" 
                        data-toggle="dropdown" aria-haspopup="true" 
                        aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li>
                         <a href="<?php echo $siteUrl ?>profile/<?php echo $user->username;?>/">
                             <span class="fa fa-user"></span> My Profile</a>
                     </li>
                     <li>
                         <a href="<?php echo $siteUrl ?>profile/<?php echo $user->username;?>/edit/">
                             <span class="fa fa-edit"></span> Edit Profile
                         </a>
                     </li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                         
                      <ul>
                        <li>
                            <a href="<?php echo $siteUrl ?>settings/user/<?php echo $user->username;?>/"><span class="fa fa-cogs"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo $siteUrl ?>settings/statistics/<?php echo $user->username;?>/"><span class="fa fa-bar-chart"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo $siteUrl ?>action/logout/"><span class="fa fa-power-off "></span></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li ><a href="<?php echo $siteUrl ?>action/logout/" style="font-size: 25px;"><span class="fa fa-sign-out"></span></a></li>
              </ul>
<?php
}
?>
            </div>
          </div>
        </nav>