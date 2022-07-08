<?php

declare(strict_types=1);

namespace MadoxMc\Mobs\Entities;
use pocketmine\entity\Living;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\VanillaItems;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemFactory;
use pocketmine\data\bedrock\EntityLegacyIds;

class IronGolem extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::IRON_GOLEM;
	const HEIGHT = 2.7;
	
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(100);
	$this->setMovementSpeed(1);
        parent::initEntity($nbt);
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
        VanillaItems::IRON_INGOT()->setCount(mt_rand(1, 2 * $lootingL));
        VanillaItems::RED_FLOWER()->setCount(mt_rand(1 * $lootingL));
        if(mt_rand(0, 5) === 0) {
            return [$iron, $rose];
        }
        return [$iron];
    }
}
