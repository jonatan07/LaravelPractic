<?php

namespace App\Http\Controllers;

use App\Http\DTOs\PaginatorDTO;
use App\Models\Student;
use App\Http\DTOS\StudentDTO;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use Exception;



class StudentController extends Controller
{
    /**
     *   @OA\get
     *     (
     *     path="/api/students",
     *     summary="Obtener lista de estudiantes",
     *     security={{"token": {}}},
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="lastName",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="email",
     *         required=false
     *      ),
     *     @OA\Parameter(
     *         in="query",
     *         name="phone",
     *         required=false
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Una lista de estudiantes"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */

    public function getAll(Request $request)
    {
        try{
            $data =Student::name($request->name)->lastName($request->lastName)->email($request->email)->phone($request->phone)->paginate(15);
            $students = StudentResource::collection($data);
        }
        catch(Exception $e)
        {
            return response() -> json(
                $this->ErrorResponse($e->getMessage())
                ,500
            );
            
        }                         
        if(empty($students))
        {
            return response()->json(['message'=>'No hay estudiantes'],404);
        }
        
        return $this->successfullCollectionResponse(
            $students,
            $data->total(),
            $data->currentPage(),
            $data->lastPage()
        );
    }
    /**
     *   @OA\get
     *     (
     *     path="/api/student/{id}",
     *     summary="Obtener un estudiante",
     *     security={{"token": {}}},
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Una estudiante"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function get($id)
    {
        $student = Student::find($id);
        if(!$student)
        {
            return response()->json(['message'=>'No hay estudiantes'],404);
        }
        $response = new StudentResource($student);
        return $this->successfullResponse($response,"Estudiante encontrado");
    }
    /**
     *   @OA\post
     *     (
     *     path="/api/student",
     *     summary="crear un estudiante",
     *     security={{"token": {}}},
     *     tags={"Estudiante"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear un estudiante",
     *         @OA\JsonContent(
     *             required={"name", "lastName","email","phone","address"},
     *             @OA\Property(property="name", type="string", example="Clever"),
     *             @OA\Property(property="lastName", type="string", example="SantaMar"),
     *             @OA\Property(property="email", type="string", format="float", example="Test@gmail.com"),
     *             @OA\Property(property="phone", type="string", example="809-923-1234"),
     *             @OA\Property(property="address", type="string", example="Algun lugar del planeta")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crea un estudiante"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function create(Request $request)
    {
        try{
            $student = Student::create([
                'name' => $request->name,
                'lastName'=> $request->lastName,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'address'=> $request->address
            ]);

            return $this->successfullResponse(new StudentResource($student),201);
        }
        catch(Exception $ex)
        {
            return response() -> json(
                $this->ErrorResponse($ex->getMessage())
                ,500
            );
        }
    }
    /**
     *   @OA\delete
     *     (
     *     path="/api/student/{id}",
     *     summary="eliminar un estudiante",
     *     security={{"token": {}}},
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Una estudiante"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function delete($id)
    {
        try{
            $student = Student::find($id);
            if(!$student)
            {
                return response()->json(['message'=>'No hay estudiantes'],404);
            }
            $student->delete();
            return $this->successfullResponse(new StudentResource ($student),'Estudiante eliminado');
        }
        catch(Exception $ex)
        {
            return response() -> json(
                $this->ErrorResponse($ex->getMessage())
                ,500
            );
        }
    }
    /**
     *   @OA\put
     *     (
     *     path="/api/student/{id}",
     *     summary="actualizar un estudiante",
     *     security={{"token": {}}},
     *     tags={"Estudiante"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para actualizar un estudiante",
     *         @OA\JsonContent(
     *             required={"name", "lastName","email","phone","address"},
     *             @OA\Property(property="name", type="string", example="Laptop"),
     *             @OA\Property(property="lastName", type="string", example=1),
     *             @OA\Property(property="email", type="string", format="float", example=1200.50),
     *             @OA\Property(property="phone", type="string", example="Descripción opcional del producto"),
     *             @OA\Property(property="address", type="string", example="Descripción opcional del producto")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Una estudiante"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function update(Request $request,$id)
    {
        try
        {
            $student = Student::findOrFail($id);
            if(!$student)
            {
                return response()->json(['No se encontro al estudiante']);
            }
            $student->name = $request->name;
            $student->lastName = $request->lastName;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->save();
        
            return $this->successfullResponse(new StudentResource ($student),'Estudiante actualizado');
        }
        catch(Exception $ex)
        {
            return response() -> json(
                $this->ErrorResponse($ex->getMessage())
                ,500
            );
        }
    }
}
