<?php
return array(
  'version' => 
  array(
    'app' => 
    array(
      'default' => 
      array(
        0 => '001_add_table_categories',
        1 => '002_add_table_posts',
        2 => '003_add_table_users',
        3 => '004_create_places',
        4 => '005_add_foreign_key_to_posts',
      ),
    ),
    'module' => 
    array(
    ),
    'package' => 
    array(
      'auth' => 
      array(
        0 => '001_auth_create_usertables',
        1 => '002_auth_create_grouptables',
        2 => '003_auth_create_roletables',
        3 => '004_auth_create_permissiontables',
        4 => '005_auth_create_authdefaults',
        5 => '006_auth_add_authactions',
        6 => '007_auth_add_permissionsfilter',
        7 => '008_auth_create_providers',
        8 => '009_auth_create_oauth2tables',
        9 => '010_auth_fix_jointables',
        10 => '011_auth_group_optional',
        11 => '012_auth_update_userindex',
      ),
    ),
  ),
  'folder' => 'migrations/',
  'table' => 'migration',
  'flush_cache' => false,
);
