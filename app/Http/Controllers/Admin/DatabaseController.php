<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exports\TableExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
   // public function database() {
   //    $tables = DB::select('SHOW TABLES');
   //    $database = env('DB_DATABASE');
   //    $key = "Tables_in_$database";

   //    // Step 1: Get all table names
   //    $tableNames = array_map(function ($table) use ($key) {
   //       return $table->$key;
   //    }, $tables);

   //    // Step 2: Define only the tables you want to keep
   //    $allowedTables = [
   //       'annual_salary',
   //       'candidate_profile',
   //       'companies',
   //       'currency',
   //       'custom_pages',
   //       'education',
   //       'job_applications',
   //       'interview_type',
   //       'job_category',
   //       'job_department',
   //       'job_role',
   //       'job_experience',
   //       'job_location',
   //       'job_mode',
   //       'job_post',
   //       'job_shift',
   //       'job_skill',
   //       'job_types',
   //       'jobs',
   //       'menu_items',
   //       'users',
   //    ];

   //    // Step 3: Filter the table names
   //    $tableNames = array_filter($tableNames, function ($name) use ($allowedTables) {
   //       return in_array($name, $allowedTables);
   //    });

   //       // dd($tableNames);

   //       return view('admin.Settings.database', compact('tableNames'));
   // }

   public function database()
   {
      $tables = DB::select('SHOW TABLES');
      $database = env('DB_DATABASE');
      $key = "Tables_in_$database";

      // Get all table names
      $tableNames = array_map(function ($table) use ($key) {
         return $table->$key;
      }, $tables);

      // Tables allowed for export
      $allowedTables = [
         'annual_salary',
         'candidate_profile',
         'companies',
         'currency',
         'custom_pages',
         'education',
         'job_applications',
         'interview_type',
         'job_category',
         'job_department',
         'job_role',
         'job_experience',
         'job_location',
         'job_mode',
         'job_post',
         'job_shift',
         'job_skill',
         'job_types',
         'jobs',
         'menu_items',
         'users',
      ];

      // Tables allowed for import (you can adjust this list)
      $importTables = [
         'annual_salary',
         'job_post',
         'companies',
         'job_skill',
         'job_location',
         'users',
      ];

      // Filter table names
      $exportTables = array_filter($tableNames, fn($name) => in_array($name, $allowedTables));
      $importTables = array_filter($tableNames, fn($name) => in_array($name, $importTables));

      return view('admin.Settings.database', [
         'exportTables' => $exportTables,
         'importTables' => $importTables,
      ]);
   }



   public function exportExcel($table)
   {
      return Excel::download(new TableExport($table), $table . '.xlsx');
   }

   public function exportCsv($table)
   {
      return Excel::download(new TableExport($table), $table . '.csv', \Maatwebsite\Excel\Excel::CSV);
   }
}
