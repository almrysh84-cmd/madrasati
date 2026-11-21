<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // Diagnostic: log every exception to an `error_log` DB table so we can
        // read the real error message remotely (Render free-tier runtime logs
        // aren't exposed via API, and APP_DEBUG=false hides the message in the
        // HTTP response). Uses a raw PDO connection — lightweight, no further
        // bootstrapping. Safe: wrapped in try/catch, never throws.
        $this->reportable(function (Throwable $e) {
            try {
                $cfg = config('database.connections.mysql');
                $pdo = new \PDO(
                    "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['database']};charset=utf8mb4",
                    $cfg['username'], $cfg['password'],
                    [\PDO::ATTR_TIMEOUT => 4]
                );
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $pdo->exec("CREATE TABLE IF NOT EXISTS error_log (id INT AUTO_INCREMENT PRIMARY KEY, msg TEXT, file VARCHAR(255), line INT, cls VARCHAR(255), url VARCHAR(255), ts VARCHAR(40))");
                $st = $pdo->prepare("INSERT INTO error_log (msg, file, line, cls, url, ts) VALUES (?, ?, ?, ?, ?, ?)");
                $st->execute([
                    mb_substr($e->getMessage(), 0, 1000),
                    mb_substr($e->getFile(), 0, 255),
                    $e->getLine(),
                    get_class($e),
                    mb_substr(request()->fullUrl(), 0, 255),
                    date('Y-m-d H:i:s'),
                ]);
            } catch (\Throwable $ex) {
                // never let the logger itself throw
            }
        });
    }
}
