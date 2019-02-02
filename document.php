<?php
/**
  * @author Aleksandar Panic
  * @link https://jsonql.readthedocs.io/
  * @license: http://www.apache.org/licenses/LICENSE-2.0
  * @since 1.0.0
 **/

$documentorPath = __DIR__ . '/phpDocumentor.phar';
$documentorDownloadLink = 'http://phpdoc.org/phpDocumentor.phar';

if (!file_exists($documentorPath)) {
   echo "Documentor executable does not exist downloading..." . PHP_EOL;
   file_put_contents($documentorPath, file_get_contents($documentorDownloadLink));
}

echo "Building documentation." . PHP_EOL;
exec(PHP_BINARY . ' ' . $documentorPath . ' run -d src -t doc');

echo "Done" . PHP_EOL;