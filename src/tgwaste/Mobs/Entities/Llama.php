<?php

declare(strict_types=1);

namespace tgwaste\Mobs\Entities;
use pocketmine\entity\{Living, Entity};
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use function mt_rand;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\VanillaItems;
use pocketmine\data\bedrock\EntityLegacyIds;

class Llama extends MobsEntity {
	const TYPE_ID = EntityLegacyIds::LLAMA;
	const HEIGHT = 1.87;
	
    public function initEntity(CompoundTag $nbt) : void{
        $this->setMaxHealth(30);
	$this->setMovementSpeed(1); 
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
        return [
            VanillaItems::LEATHER()->setCount(mt_rand(0, 2 * $lootingL)),
        ];
    }

    public function getXpDropAmount(): int
    {
        return mt_rand(1, 3);
    }
}
