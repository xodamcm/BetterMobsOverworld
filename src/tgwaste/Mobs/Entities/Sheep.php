<?php

declare(strict_types=1);

namespace tgwaste\Mobs\Entities;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\player\Player;
use function mt_rand;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\VanillaItems;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\data\bedrock\EntityLegacyIds;

class Sheep extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::SHEEP;
	const HEIGHT = 1.3;
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(10);
	 $this->setMovementSpeed(1.1);
        $this->setVariant(mt_rand(0, 3));
        parent::initEntity($nbt);
    }	
	public function setVariant(int $variant = 0): void {
		if($variant > 3 && $variant < 0){
			$variant = 0;
		}
		$this->variant = $variant;
		$this->networkPropertiesDirty = true;
	}
	protected function syncNetworkData(EntityMetadataCollection $properties) : void{
		parent::syncNetworkData($properties);
		$properties->setInt(EntityMetadataProperties::VARIANT, $this->variant);
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
                    // $lootingL = 1;
                // }
            }
		}
		return [
			ItemFactory::getInstance()->get(ItemIds::WOOL, mt_rand(0, 15), 1 * $lootingL), //TODO: Check proper color
			ItemFactory::getInstance()->get(ItemIds::RAW_MUTTON, 0, mt_rand(1, 2 * $lootingL)),
		];
	}

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
