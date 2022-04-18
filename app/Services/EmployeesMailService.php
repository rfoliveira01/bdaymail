<?php

namespace App\Services;

use App\Repository\EmployeeRepository;
use Mail;

class EmployeesMailService
{
    const MAIL_DOMAIN = 'realmdigital.co.za';

    /**
     * @var EmployeeRepository
     */
    private $repository;

    function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function birthdayMail($date)
    {
        $dateObj = \DateTime::createFromFormat('Y-m-d','2022-02-28');
        $dates = [$dateObj->format('m-d')];

        //If date is 28th of February and this is not a leap year 29th of February will be included on the search
        if ($dateObj->format('m-d') == '02-28' && !$dateObj->format('L')) {
            $dates[] = '02-29';
        }

        $employees = $this->repository->findEmployeeByDates($dates);

        $exclusionList = $this->repository->getExclusionList();

        $mailsSent = [];
        foreach ($employees as $employee) {
            //Check if employee is on exclusion list or if it was already notified for this year's birthday
            if (!in_array($employee->getId(), $exclusionList) && ($employee->getLastBirthdayNotified() == null || $employee->getLastBirthdayNotified()->format("Y") != date("Y", $dateInTs)) ) {

                $email = sprintf("%s@%s", strtolower($employee->getName()),self::MAIL_DOMAIN);
                
                Mail::to($email)->send(new \App\Mail\BirthdayMail($employee->getName()));

                $this->repository->updateLastBirthdayNotified($employee->getId(), $date);
                
                $mailsSent[] = $employee;
            }
        }

        return $mailsSent;
    }
}
