<?php
declare(strict_types=1);

// Database connection settings.
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'student_registration_system');
define('DB_USER', 'root');
define('DB_PASS', '');

// Resolve the application URL from the actual project directory.
$projectRoot = realpath(dirname(__DIR__));
$documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$baseUrl = '';

if ($projectRoot !== false && $documentRoot !== false) {
    $rootPath = rtrim(str_replace('\\', '/', $documentRoot), '/');
    $appPath = str_replace('\\', '/', $projectRoot);
    if (stripos($appPath, $rootPath . '/') === 0) {
        $baseUrl = '/' . trim(substr($appPath, strlen($rootPath)), '/');
    } elseif (strcasecmp($appPath, $rootPath) === 0) {
        $baseUrl = '';
    }
}

if ($baseUrl === '' && !empty($_SERVER['SCRIPT_NAME'])) {
    $scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if (in_array(basename($scriptDirectory), ['students', 'api'], true)) {
        $scriptDirectory = dirname($scriptDirectory);
    }
    $baseUrl = rtrim($scriptDirectory, '/');
}

define('BASE_URL', $baseUrl);
define('UPLOAD_DIR', dirname(__DIR__) . '/uploads');
define('MAX_UPLOAD_BYTES', 2 * 1024 * 1024);
