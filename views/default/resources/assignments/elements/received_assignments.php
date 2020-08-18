<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$submissions = elgg_get_entities(array(
                            'type' => 'object',
                            'subtype' => 'assignment_submitted',
                            'container_guid' => $vars['entity']->guid,
                           // 'owner_guid' => $logged_guid,
                            'preload_owners' => true,
                            'preload_containers' => true,
                            'distinct' => false,
                         ));
        
                // var_dump($comments1);
                 
                /* foreach ($submissions as $hw) {
                     $user = get_entity($hw->owner_guid);
    echo $user->name;
    echo $user->email;
    $file = get_entity($hw->guid);
    $download_url = elgg_get_download_url($file);
    $link = elgg_view('output/url', array(
	'encode_text' => true,
	'href' => $download_url, 
	'text' => $file->title, 
));
    echo $link;
    echo '</br>';
}*/
echo elgg_view('assignments/css');
?>
</br>
<h1 class="elgg-listing-summary-title-company">
<?php 
echo elgg_echo('assignments:submissions');

?>
</h1>
</br>

<table id="datatable-responsive" 
       class="table table-striped table-bordered dt-responsive nowrap" 
       cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>
                #
            </th>
            
            <th>
                <?php echo elgg_echo('assignments:student:name');?>
            </th>
            
            <th>
                <?php echo elgg_echo('assignments:student:email');?>
            </th>
            
            <th>
                <?php echo elgg_echo('assignments:student:homework');?>
            </th>
            
             
        </tr>
    </thead>
    <tbody>
        <?php 
        $i=0;
            foreach ($submissions as $value) {
    $i = $i +1;
    $user = get_entity($value->owner_guid);
    $file = get_entity($value->guid);
        ?>
        <tr>
            <td>
                <?php echo $i; ?>
            </td>
            
            <td>
                <?php 
                
                echo $user->name;
                
                ?>
            </td>
            
            <td>
                <?php echo $user->email; ?>
            </td>
            
            <td>
                <?php
                    

                    $download_url = elgg_get_download_url($file);

                             $link = elgg_view('output/url', array(
                    'encode_text' => true,
                    'href' => $download_url, 
                    'text' => $file->title, 
                    ));

                                // echo $link;

                    ?>
                
                         
                        
                    <a href="<?php echo $download_url;?>" style="color: white; text-decoration: none;" class="assignment-download-item">    <span class="fa elgg-icon-download fa-download"></span>        

                        <?php  echo elgg_echo('assignment:view_file');?>
                    </a>
                        
                    
                    <?php

                                
                                ?>
            </td>
            
        </tr>
            <?php 
            }
            ?>
    </tbody>
</table>
