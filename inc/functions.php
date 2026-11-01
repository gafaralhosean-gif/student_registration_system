<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(['httponly'=>true, 'samesite'=>'Lax', 'secure'=>!empty($_SERVER['HTTPS'])]);
    session_start();
}
require_once __DIR__ . '/../config/database.php';
function e(?string $v): string { return htmlspecialchars($v ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function redirect(string $path): never { header('Location: ' . BASE_URL . $path); exit; }
function is_logged_in(): bool { return isset($_SESSION['user_id']); }
function require_login(): void { if (!is_logged_in()) { flash('error','يرجى تسجيل الدخول أولاً.'); redirect('/login.php'); } }
function flash(string $key, ?string $message=null): ?string {
    if ($message !== null) { $_SESSION['flash'][$key]=$message; return null; }
    $value=$_SESSION['flash'][$key] ?? null; unset($_SESSION['flash'][$key]); return $value;
}
function csrf_token(): string { if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token']=bin2hex(random_bytes(32)); return $_SESSION['csrf_token']; }
function verify_csrf(): void { $sent=$_POST['csrf_token'] ?? ''; if (!is_string($sent) || !hash_equals(csrf_token(),$sent)) { http_response_code(419); exit('انتهت صلاحية النموذج. أعد تحميل الصفحة وحاول مجدداً.'); } }
function valid_email(string $email): bool { return (bool)filter_var($email,FILTER_VALIDATE_EMAIL); }
function upload_picture(array $file): ?string {
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) throw new RuntimeException('تعذر رفع الصورة.');
    if (($file['size'] ?? 0) > MAX_UPLOAD_BYTES) throw new RuntimeException('حجم الصورة يجب ألا يتجاوز 2 ميغابايت.');
    $finfo=new finfo(FILEINFO_MIME_TYPE); $mime=$finfo->file($file['tmp_name']);
    $allowed=['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif','image/webp'=>'webp'];
    if (!isset($allowed[$mime]) || @getimagesize($file['tmp_name'])===false) throw new RuntimeException('صيغة الصورة غير مسموحة. استخدم JPG أو PNG أو GIF أو WEBP.');
    if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR,0755,true) && !is_dir(UPLOAD_DIR)) throw new RuntimeException('تعذر إنشاء مجلد الصور.');
    $name=bin2hex(random_bytes(16)).'.'.$allowed[$mime];
    if (!move_uploaded_file($file['tmp_name'],UPLOAD_DIR.'/'.$name)) throw new RuntimeException('تعذر حفظ الصورة على الخادم.');
    return $name;
}
function delete_picture(?string $name): void { if ($name && preg_match('/^[a-f0-9]{32}\.(jpg|png|gif|webp)$/',$name)) { $p=UPLOAD_DIR.'/'.$name; if (is_file($p)) @unlink($p); } }
