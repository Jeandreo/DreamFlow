<?php

// GET PROJECTS

use App\Models\Project;

function projects() {
    $projects = Project::where('status', 1)->get();
    return $projects;
}