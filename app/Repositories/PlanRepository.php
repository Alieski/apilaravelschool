<?php

namespace App\Repositories;

use App\Models\Plan;

class PlanRepository
{
    /**
     * @var Plan 
     */
     protected $plan;

     /**
      * Plan Repository constructor
      *@param Plan $plan      
      */
      public function __construct(Plan $plan)
      {
        $this->plan  = $plan;
      }


      /**
     * Get all plan.
     *
     * @return Plan $plan
     */
    public function getAll()
    {
        return $this->plan->get();
    }

      /**
     * Save Plan
     *
     * @param $data
     * @return Plan
     */
    public function save($data)
    {
        $plan = new Plan();

        $plan->name = $data['name'];

        $plan->save();

        return $plan->fresh();
    }

      /**
     * Get plan by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->plan
            ->where('id', $id)
            ->get();
    }

    /**
     * Update Plan
     *
     * @param $data
     * @return Plan
     */
    public function update($data, $id)
    {
        
        $plan = $this->plan->find($id);

        $plan->name = $data['name'];        

        $plan->update();

        return $plan;
    }

    /**
     * Update Plan
     *
     * @param $data
     * @return Plan
     */
    public function delete($id)
    {        
        $plan = $this->plan->find($id);
        $plan->delete();

        return $plan;
    }
}