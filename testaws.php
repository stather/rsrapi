<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 20/08/15
 * Time: 20:46
 */

// Require the Composer autoloader.
require __DIR__ . '/vendor/autoload.php';


use \Aws\S3\S3Client;
use \Aws\Credentials\Credentials;

$credentials = new Credentials('AKIAJIYBZPTDIRPEDJRQ', 'vbJnztNWV1Aa/kqBax31EocVnv8ZvW0Q7ZYgzTtK');

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => $credentials
]);

try {
    $s3->putObject([
        'Bucket' => 'appy-little-eaters',
        'Key'    => 'my-object',
        'Body'   => fopen('/Users/russellstather/Sites/index.html', 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}
