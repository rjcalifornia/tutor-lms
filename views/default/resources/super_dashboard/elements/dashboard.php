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
	'relationship' => 'owner',
	'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	'order_by' => 'ge.name ASC',
	'no_results' => elgg_echo('groups:none'),
));
}

 

  foreach ($userGroups as $group) {

   $group_guids[] = $group->guid;
  }
   $guids_in = implode(',', array_unique(array_filter($group_guids)));

$activity = elgg_list_river([
	'limit' => 6,
	'pagination' => false,
	'joins' => ["JOIN {$dbprefix}entities e1 ON e1.guid = rv.object_guid"],
	'wheres' => ["(e1.container_guid IN ({$guids_in}))"],
]);
//var_dump($activity);
        
        
        $invitations = groups_get_invited_groups($user->guid, false, array(
		'limit' => $limit,
		'offset' => $offset
			));
               
?>

<style>
.panel-body
{background:#f0f3f4;    }

.box-v1 .panel-body-dashboard {
    padding-top: 40px;
}

.panel-body-dashboard {
    padding: 15px;
}

.text-left{
    color: #918C8C !important;
}

.super-dashboard-elgg-icon{

    
    
    font-size:66px;
    
}
.dash-link{
    color: #918C8C !important;
}

.bg-light-blue{
        background-color: #03A9F4 !important;
}
</style>

    
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
                                      <h4><span class="icon-notebook icons"></span> Agenda</h4>
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                            <h2>Checking Your Server!</h2>
                                            <p>
                                                <?php
                                                echo $activity
                                                        ?>
                                            </p>
                                            <b><span class="icon-clock icons"></span> Today at 15:00</b>
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
                                  
                                  
                                <div class="panel-body">
                                   <?php
                                   foreach ($userGroups as $v) {
                                       $group = get_entity($v->guid);
                                       
                                   
                                   ?> 
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
                                    <?php
                                   }
                                    ?>

                                </div>
                                  
                                  
                                <div class="panel-footer bg-white border-none">
                                    
                                </div>
                                  
                              </div>
                            
                            </div>

                             
                        </div>
                    </div>

                  <div class="col-md-12 card-wrap padding-0">
                    <div class="col-md-6">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Line Chart</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-danger" style="margin-top:10px;">
                                  <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch1" checked>
                                  <label class="onoffswitch-label" for="myonoffswitch1"></label>
                                </div>
                            </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:50px;">
                              <div id="canvas-holder1">
                                    <canvas class="line-chart" style="margin-top:30px;height:200px;"></canvas>
                              </div>
                              <div class="col-md-12" style="padding-top:20px;">
                                  <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                      <h2 style="line-height:.4;">$100.21</h2>
                                      <small>Total Laba</small>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-6 text-center">
                                      <h2 style="line-height:.4;">2000</h2>
                                      <small>Total Barang</small>
                                  </div>
                                  <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                      <h2 style="line-height:.4;">$291.1</h2>
                                      <small>Total Pengeluaran</small>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Orders</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                  <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
                                  <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:50px;">
                              <div id="canvas-holder1">
                                <canvas class="bar-chart"></canvas>
                              </div>
                              <div class="col-md-12 padding-0" >
                                <div class="col-md-4 col-sm-4 hidden-xs" style="padding-top:20px;">
                                  <canvas class="doughnut-chart2"></canvas>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <h4>Progress Produksi barang</h4>
                                    <p>Sed hendrerit. Curabitur blandit mollis lacus. Duis leo. Sed libero.fusce commodo aliquam arcu..</p>
                                    <div class="progress progress-mini">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel bg-green text-white">
                            <div class="panel-body">
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="maps" style="height:300px;">
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                  <canvas class="doughnut-chart hidden-xs"></canvas>
                                  <div class="col-md-12">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                      <h1>72.993</h1>
                                      <p>People</p>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                       <h1>12.000</h1>
                                       <p>Active</p>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

 
     