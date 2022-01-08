<?php

namespace App\Interfaces;

interface BusInterface
{
    public function creates(array $data);
    public function edit(array $data);
    public function update(array $data);
    public function delete(array $data);
}


?>