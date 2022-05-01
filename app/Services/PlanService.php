<?php

namespace App\Services;

use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PlanService
{
    /**
     * @var PlanRepository 
     */
     protected $planRepository;

     /**
      * PlanService constructor
      *@param PlanRepository $planRepository      
      */
      public function __construct(PlanRepository $planRepository)
      {
        $this->planRepository  = $planRepository;
      }

      /**
     * Get all plan.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->planRepository->getAll();
    }
    
    /**
     * Get plan by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->planRepository->getById($id);
    }
      
      
      /**
       * Validate Plan Data
       * Store in DB if no errors
       * 
       * @param array data
       * @return string
       */
      public function savePlanData($data)
      {
        $validator = Validator::make($data,[
            'name' => 'required|min:4|unique:plans'
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->planRepository->save($data);

        return $result;

      }

      /**
     * Delete plan by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $plan = $this->planRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete class');
        }

        DB::commit();

        return $plan;

    }

    /**
     * Update plan data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updatePlan($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:4|unique:plans'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $plan = $this->planRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update class data');
        }

        DB::commit();

        return $plan;

    }

    
}