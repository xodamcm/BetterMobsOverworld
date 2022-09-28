<?php

/*
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU Lesser General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   By: MadoxMc
 *   Discord: MadoxMC#3539
 */

declare(strict_types=1);

namespace MadoxMc\Mobs;

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
