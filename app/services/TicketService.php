<?php

namespace App\Services;

use Exception;
use App\Exceptions\InputValidationException;
use App\Models\Ticket;
use App\Models\TicketRequest;
use App\Models\TicketResponse;
use App\Repositories\TicketRepository;

class TicketService
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function validateTicketRequest(TicketRequest $request): void
    {
        if (empty(trim($request->event_id))) {
            throw new InputValidationException('Event id must be filled');
        }

        if (empty(trim($request->type))) {
            throw new InputValidationException('Event type must be filled');
        }

        if (empty(trim($request->description))) {
            throw new InputValidationException('Description must be filled');
        }
    }

    public function storeTicket(TicketRequest $request): TicketResponse
    {
        $this->validateTicketRequest($request);

        $ticket = new Ticket;
        $ticket->event_id = $request->event_id;
        $ticket->price = $request->price;
        $ticket->type = $request->type;
        $ticket->description = $request->description;

        $create = $this->ticketRepository->create($ticket);

        if (is_null($create)) {
            throw new Exception('Failed to create the ticket');
        }

        $response = new TicketResponse;
        $response->ticket = $create;

        return $response;
    }
}
