<?php

namespace App\Repositories\Tag;

use App\Repositories\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function getTagByUser($user);
}