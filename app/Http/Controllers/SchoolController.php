<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTracerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class SchoolController extends Controller
{
    public function getStudentTracer(Request $request)
    {
        $userId = $request->get('user_id');
        if(!$userId) {
            return response()->json([
                'code' => 400,
                'message' => 'Param user_id harus diinput'
            ], 400);
        }
        $rawQuery = '
            SELECT

                usr_edu.*,
                school.name as school_name,
                school.phone as school_phone,
                school.email as school_email,
                school.fax as school_fax,
                school.address as school_address,
                school.website as school_website,
                school.logo as school_logo,
                school.postal_code as school_postal_code,
                school.about as school_about,
                school.mission as school_mission,
                school.vision as school_vision,
                usr_degree.name as degree_name,
                usr_degree.translation as degree_translation,
                usr_major.name as major_name,
                usr_major.translation as major_translation,
                usr_tracer.name as tracer_name,
                usr_tracer.description as tracer_description,
                usr_tracer.target_start as tracer_target_start,
                usr_tracer.target_end as tracer_target_end,
                usr_tracer.publication_start as tracer_publication_start,
                usr_tracer.publication_end as tracer_publication_end

            FROM table_user_education usr_edu
            JOIN table_school school ON usr_edu.school_id = school.id
            JOIN table_user_education_degree usr_degree ON usr_edu.degree_id = usr_degree.id
            JOIN table_user_education_major usr_major ON usr_edu.major_id = usr_major.id
            LEFT OUTER JOIN table_user_tracer_study usr_tracer ON school.id = usr_tracer.school_id
            WHERE usr_edu.user_id = {$userId}
            LIMIT 1
        ';
        $stringQuery = strtr($rawQuery, ['{$userId}' => $userId]);

        $query = DB::select($stringQuery);
        return count($query) ? new UserTracerResource($query[0]) : 
        response()->json([], 200);
    }

    // API Get Student Tarcer List
    public function getStudentTracerList()
    {
        $stringQuery = '
            SELECT
                DISTINCT
                usr_edu.*,
                school.name as school_name,
                school.phone as school_phone,
                school.email as school_email,
                school.fax as school_fax,
                school.address as school_address,
                school.website as school_website,
                school.logo as school_logo,
                school.postal_code as school_postal_code,
                school.about as school_about,
                school.mission as school_mission,
                school.vision as school_vision,
                usr_degree.name as degree_name,
                usr_degree.translation as degree_translation,
                usr_major.name as major_name,
                usr_major.translation as major_translation,
                usr_tracer.name as tracer_name,
                usr_tracer.description as tracer_description,
                usr_tracer.target_start as tracer_target_start,
                usr_tracer.target_end as tracer_target_end,
                usr_tracer.publication_start as tracer_publication_start,
                usr_tracer.publication_end as tracer_publication_end

            FROM table_user_education usr_edu
            JOIN table_school school ON usr_edu.school_id = school.id
            JOIN table_user_education_degree usr_degree ON usr_edu.degree_id = usr_degree.id
            JOIN table_user_education_major usr_major ON usr_edu.major_id = usr_major.id
            LEFT JOIN table_user_tracer_study usr_tracer ON school.id = usr_tracer.school_id
            WHERE usr_tracer.school_id IS NOT NULL
        ';

        $query = DB::select($stringQuery);
        return UserTracerResource::collection($query)->collection;
    }
}
