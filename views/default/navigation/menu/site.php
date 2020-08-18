<?php
/**
 * Site navigation menu
 *
 * @uses $vars['menu']['default']
 * @uses $vars['menu']['more']
 */

$default_items = elgg_extract('default', $vars['menu'], array());
$more_items = elgg_extract('more', $vars['menu'], array());

//echo '<ul class="elgg-menu elgg-menu-site elgg-menu-site-default clearfix">';
foreach ($default_items as $menu_item) {
	//echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
    
    if ($menu_item->getSelected() != null)
    {
        $item_class = "active ";  
    }
 else
 {
     $item_class = '';
 }
 
 
 
        switch($menu_item->getName())
    {
        case "file":
            $link_icon = "fa-file-pdf-o fa";
            break;
        
        case "activity":
            $link_icon = "fa-flash fa";
            break;
        case "groups":
            $link_icon = "fa-group fa";
            break;
        
        case "members":
            $link_icon = "fa-id-card fa";
            break;
        
        case "thewire":
            $link_icon = "fa-paper-plane-o fa";
            break;
        
        case "blog":
            $link_icon = "fa-edit fa";
            break;
        
         case "posts":
            $link_icon = "fa-edit fa";
            break;
        
        case "super_dashboard":
            $link_icon = "fa-home fa";
            break;
        
        default: $link_icon = 'fa-dot-circle-o fa';
    }
    
?>


<li class="<?php echo $item_class; ?>ripple">
    
    <a class="nav-header" href="<?php echo $menu_item->getHref();  ?>/">
    
        <span class="<?php echo $link_icon; ?>"></span> <?php echo $menu_item->getText();  ?>
    
    </a>

</li>

<?php
}

if ($more_items) {
	echo '<li class="elgg-more">';

	$more = elgg_echo('more');
	echo "<a href=\"#\">$more</a>";
	
	echo elgg_view('navigation/menu/elements/section', array(
		'class' => 'elgg-menu elgg-menu-site elgg-menu-site-more', 
		'items' => $more_items,
	));
	
	echo '</li>';
}
//echo '</ul>';
