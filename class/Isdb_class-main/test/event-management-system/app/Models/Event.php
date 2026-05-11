<?php

declare(strict_types=1);

namespace App\Models;

final class Event extends AbstractEntity
{
    public function __construct(
        ?int $id,
        private string $title,
        private string $slug,
        private string $description,
        private string $venue,
        private string $eventDate,
        private float $price,
        private string $coverImage,
        private string $status = 'upcoming'
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'venue' => $this->venue,
            'event_date' => $this->eventDate,
            'price' => $this->price,
            'cover_image' => $this->coverImage,
            'status' => $this->status,
        ];
    }
}
