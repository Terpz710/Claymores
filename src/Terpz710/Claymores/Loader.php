<?php

declare(strict_types=1);

namespace Terpz710\Claymores;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;

use Terpz710\Claymores\Task\ExplosionTask;
use Terpz710\Claymores\Event\EventListener;
use Terpz710\Claymores\Command\ClaymoreCommand;

class Loader extends PluginBase {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("giveclaymore", new ClaymoreCommand($this));
    }

    public function createClaymore(Player $player, int $amount): Item {
        $claymoreItem = VanillaItems::BRICK();
        $claymoreItem->getNamedTag()->setString("isClaymore", "");
        $claymoreItem->setCustomName("§r§l§eClaymore");
        $lore = ["§r§5Deadly explosive device"];
        $claymoreItem->setLore($lore);
        return $claymoreItem;
    }


    public function setClaymore(Player $player, Item $item, Block $block): void {
        $position = $block->getPosition();
        $world = $player->getWorld();
        $this->getScheduler()->scheduleDelayedTask(new ExplosionTask($position, $world), 60);
    }
}
