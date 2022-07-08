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

use pocketmine\block\Water;
use pocketmine\entity\Location;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\World;
use MadoxMc\Mobs\Entities\MobsEntity;

class Spawn {
	public function spawnMobs() {
		if (Main::$instance->spawnmobs == null or Main::$instance->spawnmobs == false) {
			return;
		}

		foreach (Main::$instance->getServer()->getWorldManager()->getWorlds() as $world) {
			if ($this->isNoSpawn($world) == true) {
				# spawning is not allowed in this world
				continue;
			}

			$positions = [];

			for ($i = 0; $i < 20; $i++) {
				foreach ($world->getPlayers() as $player) {
					$positions[] = Main::$instance->coordsobj->getSaferSpawn($player->getPosition(), $world, 100);
				}
			}

			foreach ($positions as $pos) {
				$biome = $world->getBiome((int)$pos->x, (int)$pos->z)->getName();
				$daytime = Main::$instance->toolsobj->isDayTime($world);

				if ($daytime == false and mt_rand(1, 100) >= 20) {
					$mobtable = Main::$instance->biomesobj->getNightMobsForBiome($biome);
				} else {
					$mobtable = Main::$instance->biomesobj->getMobsForBiome($biome);
				}

				foreach ($mobtable as $mobname) {
					$total = 0;

					foreach ($world->getEntities() as $entity) {
						if (method_exists($entity, "getName") and $entity->getName() === $mobname) {
							$total += 1;
						}
					}

					$allowed = Main::$instance->getConfig()->get($mobname, 3);

					$max = $allowed - $total;

					if ($max < 1) {
						continue;
					}

					while ($max > 0) {
						$newpos = Main::$instance->coordsobj->getSaferSpawn($pos, $world, 8);
						$this->spawnEntity($mobname, $world, $newpos);
						$max--;
					}

					break;
				}
			}
		}
	}

	public function deSpawnMobs() {
		foreach (Main::$instance->getServer()->getWorldManager()->getWorlds() as $world) {
			foreach ($world->getEntities() as $entity) {
				if (!method_exists($entity, "getName")) {
					continue;
				}

				if ($entity instanceof Player) {
					continue;
				}

				if (!$entity instanceof MobsEntity) {
					continue;
				}

				$near = false;
				$worldname = $world->getFolderName();
				$mobname = $entity->getName();
				$block = $entity->getWorld()->getBlock($entity->getPosition()->subtract(0, 1, 0));
				$swimming = Main::$instance->attrobj->isSwimming($mobname);

				if ($this->isNoSpawn($world) == true) {
					# spawning is not allowed in this world
					$entity->setNameTag("Spawning is not allowed in this world");
					$entity->close();
					continue;
				}

				if ($swimming == false and ($block instanceof Water or $entity->isUnderwater())) {
					# this entity should not be in the water
					$entity->setNameTag("Not allowed in water");
					$entity->close();
					continue;
				}

				if (count($world->getPlayers()) < 1) {
					# there are no players in this world
					$entity->setNameTag("No players in $worldname");
					$entity->close();
					continue;
				}

				foreach ($world->getPlayers() as $p) {
					foreach ($p->getWorld()->getNearbyEntities($p->getBoundingBox()->expandedCopy(100, 100, 100)) as $e) {
						if ($e->getId() === $entity->getId()) {
							$near = true;
						}
					}
				}

				if ($near == false) {
					# no players are near this entity
					$entity->setNameTag("No nearby players");
					$entity->close();
					continue;
				}
			}
		}
	}

	public function spawnEntity(string $mobname, World $world, Vector3 $pos) {
		$location = new Location($pos->x, $pos->y, $pos->z, $world, 0, 0);

		if (Main::$instance->attrobj->isFlying($mobname)) {
			$location = new Location($pos->x, $pos->y+8, $pos->z, $world, 0, 0);
		}

		$entity = new Main::$instance->classes[$mobname]($location);

		if ($entity == null) {
			return Main::$instance->getServer()->getLogger()->info("§cError§f spawning mob §d$mobname §r");
		}

		$entity->spawnToAll();
	}

	public function isNoSpawn(World $world) {
		$worldname = $world->getFolderName();
	
		foreach (Main::$instance->nospawn as $substr) {
			if (strpos($worldname, $substr) !== false) {
				# spawning is not allowed in this world
				return true;
			}
		}

	       foreach ($world->getPlayers() as $player) {
		   $name = $player->getName();
		      if ($player->getPosition()->getWorld()->getFolderName() === ("$name")){
		             return true;
		 }
	} 
	       foreach ($world->getPlayers() as $player) {
                  $world = $player->getWorld()->getDisplayName();
                  $name = strtolower($player->getName());
                  $ex = explode("-", $world);
                  if($ex[0] == "ai"){
                  if($ex[1] == $name){
		             return true;
	       }
	}      
}	              

		return false;
	}
}
