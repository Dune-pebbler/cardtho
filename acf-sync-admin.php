<?php
/**
 * ACF Sync Admin Page
 * 
 * Add this to functions.php temporarily to create an admin page for syncing ACF fields.
 * 
 * To use:
 * 1. Add this code to functions.php
 * 2. Go to WordPress Admin > Tools > ACF Sync
 * 3. Click "Sync ACF Fields" button
 * 4. Remove the code from functions.php when done
 */

// Add admin menu item
add_action('admin_menu', function() {
    add_submenu_page(
        'tools.php',
        'ACF Field Sync',
        'ACF Sync',
        'manage_options',
        'acf-field-sync',
        'acf_field_sync_page'
    );
});

// Admin page content
function acf_field_sync_page() {
    // Handle form submission
    if (isset($_POST['sync_acf_fields']) && wp_verify_nonce($_POST['_wpnonce'], 'sync_acf_fields')) {
        $result = sync_acf_fields_from_json();
        echo '<div class="notice notice-' . ($result['success'] ? 'success' : 'error') . '"><p>' . $result['message'] . '</p></div>';
    }
    
    ?>
    <div class="wrap">
        <h1>ACF Field Sync</h1>
        <p>This tool syncs ACF field groups from JSON files to the WordPress database.</p>
        
        <?php
        // Check what needs syncing
        $sync_groups = get_acf_groups_needing_sync();
        
        if (empty($sync_groups)) {
            echo '<div class="notice notice-success"><p>✅ All ACF fields are up to date! No syncing needed.</p></div>';
        } else {
            echo '<div class="notice notice-warning"><p>Found ' . count($sync_groups) . ' field group(s) that need syncing:</p>';
            echo '<ul>';
            foreach ($sync_groups as $group) {
                echo '<li><strong>' . esc_html($group['title']) . '</strong> (' . esc_html($group['key']) . ')</li>';
            }
            echo '</ul></div>';
        }
        ?>
        
        <form method="post" action="">
            <?php wp_nonce_field('sync_acf_fields'); ?>
            <p>
                <input type="submit" name="sync_acf_fields" class="button button-primary" value="Sync ACF Fields" <?php echo empty($sync_groups) ? 'disabled' : ''; ?>>
            </p>
        </form>
        
        <h3>Instructions</h3>
        <ol>
            <li>Make changes to ACF JSON files directly</li>
            <li>Visit this page to see what needs syncing</li>
            <li>Click "Sync ACF Fields" to update the database</li>
            <li>Changes will now appear in WordPress admin interface</li>
        </ol>
    </div>
    <?php
}

// Get field groups that need syncing
function get_acf_groups_needing_sync() {
    if (!function_exists('acf_get_field_groups')) {
        return array();
    }
    
    $sync_groups = array();
    $field_groups = acf_get_field_groups();
    
    foreach ($field_groups as $field_group) {
        $local_field_group = acf_maybe_get_field_group($field_group['key'], true);
        $db_field_group = acf_maybe_get_field_group($field_group['key']);
        
        // Check if local (JSON) version is different from DB version
        if ($local_field_group && $db_field_group) {
            if ($local_field_group['modified'] > $db_field_group['modified']) {
                $sync_groups[] = $field_group;
            }
        } elseif ($local_field_group && !$db_field_group) {
            $sync_groups[] = $field_group;
        }
    }
    
    return $sync_groups;
}

// Perform the sync
function sync_acf_fields_from_json() {
    if (!function_exists('acf_get_field_groups')) {
        return array('success' => false, 'message' => 'ACF plugin is not active.');
    }
    
    $sync_groups = get_acf_groups_needing_sync();
    
    if (empty($sync_groups)) {
        return array('success' => true, 'message' => 'No field groups need syncing.');
    }
    
    $synced_count = 0;
    $errors = array();
    
    foreach ($sync_groups as $field_group) {
        $local_field_group = acf_get_local_field_group($field_group['key']);
        
        if ($local_field_group) {
            $result = acf_import_field_group($local_field_group);
            
            if ($result) {
                $synced_count++;
            } else {
                $errors[] = $field_group['title'];
            }
        } else {
            $errors[] = $field_group['title'] . ' (could not load)';
        }
    }
    
    if (empty($errors)) {
        return array(
            'success' => true, 
            'message' => "✅ Successfully synced {$synced_count} field group(s). Changes are now available in WordPress admin."
        );
    } else {
        return array(
            'success' => false, 
            'message' => "❌ Synced {$synced_count} field group(s), but {count($errors)} failed: " . implode(', ', $errors)
        );
    }
}
