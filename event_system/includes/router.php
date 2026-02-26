<?php
declare(strict_types=1);

const ALLOW_METHODS = ['GET', 'POST'];
const INDEX_URI = '';
const INDEX_ROUTE = 'login'; 

function normalizeUri(string $uri): string
{
    // 1. แยกเอาส่วน Path ออกมา
    $path = parse_url($uri, PHP_URL_PATH) ?? '';

    // 2. ทำความสะอาดค่าจาก $path
    $uri = strtolower(trim($path, '/'));

    $scriptName = strtolower(trim(dirname($_SERVER['SCRIPT_NAME']), '/'));
    if (!empty($scriptName) && strpos($uri, $scriptName) === 0) {
        $uri = trim(substr($uri, strlen($scriptName)), '/');
    }

    return $uri == INDEX_URI ? INDEX_ROUTE : $uri;
}

function notFound()
{
    http_response_code(404);
    if (function_exists('renderView')) {
        renderView('404');
    } else {
        echo "404 Not Found";
    }
    exit;
}

function getFilePath(string $uri): string
{
    return ROUTE_DIR . '/' . $uri . '.php';
}

function dispatch(string $uri, string $method): void
{
    $normalizedUri = normalizeUri($uri);

    if (!in_array(strtoupper($method), ALLOW_METHODS)) {
        notFound();
    }

    $filePath = getFilePath($normalizedUri);
    if (file_exists($filePath)) {
        include($filePath);
    } else {
        notFound();
    }
}