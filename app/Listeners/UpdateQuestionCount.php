<?php

namespace App\Listeners;

use App\Events\QuestionCountUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateQuestionCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(QuestionCountUpdated $event)
    {
        $questionPackage = $event->questionPackage;
        // Cập nhật số câu hỏi trong gói câu hỏi
        $questionPackage->question_count = $questionPackage->questions()->count();
        $questionPackage->save();
    }
}
