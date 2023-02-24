<?php

namespace App\Http\Controllers\Apis\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Admin\Projects\DeleteProjectRequest;
use App\Http\Requests\Apis\Admin\Projects\StoreProjectRequest;
use App\Http\Requests\Apis\Admin\Projects\UpdateProjectRequest;
use App\Models\Project;
use App\services\ConvertToJson;
use App\services\ManegMedia\ProjectWithMedia;
use App\services\Slug\Generate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseData(['projects' => ProjectWithMedia::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->safe()->except('images', 'tools');
            $data['tools'] = ConvertToJson::convert($request->safe()->tools);
            $data['slug'] = Generate::generate($request->safe()->name);
            $project = Project::create($data);
            $project->uploadMuiltpaleMedia($request);
            DB::commit();
            return $this->responseData(['project' => $project], "Created Successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $project = Project::where('id', $id)->first();
            $data = ProjectWithMedia::first($project);
            if (is_array($data)) {
                DB::commit();
                return $this->responseData($data);
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in Database"]);
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $project = Project::where('id', $id)->first();
            if (!is_null($project)) {
                $data = $request->safe()->except('images', 'tools');
                $data['tools'] = ConvertToJson::convert($request->safe()->tools);
                $data['slug'] = Generate::generate($request->safe()->name);
                $project->update($data);
                if (isset($request->safe()->images)) {
                    $project->uploadMuiltpaleMedia($request);
                }
                DB::commit();
                return $this->responseData(['project' => $project], 'Update Successfully');
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in Database"]);
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $project = Project::where('id', $id)->first();
            if (!is_null($project)) {
                $project->delete();
                DB::commit();
                return $this->successMessage('Deleted Successfully');
            }
            return $this->errorMessage(['error' => "Id Number dosent exists in Database"]);
        } catch (\Exception $e) {
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }

    public function removeImg(DeleteProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $project = Project::where('id', $request->safe()->project_id)->first();
            if (!is_null($project)) {
                foreach ($project->getMedia('projects') as $item) {
                    if ($item->id == $request->safe()->media_id) {
                        $item->delete();
                        DB::commit();
                        return $this->successMessage('Image Deleted Successfully');
                    }
                }
            }

            return $this->errorMessage(['error' => "Prameters is invalid"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorMessage(['error' => $e->getMessage()]);
        }
    }
}
