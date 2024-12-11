<?php

namespace App\Events;

use App\Models\QuestionPackage;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionCountUpdated
{
    use Dispatchable, SerializesModels;

    public $questionPackage;

    public function __construct(QuestionPackage $questionPackage)
    {
        $this->questionPackage = $questionPackage;
    }
}
