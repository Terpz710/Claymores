<?php

declare(strict_types=1);

namespace Terpz710\Claymores\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

use Terpz710\Claymores\Loader;

class ClaymoreCommand extends Command {

    private $plugin;

    public function __construct(Loader $plugin) {
        parent::__construct("giveclaymore", "Give a claymore", "/giveclaymore [player] <amount>");
        $this->plugin = $plugin;
        $this->setPermission("claymores.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if ($sender instanceof Player) {
            if (count($args) !== 2) {
                $sender->sendMessage("Usage:§e /giveclaymore [player] [amount]");
                return true;
            }

            $targetPlayer = $this->plugin->getServer()->getPlayerExact($args[0]);
            $amount = (int)$args[1];

            if ($targetPlayer === null || !$targetPlayer->isOnline()) {
                $sender->sendMessage("§l§c(!)§r§f Player not found or not online!");
                return true;
            }

            if ($amount <= 0) {
                $sender->sendMessage("§l§c(!)§r§f Amount must be a positive number!");
                return true;
            }

            $claymoreItem = $this->plugin->createClaymore($sender, $amount);
            $targetPlayer->getInventory()->addItem($claymoreItem);

            $sender->sendMessage("§l§a(!)§r§f Given $amount to §e{$targetPlayer->getName()}§f!");

            return true;
        } else {
            $sender->sendMessage("This command can only be used by players");
            return false;
        }
    }
}