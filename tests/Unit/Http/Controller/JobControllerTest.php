<?php

namespace Tests\Unit\Http\Controller;

use Tests\TestCase;
use Mockery;
use App\Models\User;
use App\Models\Tag;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Controllers\JobController;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Policies\JobPolicy;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class JobControllerTest extends TestCase
{
    protected $jobMock, $jobController, $policy;

    public function setUp(): void
    {
        parent::setUp();
        $this->jobMock = Mockery::mock(JobRepositoryInterface::class)->makePartial();
        $this->jobController = new JobController($this->jobMock);
        $this->policy = Mockery::mock(JobPolicy::class)->makePartial();
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->JobController);
        parent::tearDown();
    }

    public function test_success_apply()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $this->be($user);
        $job = factory(Job::class)->make();
        $job->id = 50;
        $this->jobMock->shouldReceive('apply')->withAnyArgs($job->id, $user->id);
        $controller = $this->jobController->apply($job->id);
        $this->assertEquals(redirect()->route('show_apply_list'), $controller);
    }

    public function test_success_cancel_apply()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $this->be($user);
        $job = factory(Job::class)->make();
        $job->id = 50;
        $this->jobMock->shouldReceive('cancelApply')->withAnyArgs($job->id, $user->id);
        $controller = $this->jobController->cancelApply($job->id);
        $this->assertEquals(redirect()->route('show_apply_list'), $controller);
    }

    public function test_show_apply_list()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $this->be($user);
        $job = factory(Job::class)->make();
        $job->id = 50;
        $this->jobMock->shouldReceive('applyJobs')->withAnyArgs($user);
        $controller = $this->jobController->showApplyList();
        $this->assertEquals('apply_list', $controller->getName());
        $this->assertArrayHasKey('jobs', $controller->getData());
    }

    public function test_show_candidate_list()
    {
        $user = factory(User::class)->make();
        $user->fakingRelations = true;
        $company = factory(Company::class)->make();
        $company1 = factory(Company::class)->make();
        $user->id = 10;
        $user->role_id = 2;
        $this->be($user);
        $this->actingAs($user);
        $job = factory(Job::class)->make();
        $job->id = 50;
        $user->setRelation('company', $company);
        $job->setRelation('company', $company1);
        $this->expectException(AuthorizationException::class);
        $this->policy->shouldReceive('update')->with($user, $job)->andReturn(true);
        $this->jobMock->shouldReceive('getJob')->with($job->id)->andReturn($job);
        $this->jobMock->shouldReceive('showListCandidateApply')->with($job);
        $controller = $this->jobController->showListCandidateApply($job->id);
        $controller->assertForbidden();
    }

    public function test_show_candidate_list_2()
    {
        $user = factory(User::class)->make();
        $user->fakingRelations = true;
        $company = factory(Company::class)->make();
        $user->id = 10;
        $user->role_id = 2;
        $this->be($user);
        $this->actingAs($user);
        $job = factory(Job::class)->make();
        $job->id = 50;
        $user->setRelation('company', $company);
        $job->setRelation('company', $company);
        $this->policy->shouldReceive('update')->with($user, $job)->andReturn(true);
        $this->jobMock->shouldReceive('getJob')->with($job->id)->andReturn($job);
        $this->jobMock->shouldReceive('showListCandidateApply')->with($job);
        $controller = $this->jobController->showListCandidateApply($job->id);
        $this->assertEquals('candidate', $controller->getName());
        $this->assertArrayHasKey('job', $controller->getData());
        $this->assertArrayHasKey('users', $controller->getData());
    }


    public function test_index()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $tags = factory(Tag::class, 10)->make();
        $tagsOfUser = factory(Tag::class, 10)->make();
        $this->jobMock->shouldReceive('getAllJob');
        $this->jobMock->shouldReceive('getAllTag')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->withAnyArgs($user);
        $this->jobMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_index_user()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $this->be($user);
        $tags = factory(Tag::class, 10)->make();
        $tagsOfUser = factory(Tag::class, 10)->make();
        $this->jobMock->shouldReceive('getAllJob');
        $this->jobMock->shouldReceive('getAllTag')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->withAnyArgs($user);
        $this->jobMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_index_user_1()
    {
        $user = factory(User::class)->make();
        $user->id = 10;
        $this->be($user);
        $tags = factory(Tag::class, 10)->make();
        $tagsOfUser = factory(Tag::class, 3)->make();
        foreach ($tagsOfUser as $tag) {
            $tag->type = 3;
        }
        $this->jobMock->shouldReceive('getAllJob');
        $this->jobMock->shouldReceive('getAllTag')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->with($user);
        $this->jobMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_history()
    {
        $user = factory(User::class)->make();
        $user->role_id = 2;
        $this->be($user);
        $jobs = factory(Job::class, 10)->make();
        $this->jobMock->shouldReceive('showHistoryCreateJob')->andReturn($jobs);
        $controller = $this->jobController->showHistoryCreateJob();
        $this->assertEquals('job_history', $controller->getName());
        $this->assertArrayHasKey('jobs', $controller->getData());
    }

    public function test_accept()
    {
        $user = factory(User::class)->make();
        $user->fakingRelations = true;
        $company = factory(Company::class)->make();
        $user->role_id = 2;
        $this->be($user);
        $this->actingAs($user);
        $job = factory(Job::class)->make();
        $user->setRelation('company', $company);
        $job->setRelation('company', $company);
        $job->id=2;
        $user->id=2;
        $this->jobMock->shouldReceive('find')->with($job->id)->andReturn($job);
        $this->jobMock->shouldReceive('acceptOrReject')->with($job,$user->id,2);
        try {
            $controller = $this->jobController->acceptOrReject($user->id,$job->id,2);
        } catch (\Throwable $th) {
            dd($th);
        }
        // dd($controller->getTargetUrl());
        $this->assertEquals(route('list_candidate',['id' => $job->id]), $controller->getTargetUrl());
        // $this->assertArrayHasKey('id', $controller->getData());
    }
}
