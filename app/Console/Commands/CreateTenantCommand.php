<?php

namespace App\Console\Commands;

use App\Models\CustomTenant;
use Illuminate\Console\Command;

class CreateTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {name} {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new tenant';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $domain = $this->argument('domain');

        $tenant = CustomTenant::create([
            'name' => $name,
            'domain' => $domain,
        ]);

        $this->info("Tenant `{$name}` created with domain `{$domain}`.");
    }
}
