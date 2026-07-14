<?php

namespace App\Models\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait لإضافة دعم Multi-Tenancy لأي موديل.
 *
 * الاستخدام:
 *   class Student extends Model {
 *       use BelongsToTenant;
 *   }
 *
 * هذا سيضيف:
 * - علاقة tenant()
 * - global scope يُصفّي تلقائياً حسب tenant_id الحالي
 * - auto-assign tenant_id عند إنشاء سجل جديد
 */
trait BelongsToTenant
{
    public static function bootBelongsToTenant()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = static::getCurrentTenantId();
            if ($tenantId) {
                $builder->where('tenant_id', $tenantId);
            }
        });

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $model->tenant_id = static::getCurrentTenantId();
            }
        });
    }

    /**
     * علاقة مع المدرسة (tenant)
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * الحصول على tenant_id الحالي (من session/auth/domain)
     */
    public static function getCurrentTenantId(): ?int
    {
        // في المستقبل: استخراج من النطاق الفرعي أو session
        // حالياً: نستخدم tenant_id = 1 (المدرسة الافتراضية)
        return session('tenant_id', 1);
    }

    /**
     * تعيين tenant_id الحالي
     */
    public static function setCurrentTenantId(int $tenantId): void
    {
        session(['tenant_id' => $tenantId]);
    }
}
