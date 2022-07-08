<?php

declare(strict_types=1);

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

namespace MadoxMc\Mobs\Entities;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\Living;
use pocketmine\player\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use function mt_rand;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\data\bedrock\EntityLegacyIds;

class Wolf extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::WOLF;
	const HEIGHT = 0.85;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(10);
	 $this->setMovementSpeed(1.1);
        parent::initEntity($nbt);
    }	

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
