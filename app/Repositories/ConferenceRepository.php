<?php

namespace App\Repositories;

use App\Models\Conference;

class ConferenceRepository
{
    /**
     * @var Conference 
     */
     protected $conference;

     /**
      * Conference Repository constructor
      *@param Conference $conference      
      */
      public function __construct(Conference $conference)
      {
        $this->conference  = $conference;
      }


      /**
     * Get all conference.
     *
     * @return Conference $conference
     */
    public function getAll()
    {
        return $this->conference->get();
    }

      /**
     * Save Conference
     *
     * @param $data
     * @return Conference
     */
    public function save($data)
    {        
        $conference = new Conference();

        $conference->subject = $data['subject'];
        $conference->description = $data['description'];

        $conference->save();

        return $conference->fresh();
    }

      /**
     * Get conference by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Conference::with(['klasses','klasses.students'])        
        ->where('id', $id)
        ->get();
    }

    /**
     * Update Conference
     *
     * @param $data
     * @return Conference
     */
    public function update($data, $id)
    {
        
        $conference = $this->conference->find($id);

        $conference->subject = $data['subject']; 
        $conference->description = $data['description'];       

        $conference->update();

        return $conference;
    }

    /**
     * Update Conference
     *
     * @param $data
     * @return Conference
     */
    public function delete($id)
    {        
        $conference = $this->conference->find($id);
        $conference->delete();

        return $conference;
    }
}