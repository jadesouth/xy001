<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

/* COMMENT CONSTANT */
defined('DS') OR define('DS', '/');  // DIRECTORY_SEPARATOR 目录分隔符简化写法
/* PATH */
defined('PATH_ROOT')  OR define('PATH_ROOT', dirname(dirname(__DIR__)) . DS);    // 项目跟路径
defined('PATH_APP')   OR define('PATH_APP', PATH_ROOT . 'application' . DS);     // APP项目路径
defined('PATH_CACHE') OR define('PATH_CACHE', PATH_APP . 'cache' . DS);          // Catch目录
defined('PATH_SESS')  OR define('PATH_SESS', PATH_CACHE . 'session' . DS);       // session保存路径
defined('PATH_MODEL') OR define('PATH_MODEL', PATH_APP . 'models' . DS);         // model存放路径
defined('PATH_RESOURCE') OR define('PATH_RESOURCE', PATH_ROOT . 'resources' . DS);  // 资源文件绝对物理路径
defined('PATH_UPLOAD') OR define('PATH_UPLOAD', PATH_RESOURCE . 'uploads' . DS);                            // 上传文件绝对物理路径
/* upload setting */
defined('UPLOAD_FILE_MAX_SIZE') OR define('UPLOAD_FILE_MAX_SIZE', 4080);  // 允许上传文件大小的最大值(KB)
/* Admin CONSTANT */
defined('ADMIN_PAGE_SIZE') OR define('ADMIN_PAGE_SIZE', 20); // 分页大小
/* folder name*/
defined('PATH_LIBRARY') OR define('PATH_LIBRARY', PATH_APP . 'libraries' .DS);
defined('PATH_THIRD_PARTY') OR define('PATH_THIRD_PARTY', PATH_APP . 'third_party' .DS);
defined('FOLDER_RESOURCE') OR define('FOLDER_RESOURCE', 'resources' .DS);
defined('FOLDER_UPLOAD') OR define('FOLDER_UPLOAD', FOLDER_RESOURCE.'uploads'.DS );
/* alipay SDK工作目录 存放日志，AOP缓存数据*/
defined('AOP_SDK_WORK_DIR') OR define('AOP_SDK_WORK_DIR', PATH_APP.'logs'.DS);
/**
 * 是否处于开发模式
 * 在你自己电脑上开发程序的时候千万不要设为false，以免缓存造成你的代码修改了不生效
 * 部署到生产环境正式运营后，如果性能压力大，可以把此常量设定为false，能提高运行速度（对应的代价就是你下次升级程序时要清一下缓存）
 */
defined('AOP_SDK_DEV_MODE') OR define('AOP_SDK_DEV_MODE', true);