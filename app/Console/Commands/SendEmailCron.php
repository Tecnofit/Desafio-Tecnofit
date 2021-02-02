<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\TraySendMail;
use Mail;

class SendEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendEmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TraySendMail $sendMail)
    {
        parent::__construct();
        $this->sendMail = $sendMail;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
        
        Mail::to('pauloavitaltray@gmail.com')->send(new $this->sendMail($details));
        $this->info('E-mail enviado com Sucesso');
    }
}
