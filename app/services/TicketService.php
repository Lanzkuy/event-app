<?php

namespace App\Services;

use App\Exceptions\InputValidationException;
use App\Exceptions\ServiceManagementException;
use App\Models\Ticket;
use App\Models\TicketStoreRequest;
use App\Repositories\TicketRepository;

class TicketService
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function validateTicketRequest(TicketStoreRequest $request): void
    {
        
        
    }

    public function storeTicket(TicketStoreRequest $request): bool
    {
        $this->validateTicketRequest($request);

        $ticket = new Ticket;
        $ticket->event_id = $request->event_id;
        $ticket->price = $request->price;
        $ticket->stock = $request->stock;
        $ticket->type = $request->type;
        $ticket->description = $request->description;

        $create = $this->ticketRepository->store($ticket);

        if (is_null($create)) {
            throw new ServiceManagementException('Failed to create ticket');
        }

        return $create;
    }

    public function getTicketByType(string $type, int $event_id)
    {
        return $this->ticketRepository->getByType($type, $event_id);
    }

    public function updateQtyTicket(int $id, int $qty)
    {
        return $this->ticketRepository->updateQty($id, $qty);
    }

    public function updateTicket(TicketStoreRequest $request): bool
    {
        $this->validateTicketRequest($request);

        $ticket = new Ticket;
        $ticket->id = $request->id;
        $ticket->price = $request->price;
        $ticket->stock = $request->stock;
        $ticket->description = $request->description;

        $update = $this->ticketRepository->update($ticket);

        if (is_null($update)) {
            throw new ServiceManagementException('Failed to update ticket');
        }

        return $update;
    }

    public function deleteTicket(int $event_id)
    {
        return $this->ticketRepository->delete($event_id);
    }

    public function getTicketByEventId(int $event_id): array
    {
        return $this->ticketRepository->getByEventId($event_id);
    }

}
