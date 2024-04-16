<?php

namespace App\Service;

interface ServiceInterface{
    public function create(Object $object);
    public function update (Object $object);
    public function delete (int $id);
    public function findOneBy (int $id):Object;
    public function findAll ():array;
}