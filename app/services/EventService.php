<?php

namespace App\Services;

use App\Exceptions\InputValidationException;
use App\Exceptions\ServiceManagementException;
use App\Models\EventStoreRequest;
use App\Models\Event;
use App\Repositories\EventRepository;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function validateUploadImage(EventStoreRequest $request, string $imageFileType, string $target_file): void
    {
        if ($request->image_size > 200000) {
            throw new InputValidationException('Image too large.');
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            throw new InputValidationException('Image type not allowed.');
        }

        if (!move_uploaded_file($request->image_tmp, $target_file)) {
            throw new InputValidationException('Upload image error.');
        }
    }

    public function validateEventStoreRequest(EventStoreRequest $request): void
    {
        if ($request->category_id == 0) {
            throw new InputValidationException('Category must be selected.');
        }

        if (empty(trim($request->title))) {
            throw new InputValidationException('Title must be filled.');
        }

        if (empty(trim($request->description))) {
            throw new InputValidationException('Description must be filled.');
        }

        if (empty(trim($request->image_name))) {
            throw new InputValidationException('Image must be selected.');
        }

        if (empty(trim($request->location))) {
            throw new InputValidationException('Location must be filled.');
        }

        if (empty(trim($request->start_datetime))) {
            throw new InputValidationException('Start Date Time must be selected.');
        }

        if (empty(trim($request->end_datetime))) {
            throw new InputValidationException('End Date Time must be selected.');
        }
    }

    public function validateEventUpdateRequest(EventStoreRequest $request): void
    {
        if ($request->category_id == 0) {
            throw new InputValidationException('Category must be selected.');
        }

        if (empty(trim($request->title))) {
            throw new InputValidationException('Title must be filled.');
        }

        if (empty(trim($request->description))) {
            throw new InputValidationException('Description must be filled.');
        }

        if (empty(trim($request->location))) {
            throw new InputValidationException('Location must be filled.');
        }

        if (empty(trim($request->start_datetime))) {
            throw new InputValidationException('Start Date Time must be selected.');
        }

        if (empty(trim($request->end_datetime))) {
            throw new InputValidationException('End Date Time must be selected.');
        }
    }

    public function storeEvent(EventStoreRequest $request): bool
    {
        $time = time();

        $this->validateEventStoreRequest($request);
        $this->uploadImage($request, $time);

        $event = new Event;
        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->image = $time . strtolower($request->image_name);
        $event->location = $request->location;
        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;

        $store = $this->eventRepository->store($event);

        if (is_null($store)) {
            throw new ServiceManagementException('Failed to store event');
        }

        return $store;
    }

    public function getEvent(int $id): ?Event
    {
        $event = $this->eventRepository->get('id', $id);

        if (is_null($event)) {
            throw new ServiceManagementException('Event not found');
        }

        return $event;
    }

    public function getEvents(int $position, int $limit): array
    {
        return $this->eventRepository->getAll($position, $limit);
    }

    public function findEvent(string $title, int $position, int $limit): array
    {
        return $this->eventRepository->find($title, $position, $limit);
    }

    public function updateEvent(EventStoreRequest $request): bool
    {
        $time = time();

        $this->validateEventUpdateRequest($request);

        if (empty(trim($request->image_name))) {
            $image = $request->image_current;
        } else {
            $this->uploadImage($request, $time);
            $image = $time . $request->image_name;
        }

        $event = new Event;
        $event->id = $request->id;
        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->image = strtolower($image);
        $event->location = $request->location;
        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;

        $update = $this->eventRepository->update($event);

        if (is_null($update)) {
            throw new ServiceManagementException('Failed to update event');
        }

        return $update;
    }

    public function deleteEvent(int $id): bool
    {
        $delete = $this->eventRepository->delete($id);

        if (is_null($delete)) {
            throw new ServiceManagementException('Failed to delete event');
        }

        return $delete;
    }

    public function uploadImage(EventStoreRequest $request, int $time): void
    {
        $target_dir = BASE_URL . '/assets/img/events/';
        $target_file = $target_dir . basename($time . strtolower($request->image_name));
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $this->validateUploadImage($request, $imageFileType, $target_file);
    }

    public function paginateEvent(?string $title): int
    {
        return $this->eventRepository->paginate($title);
    }
}
