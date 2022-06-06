<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Interfaces\ClassRepositoryInterface;
use PhpParser\Node\Scalar\MagicConst\Class_;

class ClassRepository implements ClassRepositoryInterface
{
    public function getAllClasses() 
    {
        return Classes::all();
    }

    public function getClassesById($classId) 
    {
        return Classes::findOrFail($classId);
    }

    public function deleteClasses($classId) 
    {
        Classes::destroy($classId);
    }

    public function createClasses(array $classDetails) 
    {
        return Classes::create($classDetails);
    }

    public function updateClasses($classId, array $newDetails) 
    {
        return Classes::whereId($classId)->update($newDetails);
    }

    public function getFulfilledClasses() 
    {
        return Classes::where('is_fulfilled', true);
    }

}
?>