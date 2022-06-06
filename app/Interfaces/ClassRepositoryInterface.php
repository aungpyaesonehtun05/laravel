<?php

namespace App\Interfaces;

interface ClassRepositoryInterface

{
    public function getAllClasses();
    public function getClassesById($classId);
    public function deleteClasses($classId);
    public function createClasses(array $classDetails);
    public function updateClasses($classId, array $newDetails);
    public function getFulfilledClasses();
}

?>