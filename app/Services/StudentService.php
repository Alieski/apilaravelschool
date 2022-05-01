<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class StudentService
{
    /**
     * @var StudentRepository 
     */
     protected $studentRepository;

     /**
      * StudentService constructor
      *@param StudentRepository $studentRepository      
      */
      public function __construct(StudentRepository $studentRepository)
      {
        $this->studentRepository  = $studentRepository;
      }

      /**
     * Get all student.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->studentRepository->getAll();
    }
    
    /**
     * Get student by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->studentRepository->getById($id);
    }
      
      
      /**
       * Validate Student Data
       * Store in DB if no errors
       * 
       * @param array data
       * @return string
       */
      public function saveStudentData($data)
      {
        $validator = Validator::make($data,[
            'name' => 'required|min:4',
            'email' => 'required|email|unique:students'
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->studentRepository->save($data);

        return $result;

      }

      /**
     * Delete student by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $student = $this->studentRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete student');
        }

        DB::commit();

        return $student;

    }

    /**
     * Update student data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateStudent($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:4',
            'class' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $student = $this->studentRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update student data');
        }

        DB::commit();

        return $student;

    }


    /**
     * Update student klass
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    /*public function updateStudentClass($data, $id)
    {
        $validator = Validator::make($data, [
            'class' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $student = $this->studentRepository->updateClass($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update student class');
        }

        DB::commit();

        return $student;

    }*/
    
}