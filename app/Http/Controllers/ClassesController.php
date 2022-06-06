<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Interfaces\ClassRepositoryInterface;
use App\Repositories\ClassRepository;

          /**
 * To create classroom data
 *
 * @author  aungpyaesonehtun
 * @create  06/06/2022
 * @param Request $request
 * @return Response object
 */

class ClassesController extends Controller
{

    private  $classRepository;
    public function __construct(ClassRepositoryInterface $classRepository)
    {
        $this->classRepository =$classRepository;
    }

    
    public function index()
    {
        return response()->json([
            'data' => $this->classRepository->getAllClasses()
        ],200);
    }

    public function store(Request $request)
    {
        $classDetails = $request-> only([
            'name',
            'limit'
        ]);

        return response()->json([
            'data' => $this->classRepository->createClasses($classDetails)
        ],
        Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $classId = $request->route('id');

        return response()->json([
            'data' => $this->classRepository->getClassesById($classId)
        ]);
    }

            /**
 * To update classroom data
 *
 * @author  aungpyaesonehtun
 * @create  06/06/2022
 * @param update $request,classID
 * @return Response object
 */

    public function update(Request $request, $classId)
    {
        $classDetails = $request->only([
            'name',
            'limit'
        ]);
        return response()->json([
            'data' => $this->classRepository->updateClasses($classId, $classDetails)
        ],200);
    }


            /**
 * To delete classroom data
 *
 * @author  aungpyaesonehtun
 * @create  06/06/2022
 * @param delete $id
 * @return Response object
 */

    public function delete($id)
    {
        $this->classRepository->deleteClasses($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
