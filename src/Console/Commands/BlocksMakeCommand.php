<?php

namespace Notabenedev\SiteBlocks\Console\Commands;

use App\BlockGroup;
use App\Menu;
use App\MenuItem;
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
                    {--only-default : Create only default rules}
                    {--controllers : Export controllers}
                    {--menu : Make admin menu}
                    ';

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

   protected $fill =
       [
           [
               "title" => "Вопрос-Ответ",
               "slug" => "faq",
               "template" => "site-blocks::site.block-groups.templates.accordion",
           ],
       ];

    /**
     * Make Controllers
     */
    protected $controllers = [
        "Admin" => ["BlockGroupController", "BlockController"],
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
            foreach ($this->fill as $fill){
                try {
                    $group = BlockGroup::query()
                        ->where("slug", $fill["slug"])
                        ->where('title', $fill["title"])
                        ->firstOrFail();
                    $group->update($fill);
                    $this->info("Группа блоков ".$fill["title"]." обновлена");
                }
                catch (\Exception $e) {
                    BlockGroup::create($fill);
                    $this->info("Группа блоков ".$fill["title"]." создана");
                }
            }
        }

        if ($this->option("policies") || $all) {
            $this->makeRules();
        }

        if ($this->option("controllers") || $all) {
            $this->exportControllers("Admin");
        }

        if ($this->option("menu") || $all) {
            $this->makeMenu();
        }

        return 0;
    }

    /**
     * Make menu
     *
     * @return void
     */
    protected function makeMenu()
    {
        try {
            $menu = Menu::query()
                ->where('key', 'admin')
                ->firstOrFail();
        }
        catch (\Exception $e) {
            return;
        }

        $title = config("site-blocks.sitePackageName");
        $itemData = [
            'title' => $title,
            'template' => "site-blocks::admin.blocks.menu",
            'url' => "#",
            'ico' => 'fas fa-th-large',
            'menu_id' => $menu->id,
        ];

        try {
            $menuItem = MenuItem::query()
                ->where("menu_id", $menu->id)
                ->where('title', $title)
                ->firstOrFail();
            $menuItem->update($itemData);
            $this->info("Элемент меню '$title' обновлен");
        }
        catch (\Exception $e) {
            MenuItem::create($itemData);
            $this->info("Элемент меню '$title' создан");
        }
    }
}
