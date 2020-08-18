<?php
/**
 * Tutor LMS theme plugin
 *
 * @package TutorLMSTheme
 */

elgg_register_event_handler('init', 'system', 'tutor_lms_theme_init');

function tutor_lms_theme_init()
{

    elgg_register_event_handler('pagesetup', 'system', 'tutor_lms_theme_pagesetup', 1000);

    // theme specific CSS
    elgg_extend_view('elgg.css', 'tutor_lms_theme/css');

    elgg_unextend_view('page/elements/header', 'search/header');
    elgg_extend_view('page/elements/sidebar', 'search/header', 0);

    elgg_register_plugin_hook_handler('head', 'page', 'tutor_lms_theme_setup_head');

    // non-members do not get visible links to RSS feeds
    if (!elgg_is_logged_in())
    {
        elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
    }
    elgg_register_page_handler('super_dashboard', 'super_dashboard_page_handler');
    $item = new ElggMenuItem('super_dashboard', elgg_echo('super_dashboard:title'), 'super_dashboard');
    elgg_register_menu_item('site', $item);

    elgg_register_library('elgg:assignments', __DIR__ . '/lib/assignments.php');
    // register the save action
    elgg_register_action("assignments/save", __DIR__ . "/actions/assignments/save.php");
    elgg_register_action("assignments/submit_assignment", __DIR__ . "/actions/assignments/submit_assignment.php");

    // register the page handler
    elgg_register_page_handler('assignments', 'assignments_page_handler');

    // register a hook handler to override urls
    elgg_register_plugin_hook_handler('entity:url', 'object', 'assignments_set_url');

    // Register for search.
    elgg_register_entity_type('object', 'assignments');

    // Add group option
    add_group_tool_option('assignments', elgg_echo('assignments:enableassignments') , true);
    elgg_extend_view('groups/tool_latest', 'assignments/group_module');

    // add a blog widget
    elgg_register_widget_type('assignments', elgg_echo('assignments') , elgg_echo('assignments:widget:description'));

    elgg_register_plugin_hook_handler('view', 'river/object/comment/create', 'disable_river_actions');

    if (elgg_is_admin_logged_in())
    {
        elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'tutor_lms__user_hover_menu');
    }

    elgg_register_action("roles/add", __DIR__ . "/actions/roles/add.php");
    elgg_register_action("roles/remove", __DIR__ . "/actions/roles/remove.php");
}

/**
 * Rearrange menu items
 */
function tutor_lms_theme_pagesetup()
{

    if (elgg_is_logged_in())
    {

        elgg_register_menu_item('topbar', array(
            'name' => 'account',
            'text' => elgg_echo('account') ,
            'href' => "#",
            'priority' => 100,
            'section' => 'alt',
            'link_class' => 'elgg-topbar-dropdown',
        ));

        if (elgg_is_active_plugin('dashboard'))
        {
            $item = elgg_unregister_menu_item('topbar', 'dashboard');
            if ($item)
            {
                $item->setText(elgg_echo('dashboard'));
                $item->setSection('default');
                elgg_register_menu_item('site', $item);
            }
        }

        $item = elgg_get_menu_item('topbar', 'usersettings');
        if ($item)
        {
            $item->setParentName('account');
            $item->setText(elgg_echo('settings'));
            $item->setPriority(103);
        }

        $item = elgg_get_menu_item('topbar', 'logout');
        if ($item)
        {
            $item->setParentName('account');
            $item->setText(elgg_echo('logout'));
            $item->setPriority(104);
        }

        $item = elgg_get_menu_item('topbar', 'administration');
        if ($item)
        {
            $item->setParentName('account');
            $item->setText(elgg_echo('admin'));
            $item->setPriority(101);
        }

        if (elgg_is_active_plugin('site_notifications'))
        {
            $item = elgg_get_menu_item('topbar', 'site_notifications');
            if ($item)
            {
                $item->setParentName('account');
                $item->setText(elgg_echo('site_notifications:topbar'));
                $item->setPriority(102);
            }
        }

        if (elgg_is_active_plugin('reportedcontent'))
        {
            $item = elgg_unregister_menu_item('footer', 'report_this');
            if ($item)
            {
                $item->setText(elgg_view_icon('report-this'));
                $item->setPriority(500);
                $item->setSection('default');
                elgg_register_menu_item('extras', $item);
            }
        }
    }
}

/**
 * Register items for the html head
 *
 * @param string $hook Hook name ('head')
 * @param string $type Hook type ('page')
 * @param array  $data Array of items for head
 * @return array
 */
function tutor_lms_theme_setup_head($hook, $type, $data)
{
    $data['metas']['viewport'] = array(
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0',
    );

    $data['links']['apple-touch-icon'] = array(
        'rel' => 'apple-touch-icon',
        'href' => elgg_get_simplecache_url('tutor_lms_theme/homescreen.png') ,
    );

    return $data;
}

function disable_river_actions($hook, $type, $return, $params)
{
    return false;
}
/**
 * Dispatches blog pages.
 * URLs take the form of
 *  All blogs:       blog/all
 *  User's blogs:    blog/owner/<username>
 *  Friends' blog:   blog/friends/<username>
 *  User's archives: blog/archives/<username>/<time_start>/<time_stop>
 *  Blog post:       blog/view/<guid>/<title>
 *  New post:        blog/add/<guid>
 *  Edit post:       blog/edit/<guid>/<revision>
 *  Preview post:    blog/preview/<guid>
 *  Group blog:      blog/group/<guid>/all
 *
 * Title is ignored
 *
 * @todo no archives for all blogs or friends
 *
 * @param array $page
 * @return bool
 */
function assignments_page_handler($page)
{

    elgg_load_library('elgg:assignments');

    // push all blogs breadcrumb
    elgg_push_breadcrumb(elgg_echo('assignments:assignment') , 'assignments/all');

    $page_type = elgg_extract(0, $page, 'all');
    $resource_vars = ['page_type' => $page_type, ];

    switch ($page_type)
    {
        case 'owner':
            $resource_vars['username'] = elgg_extract(1, $page);

            echo elgg_view_resource('assignments/owner', $resource_vars);
        break;
        case 'friends':
            $resource_vars['username'] = elgg_extract(1, $page);

            echo elgg_view_resource('assignments/friends', $resource_vars);
        break;
        case 'archive':
            $resource_vars['username'] = elgg_extract(1, $page);
            $resource_vars['lower'] = elgg_extract(2, $page);
            $resource_vars['upper'] = elgg_extract(3, $page);

            echo elgg_view_resource('assignments/archive', $resource_vars);
        break;
        case 'view':
            $resource_vars['guid'] = elgg_extract(1, $page);

            echo elgg_view_resource('assignments/view', $resource_vars);
        break;
        case 'add':
            $resource_vars['guid'] = elgg_extract(1, $page);

            echo elgg_view_resource('assignments/add', $resource_vars);
        break;
        case 'edit':
            $resource_vars['guid'] = elgg_extract(1, $page);
            $resource_vars['revision'] = elgg_extract(2, $page);

            echo elgg_view_resource('assignments/edit', $resource_vars);
        break;
        case 'group':
            $resource_vars['group_guid'] = elgg_extract(1, $page);
            $resource_vars['subpage'] = elgg_extract(2, $page);
            $resource_vars['lower'] = elgg_extract(3, $page);
            $resource_vars['upper'] = elgg_extract(4, $page);

            echo elgg_view_resource('assignments/group', $resource_vars);
        break;
        case 'all':
            echo elgg_view_resource('assignments/all', $resource_vars);
        break;
        default:
            return false;
    }

    return true;
}

function assignments_set_url($hook, $type, $url, $params)
{
    $entity = $params['entity'];
    if (elgg_instanceof($entity, 'object', 'assignments'))
    {
        $friendly_title = elgg_get_friendly_title($entity->title);
        return "assignments/view/{$entity->guid}/$friendly_title";
    }
}

function tutor_lms__user_hover_menu($hook, $type, $return, $params)
{
    $user = $params['entity'];
    /* @var \ElggUser $user */

    if (elgg_is_logged_in())
    {
        if (elgg_get_logged_in_user_guid() != $user->guid)
        {
            //$isTeacher = $user->isFriend();
            if ($user->role_type != null)
            {
                $isTeacher = true;
            }
            else
            {
                $isTeacher = false;
            }

            // Always emit both to make it super easy to toggle with ajax
            $return[] = \ElggMenuItem::factory(array(
                'name' => 'remove_teacher',
                'href' => elgg_add_action_tokens_to_url("action/roles/remove?user={$user->guid}") ,
                'text' => elgg_echo('tutor-lms:remove:teacher') ,
                'section' => 'action',
                'item_class' => $isTeacher ? '' : 'hidden',
            ));

            $return[] = \ElggMenuItem::factory(array(
                'name' => 'add_teacher',
                'href' => elgg_add_action_tokens_to_url("action/roles/add?user={$user->guid}") ,
                'text' => elgg_echo('tutor-lms:add:teacher') ,
                'section' => 'action',
                'item_class' => $isTeacher ? 'hidden' : '',
            ));
        }
    }

    return $return;
}

function super_dashboard_page_handler() {
	echo elgg_view_resource('super_dashboard/layout');
	return true;
}

