<?php

readonly class Photo
{
    public function __construct(
        public int $id,
        public string $photo,
        public string $owner,
    ) {
    }
}