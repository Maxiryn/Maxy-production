<?php
declare(strict_types=1);

function esc($value): string { return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8'); }
function go(string $page): never { header('Location: /html/' . $page, true, 303); exit; }
function sb(string $path, string $method = 'GET', ?array $body = null, ?string $token = null, string $prefer = ''): array {
    $url = rtrim(getenv('SUPABASE_URL') ?: '', '/');
    $key = getenv('SUPABASE_PUBLISHABLE_KEY') ?: '';
    if (!$url || !$key) { throw new RuntimeException('The account service is not configured yet.'); }
    $headers = ['apikey: ' . $key, 'Content-Type: application/json'];
    if ($token) $headers[] = 'Authorization: Bearer ' . $token;
    if ($prefer) $headers[] = 'Prefer: ' . $prefer;
    $ch = curl_init($url . $path);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_CUSTOMREQUEST => $method, CURLOPT_HTTPHEADER => $headers, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 15]);
    if ($body !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body, JSON_THROW_ON_ERROR));
    $raw = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($raw === false || !$status) throw new RuntimeException('Unable to reach the account service. Please try again.');
    $data = json_decode($raw, true) ?? [];
    if ($status >= 400) {
        error_log('Supabase request failed: ' . $method . ' ' . strtok($path, '?') . ' HTTP ' . $status);
        throw new RuntimeException(str_starts_with($path, '/auth/') ? 'Unable to complete this account request. Check your details and email confirmation, then try again.' : 'Unable to save or load this information. Please try again.');
    }
    return $data;
}
function cookie_value(string $name, string $value, int $expires): void {
    setcookie($name, $value, ['expires' => $expires, 'path' => '/', 'secure' => (bool)getenv('VERCEL') || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'), 'httponly' => true, 'samesite' => 'Lax']);
    $_COOKIE[$name] = $value;
}
function save_auth(array $data): void {
    if (empty($data['access_token']) || empty($data['refresh_token'])) return;
    cookie_value('maxy_access', $data['access_token'], time() + 3600);
    cookie_value('maxy_refresh', $data['refresh_token'], time() + 2592000);
}
function current_user(): ?array {
    static $loaded = false, $user = null;
    if ($loaded) return $user;
    $loaded = true;
    if (!empty($_COOKIE['maxy_access'])) {
        try { return $user = sb('/auth/v1/user', token: $_COOKIE['maxy_access']); } catch (RuntimeException $e) { }
    }
    if (!empty($_COOKIE['maxy_refresh'])) {
        try {
            $data = sb('/auth/v1/token?grant_type=refresh_token', 'POST', ['refresh_token' => $_COOKIE['maxy_refresh']]);
            save_auth($data);
            return $user = sb('/auth/v1/user', token: $_COOKIE['maxy_access']);
        } catch (RuntimeException $e) { }
    }
    return null;
}
function require_user(bool $admin = false): array {
    $user = current_user();
    if (!$user) go($admin ? 'admin_login.php' : 'login.php');
    if ($admin && ($user['app_metadata']['role'] ?? '') !== 'admin') { http_response_code(403); exit('Administrator access is required.'); }
    return $user;
}
function db(string $resource, string $method = 'GET', ?array $data = null, string $prefer = ''): array {
    current_user();
    return sb('/rest/v1/' . $resource, $method, $data, $_COOKIE['maxy_access'] ?? null, $prefer);
}
function csrf(): string {
    if (empty($_COOKIE['maxy_csrf'])) cookie_value('maxy_csrf', bin2hex(random_bytes(32)), time() + 86400);
    return '<input type="hidden" name="csrf" value="' . esc($_COOKIE['maxy_csrf']) . '">';
}
function check_post(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Please submit the form.'); }
    if (empty($_COOKIE['maxy_csrf']) || !hash_equals($_COOKIE['maxy_csrf'], (string)($_POST['csrf'] ?? ''))) { http_response_code(403); exit('This form expired. Reload the page and try again.'); }
}
function field(string $name, int $max = 500): string {
    $value = trim((string)($_POST[$name] ?? ''));
    if (strlen($value) > $max) throw new RuntimeException('One of the fields is too long.');
    return $value;
}
function page_start(string $title): void {
    $pageTitle = $title;
    require __DIR__ . '/../html/partials/header.php';
    echo '<header class="page-head"><div class="container narrow"><h1>' . esc($title) . '</h1></div></header><section class="section tight"><div class="container narrow"><div class="panel account">';
}
function page_end(): void { echo '</div></div></section>'; require __DIR__ . '/../html/partials/footer.php'; }
function notice(string $text): void { echo '<p class="notice" role="status">' . esc($text) . '</p>'; }
function input(string $name, string $label, string $value = '', string $type = 'text', bool $required = false): void {
    echo '<div class="form-field"><label for="' . esc($name) . '">' . esc($label) . '</label><input id="' . esc($name) . '" name="' . esc($name) . '" type="' . esc($type) . '" value="' . esc($value) . '"' . ($required ? ' required' : '') . '></div>';
}
