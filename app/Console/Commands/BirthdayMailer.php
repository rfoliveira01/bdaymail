<?php

namespace App\Console\Commands;

use App\Services\EmployeesMailService;
use Illuminate\Console\Command;

class BirthdayMailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:birthday {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday emails to employees for the given date (Today is default date)';
    

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(EmployeesMailService $mailService)
    {
        $date = $this->argument('date') ?? date('Y-m-d');

        $this->info(sprintf('Checking birthdays for %s',$date));

        $mailsSent = $mailService->birthdayMailService($this->argument('date'));
        if(count($mailsSent)){
            $this->info('An email was sent for the following Employees:');
            foreach($mailsSent as $employee){
                $this->line(sprintf('%s %s',$employee->getName(), $employee->getLastName()));
            }
        }else{
            $this->warn('No birthday for this date');
        }
        return 0;
    }
}
