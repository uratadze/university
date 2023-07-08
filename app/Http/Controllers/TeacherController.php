<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\CreateRequest;
use App\Http\Requests\Teacher\DeleteRequest;
use App\Http\Requests\Teacher\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\UniversityCollective;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{
    public UniversityCollective $collective;

    public function __construct(UniversityCollective $collective)
    {
        $this->collective = $collective;
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $request->request->add(['type_id' => UniversityCollective::TEACHER]);
        $newStudent = UniversityCollective::create($request->all());

        return response()->json($newStudent);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $student = $this->collective->updateUniversityCollective(
            $this->collective::TEACHER,
            $request->teacher_id,
            $request->all()
        );

        return response()->json($student);
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $students = $this->collective->searchCollective(
            $this->collective::TEACHER,
            $request->search_query
        );

        return response()->json($students);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $deleted = $this->collective->deleteUniversityCollective($this->collective::TEACHER, $request->teacher_id);

        return response()->json(['success' => $deleted]);
    }
}
