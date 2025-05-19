<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
   // public function database() {
   
   //    $tables = DB::select('SHOW TABLES');

   //    $database = env('DB_DATABASE'); // Get current DB name
   //    $key = "Tables_in_$database";   // Column key depends on DB name

   //    $tableNames = array_map(function ($table) use ($key) {
   //       return $table->$key;
   //    }, $tables);

   //  dd($tableNames);
   //  return view('admin.Settings.database');
   // }



   
   public function database() {
      $tables = DB::select('SHOW TABLES');
      $database = env('DB_DATABASE');
      $key = "Tables_in_$database";

      // Step 1: Get all table names
      $tableNames = array_map(function ($table) use ($key) {
         return $table->$key;
      }, $tables);

      // Step 2: Define only the tables you want to keep
      $allowedTables = [
         'annual_salary',
         'candidate_profile',
         'companies',
         'currency',
         'custom_pages',
         'education',
         'job_applications',
         'interview_type',
         // Add more table names if needed
      ];

      // Step 3: Filter the table names
      $tableNames = array_filter($tableNames, function ($name) use ($allowedTables) {
         return in_array($name, $allowedTables);
      });

      return view('admin.Settings.database', compact('tableNames'));
   }

}
