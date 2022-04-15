<?php

namespace App\Models;

//It's not a ORM Model (It will use the Api as Datasource)
class Employee
{


    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var \DateTime
     */
    private $dateOfBirth;
    /**
     * @var \DateTime
     */
    private $employementStartDate;
    /**
     * @var \DateTime
     */
    private $employementEndDate;
    /**
     * @var \DateTime
     * The date when the last birthday mail was sent 
     */
    private $lastBirthdayNotified;


    /**
     * Get the value of id
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of lastName
     *
     * @return  string;
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the value of dateOfBirth
     *
     * @return  \Date
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Get the value of employementStartDate
     *
     * @return  \Date
     */
    public function getEmployementStartDate()
    {
        return $this->employementStartDate;
    }

    /**
     * Get the value of employementEndDate
     *
     * @return  \Date
     */
    public function getEmployementEndDate()
    {
        return $this->employementEndDate;
    }

    /**
     * Get the date when the last birthday mail was sent
     *
     * @return  \Date
     */
    public function getLastBirthdayNotified()
    {
        return $this->lastBirthdayNotified;
    }

    static function getInstanceFromArray(array $employeeData)
    {
        $obj = new Employee();
        $obj->id = $employeeData['id'] ?? null;
        $obj->name = $employeeData['name'] ?? null;
        $obj->lastName = $employeeData['lastname'] ?? null;
        $obj->dateOfBirth = new \DateTime($employeeData['dateOfBirth']);
        $obj->employementStartDate = isset($employeeData['employementStartDate']) ? new \DateTime($employeeData['employementStartDate']) : null;
        $obj->employementEndDate = isset($employeeData['employementEndDate']) ? new \DateTime($employeeData['employementEndDate']) : null;
        $obj->lastBirthdayNotified = isset($employeeData['lastBirthdayNotified']) ?  new \DateTime($employeeData['lastBirthdayNotified']) : null;
        return $obj;
    }
}
