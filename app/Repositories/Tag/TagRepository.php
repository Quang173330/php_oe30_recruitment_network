<?php

namespace App\Repositories\Tag;

use App\Repositories\BaseRepository;
use App\Models\Tag;
use Auth;
use PhpParser\Node\Stmt\TryCatch;
use DB;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function getModel()
    {
        return Tag::class;
    }
    public function getTagByUser($user)
    {
        return $user->tags;
    }
}