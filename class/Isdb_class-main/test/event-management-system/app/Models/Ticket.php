<?php

declare(strict_types=1);

namespace App\Models;

final class Ticket extends AbstractEntity
{
    public function __construct(
        ?int $id,
        private int $userId,
        private int $eventId,
        private string $ticketCode,
        private string $issuedAt
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'event_id' => $this->eventId,
            'ticket_code' => $this->ticketCode,
            'issued_at' => $this->issuedAt,
        ];
    }
}
