# ACF Field Sync Scripts

This directory contains scripts to sync ACF (Advanced Custom Fields) field definitions from JSON files to the WordPress database.

## When to Use

Use these scripts after making direct changes to ACF JSON files (like `acf/group_*.json`) to sync those changes to the WordPress admin interface.

## Usage Options

### Option 1: WordPress Admin Interface (Easiest)

1. **Add the admin code**: Copy the contents of `acf-sync-admin.php` and paste it at the bottom of your `functions.php` file
2. **Access the sync page**: Go to WordPress Admin → **Tools → ACF Sync**
3. **Review changes**: See which field groups need syncing
4. **Click "Sync ACF Fields"**: Button will sync all changes
5. **Remove the code**: Delete the added code from `functions.php` when done

This method works within your Local environment and doesn't require terminal access.

### Option 2: PHP Script (Advanced)

```bash
# From theme directory
php sync-acf-fields.php

# From project root
php wp-content/themes/skelet-theme/sync-acf-fields.php

# From anywhere in the project
php /Users/ruben/Local\ Sites/cardtho/app/public/wp-content/themes/skelet-theme/sync-acf-fields.php
```

### Option 3: Shell Script Wrapper

```bash
# From theme directory
./sync-acf.sh

# From anywhere in the project
/Users/ruben/Local\ Sites/cardtho/app/public/wp-content/themes/skelet-theme/sync-acf.sh
```

## What the Script Does

1. **Checks for Changes**: Compares JSON files with database versions
2. **Lists Differences**: Shows which field groups need syncing
3. **Syncs Fields**: Imports JSON definitions to WordPress database
4. **Reports Results**: Shows success/failure status for each field group

## Example Output

```
ACF Field Sync Script
=====================

Found changes in: Productinformatie (group_6878c9d7d5788)

Found 1 field group(s) that need syncing.
Proceeding with sync...

✅ Synced: Productinformatie

==================================================
SYNC COMPLETE
==================================================
✅ Successfully synced: 1 field group(s)
🎉 All field groups synced successfully!

Your ACF changes are now available in the WordPress admin interface.
```

## After Running

- Check WordPress admin → Custom Fields to verify changes
- New fields should appear in product edit screens
- Field functionality should work in both frontend and admin

## Troubleshooting

- **"wp-config.php not found"**: Run from correct directory
- **"ACF not active"**: Enable Advanced Custom Fields plugin
- **"No changes found"**: JSON files are already synced
- **Permission errors**: Check file permissions

## Security Note

These scripts can only be run from command line (not via web browser) for security.
