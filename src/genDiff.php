<?php
declare(strict_types=1);
namespace Differ\Differ;

define('EQUAL', '    ');
define('ADDED', '  + ');
define('REMOVED', '  - ');

/**
 * Generate string with difference two json objects
 * @param $firstFilePath string path to first file
 * @param $secondFilePath string path to second file
 * @return string difference in json object format
 */
function genDiff(string $firstFilePath, string $secondFilePath): string
{
    $first = json_decode(file_get_contents($firstFilePath), true);
    $second = json_decode(file_get_contents($secondFilePath), true);
    $merged = array_merge($first, $second);
    ksort($merged);

    $result = '{' . PHP_EOL;
    foreach ($merged as $key => $value) {
        if (!array_key_exists($key, $first)) {
            $result .= ADDED . "$key: " . var_export($second[$key], true) . PHP_EOL;
            continue;
        }

        if (!array_key_exists($key, $second)) {
            $result .= REMOVED . "$key: " . var_export($first[$key], true) . PHP_EOL;
            continue;
        }

        if (var_export($first[$key], true) === var_export($second[$key], true)) {
            $result .= EQUAL . "$key: " . var_export($second[$key], true) . PHP_EOL;
            continue;
        }

        $result .= REMOVED . "$key: " . var_export($first[$key], true) . PHP_EOL;
        $result .= ADDED . "$key: " . var_export($second[$key], true) . PHP_EOL;
    }

    $result .= "}" . PHP_EOL;
    return $result;
}
