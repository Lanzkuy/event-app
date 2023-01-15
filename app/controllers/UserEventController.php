<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Services\UserEventService;
use App\Services\CategoryService;
use App\Models\TicketStoreRequest;
use App\Services\UserTicketService;
use App\Models\UserEventStoreRequest;

class UserEventController extends Controller
{
    private UserEventService $userEventService;
    private CategoryService $categoryService;
    private UserTicketService $userTicketService;

    public function __construct()
    {
        $this->userEventService = $this->service('UserEvent');
        $this->categoryService = $this->service('Category');
        $this->userTicketService = $this->service('UserTicket');
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
            $events = $this->userEventService->findEvent($search, $position, $limit);
        }else{
            $events = $this->userEventService->getEvents($position, $limit);
        }

        $row = $this->userEventService->paginateEvent($search);
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
            $eventStoreRequest = new UserEventStoreRequest;
            $eventStoreRequest->category_id = $_POST['category_id'];
            $eventStoreRequest->title = $_POST['title'];
            $eventStoreRequest->description = $_POST['description'];
            $eventStoreRequest->image_name = $_FILES['image']['name'];
            $eventStoreRequest->image_tmp = $_FILES['image']['tmp_name'];
            $eventStoreRequest->image_size = $_FILES['image']['size'];
            $eventStoreRequest->location = $_POST['location'];
            $eventStoreRequest->start_datetime = $_POST['start_datetime'];
            $eventStoreRequest->end_datetime = $_POST['end_datetime'];

            $eventId = $this->userEventService->storeEvent($eventStoreRequest);

            $ticketStoreRequest1 = new TicketStoreRequest;
            $ticketStoreRequest1->event_id = $eventId;
            $ticketStoreRequest1->price = $_POST['reguler_price'];
            $ticketStoreRequest1->stock = $_POST['reguler_stock'];
            $ticketStoreRequest1->type = 'Reguler';
            $ticketStoreRequest1->description = $_POST['reguler_description'];
            
            $this->userTicketService->storeTicket($ticketStoreRequest1);

            $ticketStoreRequest2 = new TicketStoreRequest;
            $ticketStoreRequest2->event_id = $eventId;
            $ticketStoreRequest2->price = $_POST['vip_price'];
            $ticketStoreRequest2->stock = $_POST['vip_stock'];
            $ticketStoreRequest2->type = 'VIP';
            $ticketStoreRequest2->description = $_POST['vip_description'];
            
            $this->userTicketService->storeTicket($ticketStoreRequest2);

            header('Location: ' . BASE_URL . '/userevent');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function edit()
    {
        try{
            $id = $_GET['id'];
            $event = $this->userEventService->getEvent($id);
            $categories = $this->categoryService->getAllCategory();

            $ticketReguler = $this->userTicketService->getTicketByType('Reguler', $id);
            $ticketVIP = $this->userTicketService->getTicketByType('VIP', $id);

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
            $eventStoreRequest = new UserEventStoreRequest;
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

            $this->userEventService->updateEvent($eventStoreRequest);

            header('Location: ' . BASE_URL . '/userevent');

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
            
            $this->userTicketService->updateTicket($ticketStoreRequest1);

            $ticketStoreRequest2 = new TicketStoreRequest;
            $ticketStoreRequest2->id = $_POST['vip_id'];
            $ticketStoreRequest2->price = $_POST['vip_price'];
            $ticketStoreRequest2->stock = $_POST['vip_stock'];
            $ticketStoreRequest2->description = $_POST['vip_description'];
            
            $this->userTicketService->updateTicket($ticketStoreRequest2);

            header('Location: ' . BASE_URL . '/userevent');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function delete()
    {
        try{
            $id = $_GET['id'];
            $this->userEventService->deleteEvent($id);
            $this->userTicketService->deleteTicket($id);
            header('Location: ' . BASE_URL . '/userevent');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}