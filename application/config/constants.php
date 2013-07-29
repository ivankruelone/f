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

define('TITULO_WEB',		'Farmacias "El F&eacute;nix" del Centro S.A. de C.V.');
define('DESCRIPCION_WEB',		'website description');
define('KEYWORDS_WEB',		'website keywords, website keywords');

define ("CLIENTE_PFIZER", "http://72.32.11.237/LMS.Pfizer.Prepago.WebService/WSPrepago.asmx");
define ("NAMESPACE_PFIZER", "http://webservicewts/");
define ('USUARIO_PFIZER', '6713476253');
define ('PASSWORD_PFIZER', '1259941000');
define ('OPERADOR_PFIZER', '3417324623');
define ('CADENA_PFIZER', '999');
define ('SUCURSAL_PFIZER', '999');
define('GERENTE_RH_ID', '1795');



/* End of file constants.php */
/* Location: ./application/config/constants.php */