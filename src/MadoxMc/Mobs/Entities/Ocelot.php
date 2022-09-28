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
use pocketmine\entity\Living;
use function mt_rand;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Ocelot extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::OCELOT;
	const HEIGHT = 0.7;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(10);
	 $this->setMovementSpeed(1);
        parent::initEntity($nbt);
    }	
   public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }

}
