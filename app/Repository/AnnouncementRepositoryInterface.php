<?php

namespace App\Repository;

interface AnnouncementRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($id);

    public function togglePublish($id);

    public function getForRole($role);
}
