<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\TicketStoreRequest;
use App\Services\EventService;
use App\Services\TicketService;
use Exception;
use Flasher;

class TicketController extends Controller
{
    private EventService $eventService;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->eventService = $this->service('Event');
        $this->ticketService = $this->service('Ticket');
    }

    public function index()
    {
        $data['title'] = 'Ticket';
        $data['ticketData'] = $this->ticketService->getTickets();
        $this->view('templates/header', $data);
        $this->view('admin/tickets/index', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $data['eventData'] = $this->eventService->getEvents();

        if (isset($_POST['price'])) {
            try {
                $ticketStoreRequest = new TicketStoreRequest;
                $ticketStoreRequest->event_id = $_POST['event_id'];
                $ticketStoreRequest->price = (float)$_POST['price'];
                $ticketStoreRequest->stock = (int)$_POST['stock'];
                $ticketStoreRequest->type = $_POST['type'];
                $ticketStoreRequest->description = $_POST['description'];

                $status = $this->ticketService->storeTicket($ticketStoreRequest);

                if ($status) {
                    Flasher::setFlash('Create ticket success', 'success');
                } else {
                    Flasher::setFlash('Create ticket failed', 'danger');
                }
            } catch (Exception $ex) {
                Flasher::setFlash($ex->getMessage(), 'danger');
            }

            $this->back();
        }

        $this->view('admin/tickets/store', $data);
    }

    public function edit(int $id)
    {
        try {
            $data['editData'] = $this->ticketService->getTicket($id);
            $data['eventData'] = $this->eventService->getEvents();
            $this->view('admin/tickets/edit', $data);
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }
    }

    public function update()
    {
        if (isset($_POST['price'])) {
            try {
                $ticketStoreRequest = new TicketStoreRequest;
                $ticketStoreRequest->id = $_POST['id'];
                $ticketStoreRequest->event_id = $_POST['event_id'];
                $ticketStoreRequest->price = (float)$_POST['price'];
                $ticketStoreRequest->stock = (int)$_POST['stock'];
                $ticketStoreRequest->type = $_POST['type'];
                $ticketStoreRequest->description = $_POST['description'];

                $status = $this->ticketService->updateTicket($ticketStoreRequest);

                if ($status) {
                    Flasher::setFlash('Update ticket success', 'success');
                } else {
                    Flasher::setFlash('Update ticket failed', 'danger');
                }
            } catch (Exception $ex) {
                Flasher::setFlash($ex->getMessage(), 'danger');
            }

            $this->back();
        }
    }

    public function delete(int $id)
    {
        try {
            $status = $this->ticketService->deleteTicket($id);

            if ($status) {
                Flasher::setFlash('Delete ticket success', 'success');
            } else {
                Flasher::setFlash('Delete ticket failed', 'danger');
            }
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }

        $this->back();
    }

    public function getRowCount(): int
    {
        return $this->ticketService->getRowCount();
    }

    private function back()
    {
        echo "<script>location.href = '" . BASE_URL . "/dashboard/admin/ticket';</script>";

        return;
    }
}
