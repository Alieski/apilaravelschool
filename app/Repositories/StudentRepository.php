<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    /**
     * @var Student 
     */
     protected $student;

     /**
      * Student Repository constructor
      *@param Student $student      
      */
      public function __construct(Student $student)
      {
        $this->student  = $student;
      }


      /**
     * Get all student.
     *
     * @return Student $student
     */
    public function getAll()
    {
        return $this->student->get();
    }

      /**
     * Save Student
     *
     * @param $data
     * @return Student
     */
    public function save($data)
    {
        $student = new Student();

        $student->name = $data['name'];
        $student->email = $data['email'];

        $student->save();

        return $student->fresh();
    }

      /**
     * Get student by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {        
        return Student::with(['klass','klass.conferences'])        
        ->where('id', $id)
        ->get();   
    }

    /**
     * Update Student
     *
     * @param $data
     * @return Student
     */
    public function update($data, $id)
    {
        
        $student = $this->student->find($id);

        $student->name = $data['name']; 
        $student->class_id = $data['class'];       

        $student->update();

        return $student;
    }

    /**
     * Update Student
     *
     * @param $data
     * @return Student
     */
    public function delete($id)
    {        
        $student = $this->student->find($id);
        $student->delete();

        return $student;
    }

    /**
     * Update Student Class
     *
     * @param $data
     * @return Student
     */
    /*public function updateClass($data, $id)
    {
        
        $student = $this->student->find($id);

        $student->class_id = $data['class']; 
        //$student->email = $data['email'];       

        $student->update();

        return $student;
    }*/
}