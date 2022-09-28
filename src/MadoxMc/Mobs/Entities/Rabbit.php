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
use pocketmine\event\entity\{
    EntityDamageByEntityEvent, EntityDamageEvent
};
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\nbt\tag\{
    IntTag
};
use pocketmine\player\Player;
use function mt_rand;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\VanillaItems;
use pocketmine\data\bedrock\EntityLegacyIds;

class Rabbit extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::RABBIT;
	const HEIGHT = 0.5;
	
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(3);
        $this->setVariant(mt_rand(0, 3));
	 $this->setMovementSpeed(0.8);
        parent::initEntity($nbt);
    }

    public function getDrops(): array{
        $lootingL = 1;
        $cause = $this->lastDamageCause;
        if($cause instanceof EntityDamageByEntityEvent){
            $damager = $cause->getDamager();
            if($damager instanceof Player){
            
                // $looting = $damager->getInventory()->getItemInHand()->getEnchantment(Enchantment::LOOTING);
                // if($looting !== null){
                    // $lootingL = $looting->getLevel();
                // }else{
                    $lootingL = 1;
                // }
            }
        }
        $drops = [VanillaItems::RABBIT_HIDE()->setCount(mt_rand(0, 1 * $lootingL))];
        if(mt_rand(1, 200) <= (5 + 2 * $lootingL)){
            $drops[] = VanillaItems::RABBIT_FOOT()->setCount(mt_rand(0, 1 * $lootingL));
        }

        return $drops;
    }
    
	public function setVariant(int $variant = 0): void {
		if($variant > 2 && $variant < 0){
			$variant = 0;
		}
		$this->variant = $variant;
		$this->networkPropertiesDirty = true;
	}
	
	protected function syncNetworkData(EntityMetadataCollection $properties) : void{
		parent::syncNetworkData($properties);
		$properties->setInt(EntityMetadataProperties::VARIANT, $this->variant);
	}

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
