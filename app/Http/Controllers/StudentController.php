<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\CreateRequest;
use App\Http\Requests\Student\DeleteRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\UniversityCollective;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public UniversityCollective $collective;

    public function __construct(UniversityCollective $collective)
    {
        $this->collective = $collective;
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $request->request->add(['type_id' => UniversityCollective::STUDENT]);
        $newStudent = UniversityCollective::create($request->all());

        return response()->json($newStudent);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $student = $this->collective->updateUniversityCollective(
                $this->collective::STUDENT,
                $request->student_id,
                $request->validated()
            );

        return response()->json($student);
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $students = $this->collective->searchCollective(
                $this->collective::STUDENT,
                $request->search_query
            );

        return response()->json($students);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $deleted = $this->collective->deleteUniversityCollective(
                $this->collective::STUDENT,
                $request->student_id
            );

        return response()->json(['success' => $deleted]);
    }
}
