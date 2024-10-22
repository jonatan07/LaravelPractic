<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassroomController extends Controller
{
    /**
     *   @OA\get
     *     (
     *     path="/api/classroom/{idSchool}",
     *     summary="Obtener las aulas de las escuelas",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *         in="path",
     *         name="idSchool",
     *         required=true,
     *     @OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Listado de aulas"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function get($idSchool)
    {
        $teacher = Classroom::bySchool($idSchool)->get();
        //var_dump($teacher);
        if(!$teacher)
        {
            return response()->json(['message'=>'No hay aula para la escuela que busca'],404);
        }
        return response()->json($teacher,200);
    }
    /**
     * @OA\post(
     *     path="/api/classroom",
     *     summary="crear una aula",
     *     tags={"Aula"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear una aula",
     *         @OA\JsonContent(
     *             required={"name", "chairsAvailable","schoolId","teacherId"},
     *             @OA\Property(property="name", type="string", example="A1"),
     *             @OA\Property(property="chairsAvailable", type="interger", example=2),
     *             @OA\Property(property="schoolId", type="interger", example=1),
     *             @OA\Property(property="teacherId", type="interger", example=1),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crea una aula"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     ),
     *  )
     */
    public function create(Request $request)
    {
        $classroom = Classroom::create([
                'name' => $request->name,
                'chairsAvailable'=> $request->chairsAvailable,
                'school_id'=> $request->schoolId,
                'teacher_id'=> $request->teacherId
        ]);
       if(!$classroom)
       {
           $data = [
                'message'=> 'Error al crear una aula',
                'status'=> 500
           ];
           return response()->json($data,500);
       }

       $data = [
            'classroom'=> $classroom,
            'status'=> 201
       ];

       return response()->json($data,201);
    }
    /**
     *   @OA\delete
     *     (
     *     path="/api/classroom/{id}",
     *     summary="eliminar una aula",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Un Profesor"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function delete($id)
    {
        $teacher = Classroom::find($id);
        if(!$teacher)
        {
            return response()->json(['message'=>'No hay aula'],404);
        }
        $teacher->delete();
        $data = [
            'message' => 'Profesor eliminada',
            'status' => 200
        ];
        return response()->json($data,200);
    }
    /**
     *   @OA\put
     *     (
     *     path="/api/classroom/{id}",
     *     summary="actualizar una aula",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para actualizar una aula",
     *         @OA\JsonContent(
     *             required={"name", "lastName"},
     *             @OA\Property(property="name", type="string", example="Jose"),
     *             @OA\Property(property="lastName", type="string", example="Encarnacion"),
     *             )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Una aula"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function update(Request $request,$id)
    {
       $teacher = Classroom::findOrFail($id);
     
       if(!$teacher)
       {
           return response()->json(['No se encontro la aula']);
       }
        
        $teacher->name = $request->name;
        $teacher->lastName = $request->lastName;

        $teacher->save();
        $data = [
            'aula'=> $teacher,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}
