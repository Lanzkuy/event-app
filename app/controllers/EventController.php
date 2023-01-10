<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Models\EventStoreRequest;
use App\Services\EventService;
use App\Services\CategoryService;

class EventController extends Controller
{
    private EventService $eventService;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->eventService = $this->service('Event');
        $this->categoryService = $this->service('Category');
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
            $events = $this->eventService->getEvent($position, $limit);
        }

        $categoryName = array();

        foreach($events as $event)
        {
            $categoryName[] = $this->categoryService->getCategory($event['category_id']);
        }

        $row = $this->eventService->paginateEvent($search);
        $numberOfPages = ceil($row / $limit);

        $data['events'] = $events;
        $data['categoryName'] = $categoryName;
        $data['numberOfPages'] = $numberOfPages;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['title'] = 'Event';

        $this->view('templates/header', $data);
        $this->view('admin/events/index', $data);
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

            $this->eventService->storeEvent($eventStoreRequest);
            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function edit()
    {
        try{
            $id = $_GET['id'];
            $event = $this->eventService->editEvent($id);
            $categories = $this->categoryService->getAllCategory();
            $category = $this->categoryService->getCategory($event['category_id']);

            $data['categories'] = $categories;
            $data['category'] = $category;
            $data['event'] = $event;
            $data['title'] = 'Edit Event';

            $this->view('templates/header', $data);
            $this->view('user/event/edit', $data);
            $this->view('templates/footer');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update()
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

    public function delete()
    {
        try{
            $id = $_GET['id'];
            $this->eventService->deleteEvent($id);
            header('Location: ' . BASE_URL . '/event');

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
