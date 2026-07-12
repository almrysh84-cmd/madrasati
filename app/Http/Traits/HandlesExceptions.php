<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

/**
 * P0-11 fix: Centralized exception handling.
 *
 * Previously, 60+ catch blocks across the app did:
 *   return redirect()->back()->withErrors(['error' => $e->getMessage()]);
 *
 * This leaks DB internals, file paths, foreign-key constraint messages, etc.
 * to the end user — useful for attackers. Use this trait instead:
 *
 *   catch (\Exception $e) {
 *       return $this->handleError($e);
 *   }
 *
 * In local/dev environments the original message is still shown for debugging.
 * In production a generic message is returned and the real exception is logged.
 */
trait HandlesExceptions
{
    protected function handleError(\Exception $e, string $defaultMsg = 'حدث خطأ، يرجى المحاولة لاحقاً')
    {
        Log::error($e->getMessage(), [
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'user' => auth()->id(),
            'url' => request()->fullUrl(),
        ]);

        if (app()->environment('local', 'testing')) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }

        return redirect()->back()->withErrors(['error' => $defaultMsg])->withInput();
    }
}
