<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 06/09/15
 * Time: 21:08
 */

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

require __DIR__ . '/vendor/autoload.php';
require_once 'generated-conf/config.php';

define("RSR", "com\\readysteadyrainbow\\");
define("ENTITYNS", "com\\readysteadyrainbow\\entities");

function MyAutoLoader($class){
    if (substr_compare($class, ENTITYNS, 0, strlen(ENTITYNS)) == 0){
        $path = __DIR__ . "/entities";
        $toks = explode("\\", $class);
        foreach ($toks as $item){
            $path = $path . "/" . $item;
        }
        $path = $path . ".php";
        if (file_exists($path)) {
            include $path;
        }
        return;
    }
    if (substr_compare($class, RSR, 0, strlen(RSR)) == 0){
        $toks = explode("\\", $class);
        include __DIR__ . "/" . $toks[2] . "/" . $toks[3] . ".php";
        return;
    }
    $start = strlen($class) - strlen("Controller");
    if (substr_compare($class, "Controller", $start ) == 0){
        include __DIR__ . "/controllers/" . $class . ".php";
        return;
    }
}

spl_autoload_register('MyAutoLoader');

date_default_timezone_set('UTC');
$credentials = new Credentials('AKIAJIYBZPTDIRPEDJRQ', 'vbJnztNWV1Aa/kqBax31EocVnv8ZvW0Q7ZYgzTtK');
// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => $credentials
]);
\Aws\S3\StreamWrapper::register($s3);
