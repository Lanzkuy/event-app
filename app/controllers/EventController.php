<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\EventService;
use App\Services\TicketService;
use App\Models\EventStoreRequest;
use App\Services\CategoryService;
use App\Models\TicketStoreRequest;

class EventController extends Controller
{
    private EventService $eventService;
    private CategoryService $categoryService;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->eventService = $this->service('Event');
        $this->categoryService = $this->service('Category');
        $this->ticketService = $this->service('Ticket');
    }

    public function index()
    {
        $limit = 5;
        $page = $_GET['page'] ?? null;
        $search = $_GET['search'] ?? null;
    
        if(empty($page)){
            $position = 0; 
            $page = 1;
        }else{
            $position = ($page-1) * $limit;
        }

        if($search){
            $events = $this->eventService->findEvent($search, $position, $limit);
        }else{
            $events = $this->eventService->getEvents($position, $limit);
        }

        $row = $this->eventService->paginateEvent($search);
        $numberOfPages = ceil($row / $limit);
        
        $data['events'] = $events;
        $data['numberOfPages'] = $numberOfPages;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['title'] = 'List Event';

        $this->view('templates/header', $data);
        $this->view('user/event/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategory();

        $data['categories'] = $categories;
        $data['title'] = 'Create Event';

        $this->view('templates/header', $data);
        $this->view('user/event/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        try {
            $eventStoreRequest = new EventStoreRequest;
            $eventStoreRequest->category_id = $_POST['category_id'];
            $eventStoreRequest->title = $_POST['title'];
            $eventStoreRequest->description = $_POST['description'];
            $eventStoreRequest->image_name = $_FILES['image']['name'];
            $eventStoreRequest->image_tmp = $_FILES['image']['tmp_name'];
            $eventStoreRequest->image_size = $_FILES['image']['size'];
            $eventStoreRequest->location = $_POST['location'];
            $eventStoreRequest->start_datetime = $_POST['start_datetime'];
            $eventStoreRequest->end_datetime = $_POST['end_datetime'];

            $eventId = $this->eventService->storeEvent($eventStoreRequest);

            $ticketStoreRequest1 = new TicketStoreRequest;
            $ticketStoreRequest1->event_id = $eventId;
            $ticketStoreRequest1->price = $_POST['reguler_price'];
            $ticketStoreRequest1->stock = $_POST['reguler_stock'];
            $ticketStoreRequest1->type = 'Reguler';
            $ticketStoreRequest1->description = $_POST['reguler_description'];
            
            $this->ticketService->storeTicket($ticketStoreRequest1);

            $ticketStoreRequest2 = new TicketStoreRequest;
            $ticketStoreRequest2->event_id = $eventId;
            $ticketStoreRequest2->price = $_POST['reguler_price'];
            $ticketStoreRequest2->stock = $_POST['reguler_stock'];
            $ticketStoreRequest2->type = 'VIP';
            $ticketStoreRequest2->description = $_POST['vip_description'];
            
            $this->ticketService->storeTicket($ticketStoreRequest2);

            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function edit()
    {
        try{
            $id = $_GET['id'];
            $event = $this->eventService->getEvent($id);
            $categories = $this->categoryService->getAllCategory();

            $ticketReguler = $this->ticketService->getTicketByType('Reguler', $id);
            $ticketVIP = $this->ticketService->getTicketByType('VIP', $id);

            $data['categories'] = $categories;
            $data['ticketReguler'] = $ticketReguler;
            $data['ticketVIP'] = $ticketVIP;
            $data['event'] = $event;
            $data['title'] = 'Edit Event';

            $this->view('templates/header', $data);
            $this->view('user/event/edit', $data);
            $this->view('templates/footer');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateEvent()
    {
        try {
            $eventStoreRequest = new EventStoreRequest;
            $eventStoreRequest->id = $_POST['id'];
            $eventStoreRequest->category_id = $_POST['category_id'];
            $eventStoreRequest->title = $_POST['title'];
            $eventStoreRequest->description = $_POST['description'];
            $eventStoreRequest->image_name = $_FILES['image']['name'];
            $eventStoreRequest->image_tmp = $_FILES['image']['tmp_name'];
            $eventStoreRequest->image_size = $_FILES['image']['size'];
            $eventStoreRequest->image_current = $_POST['image_current'];
            $eventStoreRequest->location = $_POST['location'];
            $eventStoreRequest->start_datetime = $_POST['start_datetime'];
            $eventStoreRequest->end_datetime = $_POST['end_datetime'];

            $this->eventService->updateEvent($eventStoreRequest);

            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
           echo $ex->getMessage();
        }
    }

    public function updateTicket()
    {
        try {

            $ticketStoreRequest1 = new TicketStoreRequest;
            $ticketStoreRequest1->id = $_POST['reguler_id'];
            $ticketStoreRequest1->price = $_POST['reguler_price'];
            $ticketStoreRequest1->stock = $_POST['reguler_stock'];
            $ticketStoreRequest1->description = $_POST['reguler_description'];
            
            $this->ticketService->updateTicket($ticketStoreRequest1);

            $ticketStoreRequest2 = new TicketStoreRequest;
            $ticketStoreRequest2->id = $_POST['vip_id'];
            $ticketStoreRequest2->price = $_POST['vip_price'];
            $ticketStoreRequest2->stock = $_POST['vip_stock'];
            $ticketStoreRequest2->description = $_POST['vip_description'];
            
            $this->ticketService->updateTicket($ticketStoreRequest2);

            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function delete()
    {
        try{
            $id = $_GET['id'];
            $this->eventService->deleteEvent($id);
            $this->ticketService->deleteTicket($id);
            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
