<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Job;
use App\Models\Company;
use DB;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class JobController extends Controller
{
    use WithoutMiddleware;
    protected $jobRepo;

    public function __construct(JobRepositoryInterface $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function index()
    {
        $allJobs = $this->jobRepo->getAllJob();
        $tags = $this->jobRepo->getAllTag();

        $skills = $tags->where('type', config('tag_config.skill'))->all();
        $langs = $tags->where('type', config('tag_config.language'))->all();
        $workingTimes = $tags->where('type', config('tag_config.working_time'))->all();
        if (Auth::check()) {
            $appliedJobs = $this->jobRepo->appliedJobs(Auth::user());
            $tags = array();
            $tagsOfUser = $this->jobRepo->getTagByUser(Auth::user());
            $tagSkill = $tagsOfUser->where('type', config('tag_config.skill'))->first();

            if ($tagSkill) {
                array_push($tags, $tagSkill->id);
            }

            $tagLang = $tagsOfUser->where('type', config('tag_config.language'))->first();

            if ($tagLang) {
                array_push($tags, $tagLang->id);
            }
            if (count($tags)) {
                $suitableJobs = $this->jobRepo->getSuitableJobs($tags);

                return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes', 'suitableJobs', 'appliedJobs'));
            }

            return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes', 'appliedJobs'));
        }

        return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes'));
    }

    public function create()
    {
        if ($this->authorize('create', Job::class)) {
            $skills = Tag::where('type', config('tag_config.skill'))->get();
            $langs = Tag::where('type', config('tag_config.language'))->get();
            $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();
            $companyId = Auth::user()->company->id;

            return view('create_job', [
                'skills' => $skills,
                'langs' => $langs,
                'workingTimes' => $workingTimes,
                'id' => $companyId,
            ]);
        }
    }

    public function store(Request $request)
    {
        if ($this->authorize('create', Job::class)) {
            $job = Job::create($request->all());
            $job->tags()->attach($request->tag);
            // Alert::success(trans('job.create_messeage'));

            return redirect()->route('history');
        }
    }

    public function show($id)
    {
        $job = Job::with('images')->findOrFail($id);
        $job->url = $job->images()->where('type', config('user.avatar'))->first()->url;
        $tag = $job->tags->where('type', config('tag_config.skill'))->first();
        if (is_null($tag)) {
            $similarJobs = Job::orderBy('created_at', 'desc')->with('tags')->get();
        } else {
            $similarJobs = $tag->jobs;
        }
        $jobCurrent = Job::where('id', $id)->get();
        $similarJobs = $similarJobs->diff($jobCurrent);
        if (Auth::check()) {
            $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();

            return view('job_detail', compact('similarJobs', 'appliedJobs', 'job'));
        }

        return view('job_detail', compact('similarJobs', 'job'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $skills = Tag::where('type', config('tag_config.skill'))->get();
            $langs = Tag::where('type', config('tag_config.language'))->get();
            $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();

            return view('edit_job', [
                'job' => $job,
                'skills' => $skills,
                'langs' => $langs,
                'workingTimes' => $workingTimes,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $job->update($request->all());
            $job->tags()->sync($request->tag);
            // Alert::success(trans('job.edit_messeage'));

            return redirect()->route('jobs.show', ['job' => $id]);
        }
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $job->tags()->detach();
            $job->delete();

            return redirect()->route('history');
        }
    }

    public function apply($id)
    {
        $user = Auth::user();
        $this->jobRepo->apply($id, $user->id);
        // Alert::success(trans('job.apply_messeage'));

        return redirect()->route('show_apply_list');
    }

    public function cancelApply($id)
    {
        $user = Auth::user();
        $this->jobRepo->cancelApply($id, $user->id);
        // Alert::success(trans('job.cancle_messeage'));

        return redirect()->route('show_apply_list');
    }

    public function showApplyList()
    {
        $applyJobs = $this->jobRepo->applyJobs(Auth::user());

        return view('apply_list', [
            'jobs' => $applyJobs,
        ]);
    }

    public function showListCandidateApply($id)
    {
        $job = $this->jobRepo->getJob($id);
        $this->authorize('update', $job);
        $users = $this->jobRepo->showListCandidateApply($job);
        return view('candidate', [
            'job' => $job,
            'users' => $users,
        ]);
    }

    public function showHistoryCreateJob()
    {
        $this->authorize('create', Job::class);
        $jobs = $this->jobRepo->showHistoryCreateJob(Auth::user());

        return view('job_history', [
            'jobs' => $jobs,
        ]);
    }

    public function acceptOrReject($userId, $jobId, $status)
    {
        // dd($userId,$jobId);
        $job = $this->jobRepo->find($jobId);
        $this->authorize('update', $job);
        $this->jobRepo->acceptOrReject($job, $userId, $status);

        return redirect()->route('list_candidate', ['id' => $jobId]);
    }

    public function filter(Request $request)
    {
        if (is_null($request->tag)) {
            $jobs = Job::where('status', config('job_config.approve'))->get();
            $appliedJobs = null;
            if (Auth::check()) {
                $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();
            }
            foreach ($jobs as $job) {
                $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
            }

            return view('layouts.filter_job', [
                'jobs' => $jobs,
                'appliedJobs' => $appliedJobs,
            ]);
        }
        $filterJobsId = DB::table('jobs')
            ->join('taggables', 'jobs.id', '=', 'taggables.taggable_id')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->select('jobs.id')
            ->where('status', config('job_config.approve'))
            ->whereIn('tags.id', $request->tag)
            ->where('taggable_type', Job::class)
            ->groupBy('jobs.id')
            ->havingRaw('count(jobs.id)=' . count($request->tag))
            ->get()->pluck('id');
        $filterJobs = Job::with('images')->whereIn('id', $filterJobsId)->get();

        foreach ($filterJobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }
        if (Auth::check()) {
            $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();

            return view('layouts.filter_job', [
                'appliedJobs' => $appliedJobs,
                'jobs' => $filterJobs,
            ]);
        }

        return view('layouts.filter_job', [
            'jobs' => $filterJobs,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->title) {
            $jobs = Job::where('status', config('job_config.approve'))->with('images')->where('title', 'LIKE', '%' . $request->title . '%')->get();

            foreach ($jobs as $job) {
                $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
            }

            return view('search_jobs', [
                'jobs' => $jobs,
            ]);
        }

        $companies = Company::with('images')->where('name', 'LIKE', '%' . $request->name . '%')->get();

        foreach ($companies as $company) {
            $company->url =  $company->images()->where('type', config('user.avatar'))->first()->url;
        }

        return view('search_company', [
            'companies' => $companies,
        ]);
    }

    public function findJobByTag($id)
    {
        $tag = Tag::findOrFail($id);
        $jobs = $tag->jobs->where('status', config('job_config.approve'))->paginate(config('job_config.paginate'));
        $tag = Auth::user()->tags->where('type', config('tag_config.skill'))->first();
        $suitableJobs = $tag->jobs->where('status', config('job_config.approve'))->get();
        if (is_null($tag)) {
            $suitableJobs = Job::orderBy('created_at', 'desc')->with('tags')->get();
        }
        $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();
        $skills = Tag::where('type', config('tag_config.skill'))->get();
        $langs = Tag::where('type', config('tag_config.language'))->get();
        $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();

        return view('listjob', [
            'allJobs' => $jobs,
            'suitableJobs' => $suitableJobs,
            'appliedJobs' => $appliedJobs,
            'skills' => $skills,
            'langs' => $langs,
            'workingTimes' => $workingTimes,
        ]);
    }
}
