<?php

declare(strict_types=1);

namepspace Terpz710\Claymores\Event;

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

        if ($item->getTypeId() === VanillaItems::BRICK()->getTypeId()) {
            $this->plugin->setClaymore($player, $item);
            $event->cancel();
        }
    }
}
