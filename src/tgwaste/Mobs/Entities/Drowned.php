<?php

declare(strict_types=1);

namespace tgwaste\Mobs\Entities;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use function mt_rand;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\item\ItemIds;
use pocketmine\data\bedrock\EntityLegacyIds;

class Drowned extends MobsEntity {
    public static function getNetworkTypeId() : string {
        return EntityIds::DROWNED;
    }
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
            ItemFactory::getInstance()->get(ItemIds::ROTTEN_FLESH, 0, mt_rand(0, 2 * $lootingL))
        ];

        if (mt_rand(0, 199) < 5) {
            switch (mt_rand(0, 2)) {
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
        return 5 + mt_rand(1, 3);
    }
}