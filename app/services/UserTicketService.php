<?php

namespace App\Services;

use App\Exceptions\InputValidationException;
use App\Exceptions\ServiceManagementException;
use App\Models\Ticket;
use App\Models\TicketStoreRequest;
use App\Repositories\UserTicketRepository;

class UserTicketService
{
    private UserTicketRepository $userTicketRepository;

    public function __construct(UserTicketRepository $userTicketRepository)
    {
        $this->userTicketRepository = $userTicketRepository;
    }

    public function validateTicketRequest(TicketStoreRequest $request): void
    {
        if (empty(trim($request->price))) {
            throw new InputValidationException('price must be filled.');
        }
        
        if (empty(trim($request->stock))) {
            throw new InputValidationException('stock must be filled.');
        }

        if (empty(trim($request->description))) {
            throw new InputValidationException('description must be filled.');
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

        $create = $this->userTicketRepository->store($ticket);

        if (is_null($create)) {
            throw new ServiceManagementException('Failed to create ticket');
        }

        return $create;
    }

    public function getTicketByType(string $type, int $event_id)
    {
        return $this->userTicketRepository->getByType($type, $event_id);
    }

    public function updateQtyTicket(int $id, int $qty)
    {
        return $this->userTicketRepository->updateQty($id, $qty);
    }

    public function addQtyTicket(int $id, int $qty)
    {
        return $this->userTicketRepository->addQty($id, $qty);
    }

    public function updateTicket(TicketStoreRequest $request): bool
    {
        $this->validateTicketRequest($request);

        $ticket = new Ticket;
        $ticket->id = $request->id;
        $ticket->price = $request->price;
        $ticket->stock = $request->stock;
        $ticket->description = $request->description;

        $update = $this->userTicketRepository->update($ticket);

        if (is_null($update)) {
            throw new ServiceManagementException('Failed to update ticket');
        }

        return $update;
    }

    public function deleteTicket(int $event_id)
    {
        return $this->userTicketRepository->delete($event_id);
    }

    public function getTicketByEventId(int $event_id): array
    {
        return $this->userTicketRepository->getByEventId($event_id);
    }

}