<?php

namespace App\services\ManegMedia;

use App\Models\Project;

class ProjectWithMedia
{


    public static function all(array $status = ['1', '0'])
    {
        return (new self)->allProject($status);
    }

    private function allProject(array $status)
    {
        $projects = [];
        foreach ($this->getAll($status) as $project) {
            
            $projects[] = [
                "attributes" => $project,
                'media' => $this->getMedia($project)
            ];
            unset($project->media);
        }
        return $projects;
    }



    private function getAll(array $status)
    {
        return Project::whereIn('status', $status)->orderBy('priority' , 'ASC')->get();
    }

    private function getMedia(Project $project)
    {

        $media = [];
        foreach ($project->getMedia('projects') as $item) {
            $media[] = [
                "media_id" => $item->id,
                "path" => asset($item->getUrl())
            ];
        }

        return $media;
    }

    public static function first(Project|null $project)
    {
        if (!is_null($project)) {
            
            $data =  [
                'attributes' => $project,
                'media' => (new self)->getMedia($project)
            ];
            unset($project->media);
            return $data;
            
        }
        return false;
    }
}
