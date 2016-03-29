<?php

class RS_Upgrade
{
    // Database version. Increment after making changes to the database structure
    private static $db_version = 1;

    // Holds the current db version retrieved from the database
    private static $current_db_version = 0;

    /**
     * Displays notices and/or performs the db upgrade.
     */
    public static function init()
    {
        $rs_db_version = get_option('rs_db_version');
        if(!empty($rs_db_version)) { self::$current_db_version = $rs_db_version; }
        self::upgrade();
    }

    public static function upgrade()
    {
        if (! self::needs_db_upgrade()) { return; }

      self::upgrade_1();

      update_option('rs_db_version', self::$db_version);
    }

    /**
     * Compare db version to verify if upgrade is needed.
     */
    private static function needs_db_upgrade()
    {
        if (self::$db_version > self::$current_db_version) {
            return true;
        }

        return false;
    }

    /**
     * We use this to create default pages for existing customers and then set them as the page containers for our program and teacher pages.
     */
    private static function upgrade_1()
    {
        if (self::$current_db_version >= 1) {
            return;
        }

        // Only run this upgrade for existing installs
        $options = get_option('rs_settings');
        if(empty($options) || empty($options['style'])) { return; }

        // Create a program page based on their style choice ('events', 'programs', 'workshops')
        $retreat_style = $options['style'];
        $new_programs_page = array(
            'post_type' => 'page',
            'post_title' => ucfirst($retreat_style.'s'), // Ugly: we're matching the existing title
            'post_name' => $retreat_style.'s',
            'post_status'   => 'publish'
        );
        $programs_page = wp_insert_post( $new_programs_page );

        // Set this as the program page
        $options['page']['programs'] = $programs_page;

        // Create a teacher page
        $new_teachers_page = array(
            'post_type' => 'page',
            'post_title' => 'Teachers',
            'post_name' => 'teachers',
            'post_status'   => 'publish'
        );
        $teachers_page = wp_insert_post( $new_teachers_page );

        // Set this as the teacher page
        $options['page']['teachers'] = $teachers_page;

        update_option('rs_settings', $options);
    }

    /**
     * Upgrade Template - Instructions:
     * 00 = next number to use
     * add upgrade_00() line to db_upgrade() at end
     * change private static $db_version to 00
     * make any db modificaitons in upgrade_tables() and dbDelta should manage the changes...
     */
    private static function upgrade_00()
    {
        if (self::$current_db_version >= 00) {
            return;
        } // ensures it only happens once

        // do stuff here
    }
}
