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
use pocketmine\item\VanillaItems;
use function mt_rand;

class PufferFish extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::PUFFERFISH;
	const HEIGHT = 1.0;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(3);
	 $this->setMovementSpeed(1);
        parent::initEntity($nbt);
    }	
	
	    public function getDrops(): array{
        $lootingL = 1;
        $cause = $this->lastDamageCause;
        if($cause instanceof EntityDamageByEntityEvent){
            $dmg = $cause->getDamager();
            if($dmg instanceof Player){
              
                // $looting = $dmg->getInventory()->getItemInHand()->getEnchantment(Enchantment::LOOTING);
                // if($looting !== null){
                    // $lootingL = $looting->getLevel();
                // }else{
                    $lootingL = 1;
            // }
            }
        }
        return [
            VanillaItems::PUFFERFISH()->setCount(mt_rand(0, 2 * $lootingL)),
        ];
    }
}
