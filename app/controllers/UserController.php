<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserRegisterRequest;
use App\Services\UserService;
use Exception;
use Flasher;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = $this->service('User');
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['userData'] = $this->userService->getUsers();
        $this->view('templates/header', $data);
        $this->view('admin/users/index', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if (isset($_POST['email'])) {
            try {
                $userRegisterRequest = new UserRegisterRequest;
                $userRegisterRequest->email = $_POST['email'];
                $userRegisterRequest->password = $_POST['password'];
                $userRegisterRequest->confirm_password = $_POST['confirm_password'];
                $userRegisterRequest->name = $_POST['name'];
                $userRegisterRequest->role = $_POST['role'];

                $status = $this->userService->register($userRegisterRequest);

                if ($status) {
                    Flasher::setFlash('Create user success', 'success');
                } else {
                    Flasher::setFlash('Create user failed', 'danger');
                }
            } catch (Exception $ex) {
                Flasher::setFlash($ex->getMessage(), 'danger');
            }

            $this->back();
        }

        $this->view('admin/users/store');
    }

    public function edit(int $id)
    {
        try {
            $data['editData'] = $this->userService->getUser($id);
            $this->view('admin/users/edit', $data);
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }
    }

    public function update()
    {
        if (isset($_POST['email'])) {
            try {
                $userRegisterRequest = new UserRegisterRequest;
                $userRegisterRequest->id = $_POST['id'];
                $userRegisterRequest->email = $_POST['email'];
                $userRegisterRequest->name = $_POST['name'];
                $userRegisterRequest->role = $_POST['role'];

                $status = $this->userService->updateUser($userRegisterRequest);

                if ($status) {
                    Flasher::setFlash('Update user success', 'success');
                } else {
                    Flasher::setFlash('Update user failed', 'danger');
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
            $status = $this->userService->deleteUser($id);

            if ($status) {
                Flasher::setFlash('Delete user success', 'success');
            } else {
                Flasher::setFlash('Delete user failed', 'danger');
            }
        } catch (Exception $ex) {
            Flasher::setFlash($ex->getMessage(), 'danger');
        }

        $this->back();
    }

    public function getRowCount(): int
    {
        return $this->userService->getRowCount();
    }

    public function changePassword()
    {
        if (isset($_POST['old_password'])) {
            try {
                $status = $this->userService->changePassword($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password']);

                if ($status) {
                    Flasher::setFlash('Change password success', 'success');

                    echo "<script>location.href = '" . BASE_URL . "/dashboard/logout';</script>";
                } else {
                    Flasher::setFlash('Change password failed', 'danger');
                }
            } catch (Exception $ex) {
                Flasher::setFlash($ex->getMessage(), 'danger');
            }
        }

        $data['title'] = 'Change Password';
        $this->view('templates/header', $data);
        $this->view('admin/users/change-password', $data);
        $this->view('templates/footer');
    }

    private function back()
    {
        echo "<script>location.href = '" . BASE_URL . "/dashboard/admin/user';</script>";
        return;
    }
}
