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
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\VanillaItems;;
use function mt_rand;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\data\bedrock\EntityLegacyIds;

class Slime extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::SLIME;
	const HEIGHT = 0.51;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(10);
        $this->setVariant(mt_rand(0, 3));
	$this->setMovementSpeed(0.9);
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
            VanillaItems::SLIMEBALL()->setCount(mt_rand(0, 2 * $lootingL)),
        ];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 4);
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
}
