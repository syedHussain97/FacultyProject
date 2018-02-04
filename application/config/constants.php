<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* APP CONSTANTS */

define('DEFAULT_SITE_TITLE', 'STEVTA - Home');

define('JS_FOLDER', 'scripts/');
define('STYLES_FOLDER', 'styles/');

define('RESULTS_PER_PAGE', 20);

/* db - test */

define('APP_DATABASE_HOSTNAME', 'localhost');
define('APP_DATABASE_USER', 'root');
define('APP_DATABASE_PASS', '');
define('APP_DATABASE_NAME', 'faculty');

define('APP_TABLE_CATEGORIES','se_categories');
define('APP_TABLE_CATEGORY_ROLES','se_category_roles');
define('APP_TABLE_COURSE','se_course');
define('APP_TABLE_COURSE_OFFERED','se_course_offered_in');
define('APP_TABLE_COURSE_LECTURE','se_course_lecture');
define('APP_TABLE_COURSE_MARKS','se_course_marks');
define('APP_TABLE_FACULTY','se_faculty');
define('APP_TABLE_FACULTY_ROLES','se_faculty_roles');
define('APP_TABLE_FACULTY_CATEGORY','se_faculty_categories');
define('APP_TABLE_INSTITUTE','se_institute');
define('APP_TABLE_LECUTRE_ATTENDENCE','se_lecture_attendence');
define('APP_TABLE_STUDENT','se_student');
define('APP_TABLE_STUDENT_COURSE','se_student_course ');

/* End of file constants.php */
/* Location: ./application/config/constants.php */