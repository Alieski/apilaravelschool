<?php

namespace App\Services;

use App\Repositories\KlassRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KlassService
{
    /**
     * @var KlassRepository 
     */
     protected $klassRepository;

     /**
      * KlassService constructor
      *@param KlassRepository $klassRepository      
      */
      public function __construct(KlassRepository $klassRepository)
      {
        $this->klassRepository  = $klassRepository;
      }

      /**
     * Get all klass.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->klassRepository->getAll();
    }
    
    /**
     * Get klass by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->klassRepository->getById($id);
    }
      
      
      /**
       * Validate Klass Data
       * Store in DB if no errors
       * 
       * @param array data
       * @return string
       */
      public function saveKlassData($data)
      {
        $validator = Validator::make($data,[
            'name' => 'required|min:4|unique:klasses'
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->klassRepository->save($data);

        return $result;

      }

      /**
     * Delete klass by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $klass = $this->klassRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete class');
        }

        DB::commit();

        return $klass;

    }

    /**
     * Update klass data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateKlass($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:4|unique:klasses'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $klass = $this->klassRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update class data');
        }

        DB::commit();

        return $klass;

    }

    
}