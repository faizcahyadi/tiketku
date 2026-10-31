<?php

namespace App\Actions\Auth;

final readonly class LoginAttemptResult
{
    public function __construct(
        public bool $authenticated,
        public ?int $retryAfterSeconds = null,
    ) {}
}
