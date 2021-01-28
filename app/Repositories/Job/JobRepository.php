<?php

namespace App\Repositories\Job;

use App\Repositories\BaseRepository;
use App\Models\Job;
use App\Models\Tag;
use Auth;
use PhpParser\Node\Stmt\TryCatch;
use DB;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function getModel()
    {
        return Job::class;
    }

    public function getAllJob()
    {
        $allJobs = $this->model->where('status', config('job_config.approve'))->with('images')->orderBy('created_at', 'desc')->paginate(config('job_config.paginate'));
        foreach ($allJobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }
        return $allJobs;
    }

    public function getAllTag()
    {
        return Tag::all();
    }

    public function appliedJobs($user)
    {
        return $user->jobs()->where('applications.status', config('job_config.waiting'))->get();
    }

    public function getTagByUser($user)
    {
        return $user->tags;
    }

    public function getSuitableJobs($tags)
    {

        $suitableJobsId = DB::table('jobs')
            ->join('taggables', 'jobs.id', '=', 'taggables.taggable_id')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->select('jobs.id')
            ->where('status', config('job_config.approve'))
            ->whereIn('tags.id', $tags)
            ->where('taggable_type', $this->model)
            ->groupBy('jobs.id')
            ->havingRaw('count(jobs.id)=' . count($tags))
            ->get()->pluck('id');

        $suitableJobs = $this->model->with('images')->whereIn('id', $suitableJobsId)->orderBy('created_at', 'desc')->get();

        foreach ($suitableJobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }

        return $suitableJobs;
    }

    public function addTagToJob($job, $tags)
    {
        return $job->tags()->attach($tags);
    }
}
