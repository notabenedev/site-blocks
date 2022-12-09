<?php

namespace Notabenedev\SiteBlocks\Console\Commands;

use PortedCheese\BaseSettings\Console\Commands\BaseConfigModelCommand;


class BlocksMakeCommand extends BaseConfigModelCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:blocks
                    {--all : Run all}
                    {--models : Export models}
                    {--policies : Export and create rules} 
                    {--only-default : Create only default rules}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Settings for site-blocks package';

    /**
     * Vendor Name
     * @var string
     *
     */
    protected $vendorName = 'Notabenedev';

    /**
     * Package Name
     * @var string
     *
     */
    protected $packageName = 'SiteBlocks';

    /**
     * The models to  be exported
     * @var array
     */
    protected $models = ["Block", "BlockGroup"];


    /**
     * Policies
     * @var array
     *
     */
    protected $ruleRules = [
        [
            "title" => "Группы блоков",
            "slug" => "block-groups",
            "policy" => "BlockGroupPolicy",
        ],
        [
            "title" => "Блоки",
            "slug" => "blocks",
            "policy" => "BlockPolicy",
        ],
    ];


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all = $this->option("all");

        if ($this->option("models") || $all) {
            $this->exportModels();
        }

        if ($this->option("policies") || $all) {
            $this->makeRules();
        }

        return 0;
    }
}
