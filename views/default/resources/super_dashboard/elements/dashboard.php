<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = elgg_get_logged_in_user_entity();
$siteUrl = elgg_get_site_url();
$site = elgg_get_site_entity();
$siteName = $site->name;
$dbprefix = elgg_get_config('dbprefix');

if($user->role_type != 'teacher'){
$userGroups = elgg_get_entities_from_relationship(array(
	'type' => 'group',
	'relationship' => 'member',
	'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	'order_by' => 'ge.name ASC',
	'no_results' => elgg_echo('groups:none'),
));
}

if($user->role_type == 'teacher'){
$userGroups = elgg_get_entities_from_relationship(array(
	'type' => 'group',
	//'relationship' => 'owner',
    'owner_guid' => $user->guid,
	//'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	'order_by' => 'ge.name ASC',
	'no_results' => elgg_echo('groups:none'),
));
}

 
//var_dump($userGroups);
$courseRequests = [];
  foreach ($userGroups as $group) {

   $group_guids[] = $group->guid;
    
   
  }
   $guids_in = implode(',', array_unique(array_filter($group_guids)));

$activity = elgg_list_river([
	'limit' => 8,
	'pagination' => false,
	'joins' => ["JOIN {$dbprefix}entities e1 ON e1.guid = rv.object_guid"],
	'wheres' => ["(e1.container_guid IN ({$guids_in}))"],
]);
//var_dump($activity);
        
        
        $invitations = groups_get_invited_groups($user->guid, false, array(
		'limit' => $limit,
		'offset' => $offset
			));
        
        
echo elgg_view('resources/tutor-lms-elements/dashboard_css');
               
?>

    
  <div class="col-md-12" style="padding:20px; margin-top: 64px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0">
                            <div class="col-md-12 padding-0">
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                            <h4 class="text-left">
                                                <?php echo elgg_echo('tutor-dashboard:messages'); ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body-dashboard text-center">
                                          <a class="dash-link" href="<?php echo elgg_get_site_url(); ?>messages/inbox/<?php  echo $user->username; ?>">
                                        <span class="super-dashboard-elgg-icon fa fa-inbox"></span>
                                        <p>
                                            <?php echo elgg_echo('tutor-dashboard:title:messages'); ?>
                                        </p>
                                        </a>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left"><?php echo elgg_echo('tutor-dashboard:settings'); ?></h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body-dashboard text-center">
                                          <a class="dash-link" href="<?php echo elgg_get_site_url(); ?>settings/user/<?php echo $user->username; ?>">
                                        <span class="super-dashboard-elgg-icon fa fa-cogs"></span>
                                        <p>
                                            <?php echo elgg_echo('tutor-dashboard:title:settings'); ?>
                                        </p>
                                        </a>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel box-v4">
                                    <div class="panel-heading bg-white border-none">
                                      <h4>
                                          <span class="icon-notebook icons"></span> 
                                          <?php 
                                            echo elgg_echo('dashboard:courses:activities')
                                          ?>
                                      </h4>
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                            <h2> <span class="icon-check icons"></span> 
                                            <?php 
                                                echo elgg_echo('dashboard:check:missing');
                                            ?>
                                            </h2>
                                            <p>
                                                <?php
                                                echo $activity
                                                        ?>
                                            </p>
                                            
                                        </div>
                                         
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v2">
                                  <div class="panel-heading padding-0">
                                      <img src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/img/bg2.jpg" class="box-v2-cover img-responsive"/>
                                    <div class="box-v2-detail">
                                      <img src="<?php echo $user->getIconURL('master');?>" class="img-responsive"/>
                                      <h4><?php echo $user->name;?></h4>
                                    </div>
                                  </div>
                                  <!--<div class="panel-body">
                                    <div class="col-md-12 padding-0 text-center">
                                      <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                          <h3>2.000</h3>
                                          <p>Post</p>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                          <h3>2.232</h3>
                                          <p>share</p>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                          <h3>4.320</h3>
                                          <p>photos</p>
                                      </div>
                                    </div>
                                  </div>!-->
                              </div>
                            </div>
<div class="col-md-12 padding-0 ">
    
                               <?php 
                               if($invitations != null)
                               {
                               ?>
                              <div class="panel bg-light-blue">
                                <div class="panel-body text-white bg-light-blue">

                                   <p class="animated fadeInUp">
                                   <?php echo elgg_echo('dashboard:invitations:received')?>
                                   </p>
                                    <div class="col-md-12 padding-0">
                                        
                                                                      <?php
                                  $vars['items'] = $invitations;
                                $vars['item_view'] = 'group/format/invitationrequest';
                                $vars['no_results'] = elgg_echo('groups:invitations:none');

                                echo elgg_view('page/components/list', $vars);

                                ?>
                                    </div>
                                </div>
                              </div>
                               <?php 
                               }
                               ?>
    
    <?php
    
    if($user->role_type == 'teacher'){
        
        
        $requests = elgg_get_entities_from_relationship(array(
	'type' => 'user',
	'relationship' => 'membership_request',
	'relationship_guid' => $group->guid,
	'inverse_relationship' => true,
	'limit' => 0,
        ));
        
        if($requests != null)
        {
                foreach ($userGroups as $group) {

                        $group_guids[] = $group->guid;

                        $requests = elgg_get_entities_from_relationship(array(
                             'type' => 'user',
                             'relationship' => 'membership_request',
                             'relationship_guid' => $group->guid,
                             'inverse_relationship' => true,
                             'limit' => 0,
                        ));
               ?>
    <div class="panel bg-light-blue">
                                <div class="panel-body text-white bg-light-blue">

                                   <p class="animated fadeInUp">
                                   <?php echo elgg_echo('dashboard:invitations:received')?>
                                   </p>
                                    <div class="col-md-12 padding-0">
                                        
                                <?php
                                    echo elgg_view('groups/membershiprequests', array(
                                    'requests' => $requests,
                                    'entity' => $group,));


                                    

                                ?>
                                    </div>
                                </div>
                              </div>
    <?php
            }
        }
    }
    ?>
    
    
                            </div>
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none">
                                  <h4>
                                      <?php 
                                  
                                            $user->role_type == 'teacher'? $label= elgg_echo('tutor:dashboard:teacher_groups'): $label = elgg_echo('tutor:dashboard:groups'); 
                                          
                                            echo $label;
                                     ?>
                                  </h4>
                                </div>
                                  
                                 <?php
                                   foreach ($userGroups as $v) {
                                       $group = get_entity($v->guid);
                                       
                                   
                                   ?>   
                                <div class="panel-body">
                                  
                                  <div class="media">
                                    <div class="media-left">
                                        <span class="icon-layers icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                     <a href="<?php echo $group->getURL();?>">   <h5 class="media-heading"><?php echo $v->name;?></h5></a>
                                        <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div>
                                      <h6 class="media-heading"><?php echo $v->briefdescription;?></h6>
                                    </div>
                                  </div>
                                   

                                </div>
                                  </br>
                                   <?php
                                   }
                                    ?>
                                  
                                <div class="panel-footer bg-white border-none">
                                    
                                </div>
                                  
                              </div>
                            
                            </div>

                             
                        </div>
                    </div>

                   
                </div>

 
     