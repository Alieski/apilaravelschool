<?php

namespace App\Services;

use App\Repositories\ConferenceRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ConferenceService
{
    /**
     * @var ConferenceRepository 
     */
     protected $conferenceRepository;

     /**
      * ConferenceService constructor
      *@param ConferenceRepository $conferenceRepository      
      */
      public function __construct(ConferenceRepository $conferenceRepository)
      {
        $this->conferenceRepository  = $conferenceRepository;
      }

      /**
     * Get all conference.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->conferenceRepository->getAll();
    }
    
    /**
     * Get conference by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->conferenceRepository->getById($id);
    }
      
      
      /**
       * Validate Conference Data
       * Store in DB if no errors
       * 
       * @param array data
       * @return string
       */
      public function saveConferenceData($data)
      {        
        $validator = Validator::make($data,[
            'subject' => 'required|min:4|unique:conferences',
            'description' => 'required'
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->conferenceRepository->save($data);

        return $result;

      }

      /**
     * Delete conference by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $conference = $this->conferenceRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete conference');
        }

        DB::commit();

        return $conference;

    }

    /**
     * Update conference data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateConference($data, $id)
    {
        $validator = Validator::make($data, [
            'subject' => 'required|min:4|unique:conferences',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $conference = $this->conferenceRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update conference data');
        }

        DB::commit();

        return $conference;

    }

    
}