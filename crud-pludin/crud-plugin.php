    <?php
      /*
      Plugin Name: Crud opration
      Description: Plugin to demonstrate Select, insert, Edit, Delete, Update Operation
      Version: 1.0
      Author: Praveen
      */

      // function to create the DB / Options / Defaults         
      function options_install() {

          global $wpdb;

          $table_name = $wpdb->prefix . "Usertable";
          $charset_collate = $wpdb->get_charset_collate();
          $sql = "CREATE TABLE $table_name (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
                  `email` varchar(60) CHARACTER SET utf8 NOT NULL,
                  `phone` varchar(12) CHARACTER SET utf8 NOT NULL,
                  PRIMARY KEY (`id`)
                ) $charset_collate; ";

          require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
          dbDelta($sql);\
      }

      // run the install scripts upon plugin activation
      register_activation_hook(__FILE__, 'options_install');


      //menu items
      add_action('admin_menu','User_modifymenu');
      function User_modifymenu() {
        
        //this is the main item for the menu
        add_menu_page('User', //page title
        'User', //menu title
        'manage_options', //capabilities
        'User_list', //menu slug
        'User_list' //function
        );
        
        //this is a submenu
        add_submenu_page('User_list', //parent slug
        'Add New User', //page title
        'Add New', //menu title
        'manage_options', //capability
        'User_create', //menu slug
        'User_create'); //function
        
        //this submenu is HIDDEN, however, we need to add it anyways
        add_submenu_page(null, //parent slug
        'Update User', //page title
        'Update', //menu title
        'manage_options', //capability
        'User_update', //menu slug
        'User_update'); //function
      }
      define('ROOTDIR1', plugin_dir_path(__FILE__));

      require_once(ROOTDIR1 . 'User_list.php');
      require_once(ROOTDIR1 . 'User_create.php');
      require_once(ROOTDIR1 . 'User_update.php');

    ?>
