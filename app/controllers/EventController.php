<?php

namespace App\Controllers;

use Exception;
use App\Core\Controller;
use App\Models\EventStoreRequest;
use App\Services\EventService;
use App\Services\CategoryService;
use App\Services\UserService;
use Flasher;

class EventController extends Controller
{
    private EventService $eventService;
    private CategoryService $categoryService;
    private UserService $userService;

    public function __construct()
    {
        $this->eventService = $this->service('Event');
        $this->categoryService = $this->service('Category');
        $this->userService = $this->service('User');
    }

    public function index()
    {
        $data['title'] = 'Event';
        $data['eventData'] = $this->eventService->getEvents();
        $this->view('templates/header', $data);
        $this->view('admin/events/index', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $data['categoryData'] = $this->categoryService->getAllCategory();
        $data['userData'] = $this->userService->getUsers();

        if (isset($_POST['title'])) {
            try {
                $eventStoreRequest = new EventStoreRequest;
                $eventStoreRequest->user_id = $_POST['category_id'];
                $eventStoreRequest->category_id = $_POST['category_id'];
                $eventStoreRequest->title = $_POST['title'];
                $eventStoreRequest->description = $_POST['description'];
                $eventStoreRequest->image_name = $_FILES['image']['name'];
                $eventStoreRequest->image_tmp = $_FILES['image']['tmp_name'];
                $eventStoreRequest->image_size = $_FILES['image']['size'];
                $eventStoreRequest->location = $_POST['location'];
                $eventStoreRequest->start_datetime = $_POST['start_datetime'];
                $eventStoreRequest->end_datetime = $_POST['end_datetime'];

                $status = $this->eventService->storeEvent($eventStoreRequest);

                if ($status) {
                    Flasher::setFlash('Create event success', 'success');
                } else {
                    Flasher::setFlash('Create event failed', 'danger');
                }
            } catch (Exception $ex) {
                Flasher::setFlash($ex->getMessage(), 'danger');
            }

            $this->back();
        }

        $this->view('admin/events/store', $data);
    }

    public function edit(int $id)
    {
        try {
            $data['categoryData'] = $this->categoryService->getAllCategory();
            $data['userData'] = $this->userService->getUsers();
            $data['editData'] = $this->eventService->getEvent($id);
            $this->view('admin/events/edit', $data);
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }
    }

    public function update()
    {
        if (isset($_POST['id'])) {
            try {
                $eventStoreRequest = new EventStoreRequest;
                $eventStoreRequest->id = $_POST['id'];
                $eventStoreRequest->user_id = $_POST['user_id'];
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

                $status = $this->eventService->updateEvent($eventStoreRequest);

                if ($status) {
                    Flasher::setFlash('Update event success', 'success');
                } else {
                    Flasher::setFlash('Update event failed', 'danger');
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
            $status = $this->eventService->deleteEvent($id);

            if ($status) {
                Flasher::setFlash('Delete event success', 'success');
            } else {
                Flasher::setFlash('Delete event failed', 'danger');
            }
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }

        $this->back();
    }

    private function back()
    {
        echo "<script>location.href = '" . BASE_URL . "/dashboard/admin/event';</script>";

        return;
    }
}
