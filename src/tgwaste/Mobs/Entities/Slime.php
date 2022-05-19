<?php

declare(strict_types=1);

namespace tgwaste\Mobs\Entities;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\item\enchantment\Enchantment;

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
        $drops = [ItemFactory::getInstance()->get(ItemIds::SLIMEBALL, 0, 1 * $lootingL)];
            if(mt_rand(0, 199) < 5){
                switch(mt_rand(0, 2)){
                    case 0:
                        $drops[] = ItemFactory::getInstance()->get(ItemIds::IRON_INGOT, 0, 1 * $lootingL);
                        break;
                    case 1:
                        $drops[] = ItemFactory::getInstance()->get(ItemIds::CARROT, 0, 1 * $lootingL);
                        break;
                    case 2:
                        $drops[] = ItemFactory::getInstance()->get(ItemIds::POTATO, 0, 1 * $lootingL);
                        break;
                }
            }

        return $drops;
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
