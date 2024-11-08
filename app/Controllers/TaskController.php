<?php

namespace App\Controllers;

use App\Models\TaskModel;

use CodeIgniter\HTTP\Response;

class TaskController extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        return view('tasks/index');
    }

    public function getTasks()
    {
        $tasks = $this->taskModel->findAll();
        return $this->response->setJSON(['data' => $tasks]);
    }

    public function create()
    {
        $judul = $this->request->getPost('judul');

        if ($judul) {
            $this->taskModel->save(['judul' => $judul, 'status' => 0]);
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function update($id)
    {
        $data = $this->request->getPost();
        if ($this->taskModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function delete($id)
    {
        $this->taskModel->delete($id);
        return $this->response->setJSON(['success' => true]);
    }
}
