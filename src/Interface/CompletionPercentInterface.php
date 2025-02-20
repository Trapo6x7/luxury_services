<?php

namespace App\Interface;

use App\Entity\Candidate;

interface CompletionPercentInterface
{
    public function calculerProgress(Candidate $candidate): int;
}