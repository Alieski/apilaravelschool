<?php

namespace App\Repositories;

use App\Models\Klass;

class KlassRepository
{
    /**
     * @var Klass 
     */
     protected $klass;

     /**
      * Klass Repository constructor
      *@param Klass $klass      
      */
      public function __construct(Klass $klass)
      {
        $this->klass  = $klass;
      }


      /**
     * Get all klass.
     *
     * @return Klass $klass
     */
    public function getAll()
    {
        return $this->klass->get();
    }

      /**
     * Save Klass
     *
     * @param $data
     * @return Klass
     */
    public function save($data)
    {
        $klass = new Klass();

        $klass->name = $data['name'];

        $klass->save();

        return $klass->fresh();
    }

      /**
     * Get klass by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Klass::with(['students'])        
        ->where('id', $id)
        ->get(); 
    }

    /**
     * Update Klass
     *
     * @param $data
     * @return Klass
     */
    public function update($data, $id)
    {
        
        $klass = $this->klass->find($id);

        $klass->name = $data['name'];        

        $klass->update();

        return $klass;
    }

    /**
     * Update Klass
     *
     * @param $data
     * @return Klass
     */
    public function delete($id)
    {        
        $klass = $this->klass->find($id);
        $klass->delete();

        return $klass;
    }
}