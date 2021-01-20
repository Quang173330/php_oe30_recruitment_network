<?php

namespace App\Repositories\Job;

use App\Repositories\RepositoryInterface;

interface JobRepositoryInterface extends RepositoryInterface
{
    public function getJob($id);

    public function apply($id, $id_user);

    public function cancelApply($id, $id_user);

    public function applyJobs($user);

    public function acceptOrReject($job, $userId, $status);

    public function showHistoryCreateJob($user);

    public function showListCandidateApply($job);

    public function getAllJob();

    public function getAllTag();

    public function getTagByUser($user);

    public function appliedJobs($user);

    public function getSuitableJobs($tags);

}
