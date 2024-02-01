<?php

declare(strict_types=1);

namespace Terpz710\Claymores\Event;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\scheduler\Task;
use pocketmine\world\Explosion;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

use Terpz710\Claymores\Loader;

class EventListener implements Listener {

    private $plugin;

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }

    public function onInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();

        if ($item->getNamedTag(CompoundTag::class) instanceof CompoundTag &&
            $item->getNamedTag(CompoundTag::class)->getTag("isClaymore", StringTag::class)) {
            $this->plugin->setClaymore($player, $item, $block);
            $player->getInventory()->removeItem($item->setCount(1));
        }
    }
}
