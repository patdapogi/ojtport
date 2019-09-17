<?php
    // Initialize database configuration.
    $db_server   = 'localhost:3306';
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'lpu_ojt_portal';
    
    // Initialize table names.
    $tbl_portal_advisers   = 'portal_advisers';
    $tbl_portal_companies  = 'portal_companies';
    $tbl_portal_students   = 'portal_students';
    $tbl_portal_users      = 'portal_users';
    $tbl_types_courses     = 'types_courses';
    $tbl_types_departments = 'types_departments';
    $tbl_types_users       = 'types_users';
    $tbl_account_adviser   = 'account_adviser';
    
    // Initialize column names.
    $col_auth_user          = 'auth_user';
    $col_auth_pass          = 'auth_pass';
    $col_auth_sec_a1        = 'auth_sec_a1';
    $col_auth_sec_a2        = 'auth_sec_a2';
    $col_auth_sec_q1        = 'auth_sec_q1';
    $col_auth_sec_q2        = 'auth_sec_q2';
    $col_code_course        = 'code_course';
    $col_code_department    = 'code_department';
    $col_file_resume        = 'file_resume';
    $col_id                 = 'id';
    $col_id_adviser         = 'id_adviser';
    $col_id_course          = 'id_course';
    $col_id_department      = 'id_department';
    $col_id_student         = 'id_student';
    $col_id_user            = 'id_user';
    $col_id_user_type       = 'id_user_type';
    $col_location_address   = 'location_address';
    $col_location_latitude  = 'location_latitude';
    $col_location_longitude = 'location_longitude';
    $col_name_code          = 'name_code';
    $col_name_company       = 'name_company';
    $col_name_first         = 'name_first';
    $col_name_last          = 'name_last';
    $col_name_middle        = 'name_middle';
    $col_name_type          = 'name_type';
    $col_timestamp_create   = 'timestamp_create';
    $col_timestamp_login    = 'timestamp_login';
    $col_timestamp_update   = 'timestamp_update';
    
    // Initialize queries for creating tables.
    $query_create_tbl_portal_advisers = ""
            ."CREATE TABLE IF NOT EXISTS `{$tbl_portal_advisers}` ("
            ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
            ."{$col_id_user} INTEGER NOT NULL)";
            
    $query_create_tbl_portal_companies = ""
            ."CREATE TABLE IF NOT EXISTS `{$tbl_portal_companies}` ("
            ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
            ."{$col_id_user} INTEGER NOT NULL,"
            ."{$col_name_company} VARCHAR(127) NOT NULL,"
            ."{$col_location_address} VARCHAR(255) NOT NULL,"
            ."{$col_location_latitude} REAL NOT NULL,"
            ."{$col_location_longitude} REAL NOT NULL)";
            
    $query_create_tbl_portal_students = ""
            ."CREATE TABLE IF NOT EXISTS `{$tbl_portal_students}` ("
            ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
            ."{$col_id_user} INTEGER NOT NULL,"
            ."{$col_id_course} INTEGER NOT NULL,"
            ."{$col_id_adviser} INTEGER NOT NULL,"
            ."{$col_file_resume} BLOB)";
            
    $query_create_tbl_portal_users = ""
            ."CREATE TABLE IF NOT EXISTS `{$tbl_portal_users}` ("
            ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
            ."{$col_auth_user} VARCHAR(15) NOT NULL,"
            ."{$col_auth_pass} VARCHAR(255) NOT NULL,"
            ."{$col_id_user_type} INTEGER NOT NULL,"
            ."{$col_name_last} VARCHAR(31) NOT NULL,"
            ."{$col_name_first} VARCHAR(63) NOT NULL,"
            ."{$col_name_middle} VARCHAR(31) DEFAULT \"N\\A\","
            ."{$col_auth_sec_q1} VARCHAR(63) DEFAULT \"Answer to default question?\","
            ."{$col_auth_sec_a1} VARCHAR(1023) DEFAULT \"".password_hash('default', PASSWORD_BCRYPT)."\","
            ."{$col_auth_sec_q2} VARCHAR(63) DEFAULT \"Answer to default question?\","
            ."{$col_auth_sec_a2} VARCHAR(1023) DEFAULT \"".password_hash('default', PASSWORD_BCRYPT)."\","
            ."{$col_timestamp_login} TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
            ."{$col_timestamp_create} TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
            ."{$col_timestamp_update} TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
    
    $query_create_tbl_types_courses = ""
        ."CREATE TABLE IF NOT EXISTS `{$tbl_types_courses}` ("
        ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
        ."{$col_id_department} INTEGER NOT NULL,"
        ."{$col_name_type} VARCHAR(15) NOT NULL,"
        ."{$col_name_code} VARCHAR(8) NOT NULL)";
        
    $query_create_tbl_types_departments = ""
        ."CREATE TABLE IF NOT EXISTS `{$tbl_types_departments}` ("
        ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
        ."{$col_name_type} VARCHAR(15) NOT NULL,"
        ."{$col_name_code} VARCHAR(8) NOT NULL)";
    
    $query_create_tbl_types_users = ""
        ."CREATE TABLE IF NOT EXISTS `{$tbl_types_users}` ("
        ."{$col_id} INTEGER PRIMARY KEY AUTO_INCREMENT,"
        ."{$col_name_type} VARCHAR(15) NOT NULL)";
        
    // Initialize queries for inserting values.
    $query_insert_tbl_portal_advisers = ""
        ."INSERT INTO `{$tbl_portal_advisers}`"
        ." ({$col_id_user})"
        ." VALUES (?)";
        
    $query_insert_tbl_portal_companies = ""
        ."INSERT INTO `{$tbl_portal_companies}`"
        ." ({$col_id_user}, {$col_name_company}, {$col_location_address}, {$col_location_latitude}, {$col_location_longitude})"
        ." VALUES (?, ?, ?, ?, ?)";
        
    $query_insert_tbl_portal_students = ""
        ."INSERT INTO `{$tbl_portal_students}`"
        ." ({$col_id_user}, {$col_id_course}, {$col_id_adviser})"
        ." VALUES (?, ?, ?)";
        
    $query_insert_tbl_portal_users = ""
        ."INSERT INTO `{$tbl_portal_users}`"
        ." ({$col_auth_user}, {$col_auth_pass}, {$col_id_user_type}, {$col_name_last}, {$col_name_first})"
        ." VALUES (?, ?, ?, ?, ?)";
        
    $query_insert_tbl_types_courses = ""
        ."INSERT INTO `{$tbl_types_courses}`"
        ." ({$col_id_department}, {$col_name_type}, {$col_name_code})"
        ." VALUES (?, ?, ?)";
        
    $query_insert_tbl_types_departments = ""
        ."INSERT INTO `{$tbl_types_departments}`"
        ." ({$col_name_type}, {$col_name_code})"
        ." VALUES (?, ?)";
        
    $query_insert_tbl_types_users = ""
        ."INSERT INTO `{$tbl_types_users}`"
        ." ({$col_name_type})"
        ." VALUES (?)";
        
    // Initialize default values for tables.
    $default_rows_portal_advisers = array(2, 3, 4, 5, 6, 7, 8);
    
    $default_rows_portal_companies = array(
        array(12, 'Company A', 'LPU Manila', 14.591577, 120.977773),
        array(13, 'Company B', 'LPU Manila', 14.591577, 120.977773));
        
    $default_rows_portal_students = array(
        array(9,  12, 1),
        array(10, 12, 1),
        array(11, 12, 1));
    
    // $default_rows_portal_users = array(
    //     array('admin',       password_hash('admin', PASSWORD_BCRYPT),   4,  'Admin',    'Admin'),
    //     array('cjoel',       password_hash('adviser', PASSWORD_BCRYPT), 3,  'Castillo', 'Joel'),
    //     array('chuadennis',  password_hash('adviser', PASSWORD_BCRYPT), 3,  'Chua',     'Dennis'),
    //     array('tlyford',     password_hash('adviser', PASSWORD_BCRYPT), 3,  'Tago',     'Lyford'),
    //     array('dleilani',    password_hash('adviser', PASSWORD_BCRYPT), 3,  'Dinzo',    'Leilani'),
    //     array('ejelly',      password_hash('adviser', PASSWORD_BCRYPT), 3,  'Esguerra', 'Jelly'),
    //     array('bbisda',      password_hash('adviser', PASSWORD_BCRYPT), 3,  'Bisda',    'Bisda'),
    //     array('mmarianne',   password_hash('adviser', PASSWORD_BCRYPT), 3,  'Manalac',  'Marianne'),
    //     array('2013-T12503', password_hash('student', PASSWORD_BCRYPT), 1,  'Rabano',   'Patrick  Glen'),
    //     array('2013-T14135', password_hash('student', PASSWORD_BCRYPT), 1,  'Cruz',     'Jeraine'),
    //     array('2013-11933', password_hash('student', PASSWORD_BCRYPT), 1,  'Ritaga',   'Jezorrel Mc Kollins'),
    //     array('company_a',   password_hash('company', PASSWORD_BCRYPT), 2,  'OwnerL',   'Company'),
    //     array('company_b',   password_hash('company', PASSWORD_BCRYPT), 2,  'OwnerA',   'Company'));
    
    $default_rows_types_courses = array(
        array(1, 'AB Journalism',                       'JOURNALISM'),
        array(1, 'AB Legal Studies',                    'LEGALSTUDIES'),
        array(1, 'AB Mass Communication',               'MASSCOM'),
        array(1, 'AB Multimedia Arts',                  'MULTIMEDIA'),
        array(1, 'BS Psychology',                       'PSYCH'),
        array(2, 'BS Accountancy',                      'ACCOUNTANCY'),
        array(2, 'BS Business Administration',          'BUSINESSAD'),
        array(2, 'BS Customs Administration',           'CUSTOMSAD'),
        array(3, 'BS Hotel and Restaurant Management',  'HRM'),
        array(3, 'BS Tourism and Travel Management',    'TOURISM'),
        array(4, 'BS Computer Science',                 'CS'),
        array(4, 'BS Information Technology',           'IT'),
        array(4, 'BS Associate in Computer Technology', 'ACT'));
    
    $default_rows_types_departments = array(
        array('College of Arts and Sciences',                                'CAS'),
        array('College of Business Administration',                          'CBA'),
        array('College of International Tourism and Hospitality Management', 'CITHM'),
        array('College of Technology',                                       'COT'));
    
    $default_rows_types_users = array('Student', 'Company', 'Adviser', 'Administrator');
    
    // Initialize queries for web pages.
    $query_select_name_first = ""
        ."SELECT {$col_name_first}"
        ." FROM `{$tbl_portal_users}`"
        ." WHERE {$col_id}=?";
    $query_select_login = ""
        ."SELECT {$col_id}, {$col_auth_pass}"
        ." FROM `{$tbl_portal_users}`"
        ." WHERE {$col_auth_user}=? AND {$col_id_user_type}=?";

    $query_select_login_adviser = ""
        ."SELECT *"
        ." FROM `{$tbl_account_adviser}`"
        ." WHERE {$col_auth_user}=? AND {$col_auth_pass}=?";
        
//MySQLi Procedural
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
?>