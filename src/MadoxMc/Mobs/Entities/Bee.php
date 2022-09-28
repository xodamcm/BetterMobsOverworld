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
use pocketmine\entity\Living;
use pocketmine\player\Player;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\nbt\tag\CompoundTag;
use function mt_rand;

class Bee extends MobsEntity
{
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(14);
	 $this->setMovementSpeed(1);
        parent::initEntity($nbt);
    }
	protected function getInitialSizeInfo() : EntitySizeInfo
	{
		return new EntitySizeInfo(0.6, 0.6);
	}
	
	public static function getNetworkTypeId() : string
	{
		return EntityIds::BEE;
	}
	

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}