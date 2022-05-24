<?php

declare(strict_types=1);

namespace tgwaste\Mobs;

class Attributes {
	public function isFlying(string $name) : bool {
		return in_array($name, ["Bat", "Parrot", "Phantom", "Bee"]);
	}

	public function isJumping(string $name) : bool {
		return in_array($name, ["Rabbit", "Slime"]);
	}

	public function isSwimming(string $name) : bool {
		return in_array($name, ["Cod", "Dolphin", "ElderGuardian", "PufferFish", "Salmon", "Squid", "TropicalFish", "Axolotl", "Drowned"]);
	}

	public function isHostile(string $name) : bool {
		return in_array($name, [
			"Blaze", "CaveSpider", "Creeper", "Guardian", "Husk", "Skeleton", "Slime", "Spider", "Stray", "Witch", "Wolf", "Zombie", "ZombieVillager", "Evoker", "Vindicator", "ElderGuardian", "Drowned"
		]);
	}
	
	
	//public function isNetherMob(string $name) : bool {
		//return in_array($name, ["Blaze", "Chicken", "Enderman", "Ghast", "MagmaCube", "Skeleton", "Slime"]);
	//}

	public function isSnowMob(string $name) : bool {
		return in_array($name, ["PolarBear"]);
	}

	public function canCatchFire(string $name) : bool {
		return in_array($name, ["Skeleton", "Zombie", "ZombieVillager", "Phantom"]);
	}

	public function getMortalEnemy(string $name) : string {
		$enemies = array("Wolf" => "Sheep", "Wolf" => "Skeleton", "Zombie" => "Villager", "Fox" => "Chicken", "Fox" => "Rabbit");
		foreach ($enemies as $source => $target) {
			if ($source === $name) {
				return $target;
			}
		}
		return "none";
	}
}
