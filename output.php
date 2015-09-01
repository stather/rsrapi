<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 18/08/15
 * Time: 22:54
 */
echo ("hello world");

phpinfo();

$w = stream_get_wrappers();
echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
echo 'wrappers: ', var_dump($w);
