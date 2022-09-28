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

namespace MadoxMc\Mobs\Entities;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\data\bedrock\EntityLegacyIds;

class Salmon extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::SALMON;
	const HEIGHT = 1.0;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(3);
	 $this->setMovementSpeed(0.9); 
        parent::initEntity($nbt);
    }	
}
