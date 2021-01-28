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
use App\Repositories\Tag\TagRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Policies\JobPolicy;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class JobControllerTest extends TestCase
{
    protected $jobMock, $tagMock, $jobController, $policy;

    public function setUp(): void
    {
        parent::setUp();
        $this->jobMock = Mockery::mock(JobRepositoryInterface::class)->makePartial();
        $this->tagMock = Mockery::mock(TagRepositoryInterface::class)->makePartial();
        $this->jobController = new JobController($this->jobMock, $this->tagMock);
        $this->policy = Mockery::mock(JobPolicy::class)->makePartial();
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->JobController);
        parent::tearDown();
    }


    public function test_index_not_login()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $tags = factory(Tag::class, 10)->make();
        $tagsOfUser = factory(Tag::class, 10)->make();
        $this->jobMock->shouldReceive('getAllJob');
        $this->tagMock->shouldReceive('getAll')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->withAnyArgs($user);
        $this->tagMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_index_login_and_suitableJobs()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $this->be($user);
        $tags = factory(Tag::class, 10)->make();
        $tagsOfUser = factory(Tag::class, 10)->make();
        $this->jobMock->shouldReceive('getAllJob');
        $this->tagMock->shouldReceive('getAll')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->withAnyArgs($user);
        $this->tagMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_index_login_and_not_suitableJobs()
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
        $this->tagMock->shouldReceive('getAll')->andReturn($tags);
        $this->jobMock->shouldReceive('appliedJobs')->with($user);
        $this->tagMock->shouldReceive('getTagByUser')->withAnyArgs($user)->andReturn($tagsOfUser);
        $this->jobMock->shouldReceive('getSuitableJobs');
        $controller = $this->jobController->index();
        $this->assertEquals('listjob', $controller->getName());
    }

    public function test_create_authorized()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $user->role_id = 2;
        $this->be($user);
        $tags = factory(Tag::class, 3)->make();
        $company = factory(Company::class)->make();
        $company->id = 2;
        $user->setRelation('company', $company);
        $this->tagMock->shouldReceive('getAll')->andReturn($tags);
        $controller = $this->jobController->create();
        $this->assertEquals('create_job', $controller->getName());
    }

    public function test_create_unAuthorized()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $user->role_id = 1;
        $this->be($user);
        $tags = factory(Tag::class, 3)->make();
        $this->expectException(AuthorizationException::class);
        $this->tagMock->shouldReceive('getAll')->andReturn($tags);
        $controller = $this->jobController->create();
        $this->assertEquals('create_job', $controller->getName());
    }

    public function test_store_authorized()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $user->role_id = 2;
        $this->be($user);
        $job = factory(Job::class)->make();
        $company = factory(Company::class)->make();
        $company->id = 2;
        $user->setRelation('company', $company);
        $data = [
            "title" => "ferfe",
            "experience" => "rèè",
            "salary" => "ferfe",
            "tag" =>  [1, 2, 3],
            "description" => "<p>rfeferf</p>",
            "status" => "0",
            "company_id" => "2",
        ];
        $request = new Request($data);
        $this->jobMock->shouldReceive('create')->withAnyArgs($request)->andReturn($job);
        $this->jobMock->shouldReceive('addTagToJob')->withAnyArgs($request->tag);
        $controller = $this->jobController->store($request);
        // dd($controller);
        $this->assertEquals(route('history'), $controller->getTargetUrl());
    }

    public function test_store_unAuthorized()
    {
        $user = factory(User::class)->make();
        $user->id = 1;
        $user->role_id = 1;
        $this->be($user);
        $job = factory(Job::class)->make();
        $company = factory(Company::class)->make();
        $company->id = 2;
        $user->setRelation('company', $company);
        $data = [
            "title" => "ferfe",
            "experience" => "rèè",
            "salary" => "ferfe",
            "tag" =>  [1, 2, 3],
            "description" => "<p>rfeferf</p>",
            "status" => "0",
            "company_id" => "2",
        ];
        $request = new Request($data);
        $this->expectException(AuthorizationException::class);
        $this->jobMock->shouldReceive('create')->withAnyArgs($request)->andReturn($job);
        $this->jobMock->shouldReceive('addTagToJob')->withAnyArgs($request->tag);
        $controller = $this->jobController->store($request);
        // dd($controller);
        $this->assertEquals(route('history'), $controller->getTargetUrl());
    }
}
