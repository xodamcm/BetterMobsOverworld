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

use pocketmine\scheduler\Task;

class Schedule extends Task {
	public function onRun() : void {
		Main::$instance->spawnobj->deSpawnMobs();
		Main::$instance->spawnobj->spawnMobs();
	}
}
