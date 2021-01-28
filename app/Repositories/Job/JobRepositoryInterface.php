<?php

namespace App\Repositories\Job;

use App\Repositories\RepositoryInterface;

interface JobRepositoryInterface extends RepositoryInterface
{
    public function getAllJob();

    public function getAllTag();

    public function getTagByUser($user);

    public function appliedJobs($user);

    public function getSuitableJobs($tags);

    public function addTagToJob($job,$tags);
}