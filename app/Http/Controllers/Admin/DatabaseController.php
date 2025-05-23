<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\TableExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\AnnualSalaryImport;
use App\Imports\JobLocationImport;
use App\Imports\CurrencyImport;
use App\Imports\JobCategoryImport;
use App\Imports\SkillImport;

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
         'currency',
         'job_category',
         'job_skill',
         'job_location',
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

   // annual salary for admin area 
   public function AnnualSalaryBulkUpload()
   {
      return view('admin.Settings.AnnualSalaryBulk');
   }

   // annual salary import for admin area 
   public function AnnualSalarySubmit(Request $request)
   {
      $rules = [
         'annualSalary' => 'required|mimes:xlsx,csv,xls',
      ];

      $validate = Validator::make($request->all(), $rules);

      if (!$validate->fails()) {

         // Read and import directly without storing
         Excel::import(new AnnualSalaryImport, $request->file('annualSalary'));

         return response()->json(['status_code' => 1, 'message' => 'Annual Salary Imported Successfully']);
      } else {
         return response()->json(['status_code' => 0, 'message' => $validate->errors()->first()]);
      }
   }

   // Currency for admin area 
   public function CurrencyBulkUpload()
   {
      return view('admin.Settings.CurrencyBulkUpload');
   }

   // Currency import for admin area 
   public function CurrencySubmit(Request $request)
   {
      $rules = [
         'Currency' => 'required|mimes:xlsx,csv,xls',
      ];

      $validate = Validator::make($request->all(), $rules);

      if (!$validate->fails()) {

         // Read and import directly without storing
         Excel::import(new CurrencyImport, $request->file('Currency'));

         return response()->json(['status_code' => 1, 'message' => 'Currency Imported Successfully']);
      } else {
         return response()->json(['status_code' => 0, 'message' => $validate->errors()->first()]);
      }
   }


   // Job category for admin area 
   public function JobCategoryBulkUpload()
   {
      return view('admin.Settings.JobCategoryBulkUpload');
   }

   // Job category import for admin area 
   public function JobCategorySubmit(Request $request)
   {
      $rules = [
         'JobCategory' => 'required|mimes:xlsx,csv,xls',
      ];

      $validate = Validator::make($request->all(), $rules);

      if (!$validate->fails()) {

         // Read and import directly without storing
         Excel::import(new JobCategoryImport, $request->file('JobCategory'));

         return response()->json(['status_code' => 1, 'message' => 'Category Imported Successfully']);
      } else {
         return response()->json(['status_code' => 0, 'message' => $validate->errors()->first()]);
      }
   }

   // Job Location for admin area 
   public function JobLocationBulkUpload()
   {
     return view('admin.Settings.JobLocationBulkUpload');
   }

   // Job category import for admin area 
   public function JobLocationSubmit(Request $request)
   {
      $rules = [
         'JobLocation' => 'required|mimes:xlsx,csv,xls',
      ];

      $validate = Validator::make($request->all(), $rules);

      if (!$validate->fails()) {

         // Read and import directly without storing
         Excel::import(new JobLocationImport, $request->file('JobLocation'));

         return response()->json(['status_code' => 1, 'message' => 'Job Location Imported Successfully']);
      } else {
         return response()->json(['status_code' => 0, 'message' => $validate->errors()->first()]);
      }
   }


   // Job Location for admin area 
   public function JobSkillBulkUpload()
   {
      return view('admin.Settings.JobSkillBulkUpload');
   }


    // Job Location import for admin area 
   public function JobSkillSubmit(Request $request)
   {
      $rules = [
         'JobSkill' => 'required|mimes:xlsx,csv,xls',
      ];

      $validate = Validator::make($request->all(), $rules);

      if (!$validate->fails()) {

         // Read and import directly without storing
         Excel::import(new SkillImport, $request->file('JobSkill'));

         return response()->json(['status_code' => 1, 'message' => 'Job Skill Imported Successfully']);
      } else {
         return response()->json(['status_code' => 0, 'message' => $validate->errors()->first()]);
      }
   }


}
