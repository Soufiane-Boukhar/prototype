<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TaskRepository;
use App\Repository\ProjectRepository;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TaskExport;
use App\Imports\ImportTask;
use App\Http\Controllers\AppBaseController;


class TaskController extends AppBaseController
{
    protected $TaskRepository;

    public function __construct(TaskRepository $TaskRepository, ProjectRepository $ProjectRepository){
        $this->TaskRepository = $TaskRepository;
        $this->ProjectRepository = $ProjectRepository;

    }


    public function index(Request $request, $id)
    {
        $projects = $this->ProjectRepository->getData();
        $project = $this->ProjectRepository->find($id);

        $tasksQuery = $project->tasks();

        if ($request->ajax()) {
            
            $searchTask = $request->get('searchTask');
            $searchTask = str_replace(" ", "%", $searchTask);

            $tasksQuery->where(function ($query) use ($searchTask) {
                $query->where('name', 'like', '%' . $searchTask . '%')
                    ->orWhere('description', 'like', '%' . $searchTask . '%');
            });

            $tasks = $tasksQuery->paginate(3);

            return view('task.search', compact('tasks', 'project'))->render();
        }

        $tasks = $tasksQuery->paginate(3);

        return view('task.index', compact('tasks', 'project', 'projects'));
    }


    
    

    public function create($id){
        $project = $this->ProjectRepository->find($id);
        return view('task.create',compact('project'));
    }

    public function store(Request $request){

        $data = $request->all();

        $tasks = $this->TaskRepository->create($data);
    
        return back()->with('success','Task added successfully.');
    }
    

    public function edit($id, $task_id){

        $task = $this->TaskRepository->find($task_id);

        $project = $this->ProjectRepository->find($id);

        return view('task.edit',compact('task','project'));

    }

    public function update(Request $request, $id, $task_id){
        $data = $request->all();
        $task = $this->TaskRepository->update($data, $task_id);
        return back()->with('success','Task updated successfully.');
    }
    

    public function destroy($id, $task_id)
    {
        $result = $this->TaskRepository->destroy($task_id);

        if ($result) {
            return back()->with('success', 'Task has been removed successfully.');
        } else {
            return back()->with('error', 'Failed to remove task. Please try again.');
        }
    }


    public function export()
    {
        return Excel::download(new TaskExport, 'Task.xlsx');
    }

    public function import(Request $request)
    {
       
        $file = $request->file('file');
        
        if ($file) {
            $path = $file->store('files');
            Excel::import(new ImportTask, $path);
        }
        
        return redirect()->back();
    }
    
}