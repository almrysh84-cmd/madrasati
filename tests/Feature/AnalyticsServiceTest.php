<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\AnalyticsService;
use App\Models\Student;

class AnalyticsServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dashboard_stats_returns_array()
    {
        $service = app(AnalyticsService::class);
        $stats = $service->dashboardStats();

        $this->assertIsArray($stats);
        $this->assertArrayHasKey('students_count', $stats);
        $this->assertArrayHasKey('teachers_count', $stats);
    }

    /** @test */
    public function top_students_returns_array()
    {
        $service = app(AnalyticsService::class);
        $result = $service->topStudents(5);

        $this->assertIsArray($result);
        $this->assertLessThanOrEqual(5, count($result));
    }

    /** @test */
    public function financial_report_has_required_keys()
    {
        $service = app(AnalyticsService::class);
        $report = $service->financialReport();

        $this->assertArrayHasKey('total_invoiced', $report);
        $this->assertArrayHasKey('total_collected', $report);
        $this->assertArrayHasKey('pending', $report);
        $this->assertArrayHasKey('collection_rate', $report);
    }
}
