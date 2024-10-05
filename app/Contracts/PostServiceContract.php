<?php

namespace App\Contracts;

use App\Models\Post;
use Exception;

interface PostServiceContract
{
    /**
     * @throws Exception
     */
    public function show($id): array;

    public function update($data, $id): array;

    /**
     * @throws Exception
     */
    public function destroy($id): array;
}
