<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use App\Models\Project;
use App\Exports\ProjectExport;
use App\Imports\ImportProject;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AppBaseController;

class ProjectController extends AppBaseController
{
    protected $ProjectRepository;

    public function __construct(ProjectRepository $ProjectRepository){
        $this->ProjectRepository = $ProjectRepository;
    }

    public function index(Request $request){
        $projects = $this->ProjectRepository->getData();

        if($request->ajax()){
            $searchProject = $request->get('searchProject');
            $searchProject = str_replace(" ", "%", $searchProject);
            $projects = Project::where(function ($query) use ($searchProject) {
                $query->where('name', 'like', '%' . $searchProject . '%')
                      ->orWhere('description','like','%'. $searchProject . '%');
            })
            ->paginate(3);
            return view('project.search', compact('projects'))->render();

        }


        return view('project.index', compact('projects'));
    }
    
    public function create(){
        return view('project.create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'name'=>'required',
            'description' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        $projects = $this->ProjectRepository->create($data);

        return redirect()->route('project.index')->with('success','Project added successfully.');

    }

    public function edit($id){
        $project = $this->ProjectRepository->find($id);

        return view('project.edit',compact('project'));

    }

    public function update(Request $request,$id){
        $data = $request->validate([
            'name'=>'required',
            'description' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        $projects = $this->ProjectRepository->update($data,$id);

        return back()->with('success','Project updated successfully.');

    }

    public function destroy($id){
        $result = $this->ProjectRepository->destroy($id);
    
        if ($result) {
            return redirect()->route('project.index')->with('success', 'Project has been removed successfully.');
        } else {
            return back()->with('error', 'Failed to remove project. Please try again.');
        }
    }

    public function export()
    {
        return Excel::download(new ProjectExport, 'Project.xlsx');
    }


    public function import(Request $request)
    {
        $file = $request->file('file');
        
        if ($file) {
            $path = $file->store('files');
            Excel::import(new ImportProject, $path);
        }
        
        return redirect()->back();
    }
    
}
