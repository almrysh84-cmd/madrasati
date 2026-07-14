<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\QuizService;
use App\Models\Quizze;
use App\Models\Question;
use App\Models\Student;

class QuizServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function quiz_service_is_registered()
    {
        $service = app(QuizService::class);
        $this->assertInstanceOf(QuizService::class, $service);
    }

    /** @test */
    public function check_answer_mcq_single()
    {
        $service = app(QuizService::class);
        $question = new Question([
            'question_type' => 'mcq_single',
            'right_answer'  => 'الرياض',
        ]);

        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('checkAnswer');
        $method->setAccessible(true);

        $correct = $method->invoke($service, $question, 'الرياض');
        $wrong = $method->invoke($service, $question, 'جدة');

        $this->assertTrue($correct);
        $this->assertFalse($wrong);
    }

    /** @test */
    public function check_answer_fill_blank_multiple()
    {
        $service = app(QuizService::class);
        $question = new Question([
            'question_type' => 'fill_blank',
            'right_answer'  => 'الرياض|عاصمة السعودية',
        ]);

        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('checkAnswer');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($service, $question, 'الرياض'));
        $this->assertTrue($method->invoke($service, $question, 'عاصمة السعودية'));
        $this->assertFalse($method->invoke($service, $question, 'جدة'));
    }
}
