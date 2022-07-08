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
use function mt_rand;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\data\bedrock\EntityLegacyIds;

class Witch extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::WITCH;
	const HEIGHT = 1.95;
	
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(26);
	 $this->setMovementSpeed(1.15);
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
        $drops = [VanillaItems::STICK()->setCount(mt_rand(0, 1))];
            if(mt_rand(0, 199) < 5){
                switch(mt_rand(0, 2)){
                    case 0:
                        $drops[] = VanillaItems::STICK()->setCount(mt_rand(0, 1));
                        break;
                    case 1:
                        $drops[] = VanillaItems::GLASS_BOTTLE()->setCount(mt_rand(0, 1));
                        break;
                    case 2:
                        $drops[] = VanillaItems::GUNPOWDER()->setCount(mt_rand(0, 1));
                        break;
                    case 2:
                        $drops[] = VanillaItems::REDSTONE_DUST()->setCount(mt_rand(0, 1));
                        break;
                    case 2:
                        $drops[] = VanillaItems::SPIDER_EYE()->setCount(mt_rand(0, 1));
                        break;						
                }
            }

        return $drops;
    }	

    public function getXpDropAmount(): int
    {
        return 5 + mt_rand(1, 3);
    }
}
