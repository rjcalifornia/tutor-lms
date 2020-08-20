<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$siteUrl = elgg_get_site_url();
?>

  <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <li class="time">
                      <h1 class="animated fadeInLeft">21:00</h1>
                      <p class="animated fadeInRight">Sat,October 1st 2029</p>
                    </li>
                    <?php
                        echo elgg_view_menu('site');
                                 
                    ?> 
                    
                    
                    
                    
                    
                    
                     
                    <li class="ripple"> <a href="<?php echo $siteUrl ?>action/logout/"><span class="fa fa-sign-out"></span><?php echo elgg_echo('logout');?></a></li>
                  </ul>
                </div>
            </div>
