<?php

declare(strict_types=1);

namepspace Terpz710\Claymores;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\math\Vector3;
use pocketmine\block\VanillaBlocks;

use Terpz710\Claymores\Task\ExplosionTask;
use Terpz710\Claymores\Event\EventListener;

class Loader extends PluginBase {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }

    public function setClaymore(Player $player, Item $item) {
        $position = $player->getPosition();
        $world = $player->getWorld();

        $world->setBlock($position, VanillaBlocks::REDSTONE_BLOCK());

        $this->getScheduler()->scheduleDelayedTask(new ExplosionTask($position, $world), 60);
    }
}
