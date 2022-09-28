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

use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\Living;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use function mt_rand;
use pocketmine\entity\EntitySizeInfo;

use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class Evoker extends MobsEntity {
	//const TYPE_ID = EntityLegacyIds::EVOKER;
	const HEIGHT = 1.6;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(24);
	 $this->setMovementSpeed(1.15);
        parent::initEntity($nbt);
    }
	public static function getNetworkTypeId() : string
	{
		return EntityIds::EVOCATION_ILLAGER;
	}

	
    public function getDrops(): array
    {
    
    
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
        return $drops = [
            VanillaItems::EMERALD()->setCount(mt_rand(0, 1 * $lootingL)),
        ];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
