<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* Application specific constants */

//keys (session, third party API keys like google, stripe etc)  

/* Firebase API key for notifications */
define('NOTIFICATION_KEY','AAAARhoraBA:APA91bF60FScjvb-3LkAo5zyMMn24xfNRIPLA1Pc0rYI-ijRz0a1ITij6keKaz37SjVP1D5qq9Kl5FXwXaHj2fXs1qo9wkDEA4NjyXxApXFcQkqrQ7n1luy-HUElSOYTJZ8LU8w_1Vlz'); 

/* session keys */
define('USER_SESS_KEY', 'app_user_sess'); 
define('ADMIN_USER_SESS_KEY', 'app_admin_user_sess');

//DB tables
define('USER', 'users');
define('ADMIN', 'admin');
define('USER_POST', 'users_post');
define('LIKES', 'post_likes');
define('COMMENTS', 'comments');
define('VIEWS', 'post_views');
define('POST_SHARE', 'post_share');
//define('NOTIFICATIONS', 'notifications');

//uploads path
define('USER_AVATAR_PATH', 'uploads/user_avatar/'); //user avatar
define('USER_DEFAULT_AVATAR', USER_AVATAR_PATH.'defaultUser.png'); //user placeholder image
define('AUDIO_PATH', 'uploads/media_audio/'); //media audio path
define('PHOTO_PATH', 'uploads/media_photo/'); //media photo path
define('PHOTO_THUMB_PATH', 'uploads/media_photo/thumb/'); //media photo path thumb
define('VIDEO_PATH', 'uploads/media_video/'); //media video path
define('VIDEO_THUMB_PATH','uploads/video_thumb/'); //media video thumbnail path
define('VIDEO_THUMB_THUMB_PATH','uploads/video_thumb/thumb/'); //media video thumbnail thumb path

//Title, Site name, Copyright etc
define('SITE_NAME','Qrees'); //your project name
define('COPYRIGHT','&copy; ' . date('Y') . ' - ' . date("Y",strtotime("-1 year")). ', Qrees.com. All rights reserved.');
define('INFO_EMAIL','info@project.com'); //your project name


//common messages
define('UNKNOWN_ERR', 'Something went wrong. Please try again');
define('FAIL', 'fail');
define('SUCCESS', 'success');
define('BAD_REQUEST',	'400');

//Asset path (In place of "APP_" you can use your own project specific prefix)
/* Frontend */
define('APP_ASSETS_JS', 'frontend_assets/js/');
define('APP_ASSETS_CSS', 'frontend_assets/css/');
define('APP_ASSETS_PLUGIN', 'frontend_assets/plugins/');
define('APP_ASSETS_IMG', 'frontend_assets/img/');

/* Admin */
define('APP_ADMIN_ASSETS_JS', 'backend_assets/js/');
define('APP_ADMIN_ASSETS_CSS', 'backend_assets/css/');
define('APP_ADMIN_ASSETS_PLUGIN', 'backend_assets/plugins/');
define('APP_ADMIN_ASSETS_IMG', 'backend_assets/img/');
define('APP_ADMIN_ASSETS_CUSTOM_JS', 'backend_assets/custom/js/');
define('APP_ADMIN_ASSETS_CUSTOM_CSS', 'backend_assets/custom/css/');


//Backend(ADMIN) assets
define('CDN_BACK_ASSETS', CDN_URL.'backend_assets/'); //ADMIN THEME
define('CDN_BACK_DIST_CSS', CDN_BACK_ASSETS.'dist/css/');
define('CDN_BACK_DIST_JS', CDN_BACK_ASSETS.'dist/js/');
define('CDN_BACK_DIST_IMG', CDN_BACK_ASSETS.'dist/img/');
define('CDN_BACK_BUILD', CDN_BACK_ASSETS.'build/');
define('CDN_BACK_BOOTSTRAP_CSS', CDN_BACK_ASSETS.'bootstrap/css/');
define('CDN_BACK_BOOTSTRAP_JS', CDN_BACK_ASSETS.'bootstrap/js/');
define('CDN_BACK_BOOTSTRAP_FONTS', CDN_BACK_ASSETS.'bootstrap/fonts/');
define('CDN_BACK_PLUGINS', CDN_BACK_ASSETS.'plugins/');

//user uploads
define('CDN_ADMIN_IMG_PATH', CDN_UPLOAD.'user_avatar/'); //original image
define('CDN_ADMIN_THUMB_IMG', CDN_ADMIN_IMG_PATH.'thumb/'); //thumb 
define('CDN_ADMIN_MEDIUM_IMG', CDN_ADMIN_IMG_PATH.'medium/'); //medium 
define('CDN_ADMIN_LARGE_IMG', CDN_ADMIN_IMG_PATH.'large/'); //large

//placeholders
define('CDN_PLACEHOLDER_IMG', CDN_UPLOAD.'placeholders/'); //Placeholder folder
define('CDN_USER_PLACEHOLDER_IMG', CDN_PLACEHOLDER_IMG.'user-placeholder.png'); //user placeholder

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
