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
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use function mt_rand;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\ItemIds;
use pocketmine\data\bedrock\EntityLegacyIds;

class Zombie extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::ZOMBIE;
	const HEIGHT = 1.95;

    public function initEntity(CompoundTag $nbt) : void
    {
        $this->setMaxHealth(20);
        $this->setMovementSpeed(1.2);
        parent::initEntity($nbt);
    }

    public function getDrops(): array
    {
        $lootingL = 1;
        $cause = $this->lastDamageCause;
        if ($cause instanceof EntityDamageByEntityEvent) {
            $dmg = $cause->getDamager();
            if ($dmg instanceof Player) {

                // $looting = $dmg->getInventory()->getItemInHand()->getEnchantment(Enchantment::LOOTING);
                // if ($looting !== null) {
                    // $lootingL = $looting->getLevel();
                // } else {
                    $lootingL = 1;
                // }
            }
        }
        $drops = [
            VanillaItems::ROTTEN_FLESH()->setCount(mt_rand(0, 2 * $lootingL))
        ];

        if (mt_rand(0, 199) < 5) {
            switch (mt_rand(0, 2)) {
                case 0:
                    $drops[] = VanillaItems::IRON_INGOT()->setCount(mt_rand(0, 1 * $lootingL));
                    break;
                case 1:
                    $drops[] = VanillaItems::CARROT()->setCount(mt_rand(0, 1 * $lootingL));
                    break;
                case 2:
                    $drops[] = VanillaItems::POTATO()->setCount(mt_rand(0, 1 * $lootingL));
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