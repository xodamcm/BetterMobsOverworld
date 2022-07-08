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

use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\player\Player;

class Listen implements Listener {
	public function onEntityDamageByEntityEvent(EntityDamageByEntityEvent $event) {
		$entity = $event->getEntity();
	}

	public function onEntityDamageEvent(EntityDamageEvent $event) {
		$entity = $event->getEntity();
	}

	public function onEntityDespawnEvent(EntityDespawnEvent $event) {
		$entity = $event->getEntity();
		if (method_exists($entity, "getName") and $entity instanceof Entity) {
			Main::$instance->toolsobj->spawnMessage($entity, "Despawned");
		}
	}

	public function onEntitySpawnEvent(EntitySpawnEvent $event) {
		$entity = $event->getEntity();
		if ($entity instanceof Entity) {
			Main::$instance->toolsobj->spawnMessage($entity, "Spawned");
		}
	}
}
