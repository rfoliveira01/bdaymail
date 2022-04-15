<?php

namespace App\Repository;

use GuzzleHttp\Client;
use App\Models\Employee;
use GuzzleHttp\Exception\ConnectException;

class EmployeeRepository
{

    const DATE_OF_BIRTH_FIELD =  'dateOfBirth';
    const EMPLOYEMENT_START_FIELD =  'employementStartDate';
    const LAST_BDAY_NOTIFIED_FIELD =  'lastBirthdayNotified';
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://interview-assessment-1.realmdigital.co.za/'
        ]);
        
    }
    
    /**
     * Return list of employeers wich the chosen date field matches with the dates array
     * 
     * @param array $dates Array of dates to filter the list ('m-d' format)
     * @param string $dateField  -- Field wich will be used to compare with the dates providaded (Defaul: DATE_OF_BIRTH_FIELD)
     */

    public function findEmployeeByDates($dates, $dateField = self::DATE_OF_BIRTH_FIELD)
    {
        $uri = 'employees/';
        try {

            $response = $this->client->request('GET', $uri);

            $apiData = json_decode($response->getBody(), true);

            $employeeList = [];
            foreach ($apiData as $employeeData) {
                $date = date('m-d', strtotime($employeeData[$dateField]));
                if(in_array($date, $dates)){
                    $employeeList[] = Employee::getInstanceFromArray($employeeData);
                }
            }
            return $employeeList;
        } catch (ConnectException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * returns array with the ids of the employees who do not want to receive emails.
     * 
     * @return Array
     */
    public function getExclusionList()
    {
        $uri = 'do-not-send-birthday-wishes/';

        try {
            $response = $this->client->request('GET', $uri);

            $apiData = json_decode($response->getBody(), true);

            return $apiData;
        } catch (ConnectException $e) {
            throw new \Exception($e->getMessage());
            
        }
    }

    /**
     * returns array with the ids of the employees who do not want to receive emails.
     * 
     * @return bool
     */
    public function updateLastBirthdayNotified($id, $date)
    {
        $uri = sprintf('employees/%d/',$id);

        try {

            $data = [
                self::LAST_BDAY_NOTIFIED_FIELD => $date
            ];
            $response = $this->client->request('PATCH', $uri, ['json'=>$data]);

            return true;
        } catch (ConnectException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
