<?php

declare(strict_types=1);

namespace Terpz710\Claymores\Task;

use pocketmine\scheduler\Task;
use pocketmine\world\Explosion;
use pocketmine\item\Item;
use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;

class ExplosionTask extends Task {

    private $position;
    private $world;

    public function __construct(Vector3 $position, $world) {
        $this->position = $position;
        $this->world = $world;
    }

    public function onRun() : void {
        $explosion = new Explosion($this->position, 6);
        $explosion->explodeA();
        $explosion->explodeB();
        $this->world->setBlock($this->position, VanillaBlocks::AIR());
    }
}
