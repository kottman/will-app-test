<?php

namespace App\ValueObjects\Structs;

interface StructInterface
{
    public function fill(array $data): self;
}
