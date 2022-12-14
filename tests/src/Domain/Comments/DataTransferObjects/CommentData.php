<?php

namespace Domain\Comments\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CommentData extends DataTransferObject
{
    public function __construct(
        public string $content,
        ) {}
}
