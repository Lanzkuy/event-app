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
        if (empty(trim($request->event_id))) {
            throw new InputValidationException('Event id must be filled');
        }

        if (empty(trim($request->price))) {
            throw new InputValidationException('Price must be filled');
        }

        if (empty(trim($request->stock))) {
            throw new InputValidationException('Stock must be filled');
        }

        if (empty(trim($request->type))) {
            throw new InputValidationException('Event type must be filled');
        }

        if (empty(trim($request->description))) {
            throw new InputValidationException('Description must be filled');
        }
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

    public function getTicket(int $id): ?Ticket
    {
        $event = $this->ticketRepository->get('id', $id);

        if (is_null($event)) {
            throw new ServiceManagementException('Ticket not found');
        }

        return $event;
    }

    /*public function getTickets(int $position = 0, int $limit = 8): array
    {
        return $this->ticketRepository->getAll($position, $limit);
    }*/

    public function getTickets(): array
    {
        return $this->ticketRepository->getAll();
    }

    public function findTicket(string $event_title, int $position = 0, int $limit = 5): array
    {
        return $this->ticketRepository->find($event_title, $position, $limit);
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

    public function getRowCount() : int {
        return $this->ticketRepository->getRowCount();
    }

    public function getTicketByEventId(int $event_id): array
    {
        return $this->ticketRepository->getByEventId($event_id);
    }

    public function updateQtyTicket(int $id, int $qty)
    {
        return $this->ticketRepository->updateQty($id, $qty);
    }
}
