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

namespace MadoxMc\Mobs;

use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;
use MadoxMc\Mobs\Entities\Bat;
use MadoxMc\Mobs\Entities\Vindicator;
use MadoxMc\Mobs\Entities\Evoker;
use MadoxMc\Mobs\Entities\Axolotl;
use MadoxMc\Mobs\Entities\Blaze;
use MadoxMc\Mobs\Entities\Bee;
use MadoxMc\Mobs\Entities\Fox;
use MadoxMc\Mobs\Entities\Cat;
use MadoxMc\Mobs\Entities\CaveSpider;
use MadoxMc\Mobs\Entities\Chicken;
use MadoxMc\Mobs\Entities\Cod;
use MadoxMc\Mobs\Entities\Cow;
use MadoxMc\Mobs\Entities\Creeper;
use MadoxMc\Mobs\Entities\Dolphin;
use MadoxMc\Mobs\Entities\Donkey;
use MadoxMc\Mobs\Entities\ElderGuardian;
use MadoxMc\Mobs\Entities\Enderman;
use MadoxMc\Mobs\Entities\Ghast;
use MadoxMc\Mobs\Entities\Guardian;
use MadoxMc\Mobs\Entities\Horse;
use MadoxMc\Mobs\Entities\Husk;
use MadoxMc\Mobs\Entities\Goat;
use MadoxMc\Mobs\Entities\IronGolem;
use MadoxMc\Mobs\Entities\Llama;
use MadoxMc\Mobs\Entities\MagmaCube;
use MadoxMc\Mobs\Entities\MobsEntity;
use MadoxMc\Mobs\Entities\Mooshroom;
use MadoxMc\Mobs\Entities\Ocelot;
use MadoxMc\Mobs\Entities\Parrot;
use MadoxMc\Mobs\Entities\Phantom;
use MadoxMc\Mobs\Entities\Pig;
use MadoxMc\Mobs\Entities\PolarBear;
use MadoxMc\Mobs\Entities\PufferFish;
use MadoxMc\Mobs\Entities\Rabbit;
use MadoxMc\Mobs\Entities\Salmon;
use MadoxMc\Mobs\Entities\Sheep;
use MadoxMc\Mobs\Entities\Silverfish;
use MadoxMc\Mobs\Entities\Skeleton;
use MadoxMc\Mobs\Entities\SkeletonHorse;
use MadoxMc\Mobs\Entities\Slime;
use MadoxMc\Mobs\Entities\Spider;
use MadoxMc\Mobs\Entities\Squid;
use MadoxMc\Mobs\Entities\Stray;
use MadoxMc\Mobs\Entities\TropicalFish;
use MadoxMc\Mobs\Entities\Villager;
use MadoxMc\Mobs\Entities\Witch;
use MadoxMc\Mobs\Entities\Wolf;
use MadoxMc\Mobs\Entities\Zombie;
use MadoxMc\Mobs\Entities\ZombieVillager;
use MadoxMc\Mobs\Entities\Drowned;

class Registrations {
	public function registerEntities() {
		Main::$instance->classes = $this->getClasses();
		$entityFactory = EntityFactory::getInstance();
		foreach (Main::$instance->classes as $entityName => $typeClass) {
			$entityFactory->register($typeClass,
				static function(World $world, CompoundTag $nbt) use($typeClass): MobsEntity {
					return new $typeClass(EntityDataHelper::parseLocation($nbt, $world), $nbt);
				},
			[$entityName], $typeClass::TYPE_ID);
		}
	}

	public function getClasses() : array {
		return [
			"Bat" => Bat::class,
			"Axolotl" => Axolotl::class,
			"Bee" => Bee::class,
			"Blaze" => Blaze::class,
			"Cat" => Cat::class,
			"Goat" => Goat::class,
			"Drowned" => Drowned::class,
			"CaveSpider" => CaveSpider::class,
			"Chicken" => Chicken::class,
			"Cod" => Cod::class,
			"Cow" => Cow::class,
			"Creeper" => Creeper::class,
			"Dolphin" => Dolphin::class,
			"Donkey" => Donkey::class,
			"Vindicator" => Vindicator::class,
			"Evoker" => Evoker::class,
			"Fox" => Fox::class,
			"ElderGuardian" => ElderGuardian::class,
			"Enderman" => Enderman::class,
			"Ghast" => Ghast::class,
			"Guardian" => Guardian::class,
			"Horse" => Horse::class,
			"Husk" => Husk::class,
			"IronGolem" => IronGolem::class,
			"Llama" => Llama::class,
			"MagmaCube" => MagmaCube::class,
			"Mooshroom" => Mooshroom::class,
			"Ocelot" => Ocelot::class,
			"Parrot" => Parrot::class,
			"Phantom" => Phantom::class,
			"Pig" => Pig::class,
			"PolarBear" => PolarBear::class,
			"PufferFish" => PufferFish::class,
			"Rabbit" => Rabbit::class,
			"Salmon" => Salmon::class,
			"Sheep" => Sheep::class,
			"Silverfish" => Silverfish::class,
			"Skeleton" => Skeleton::class,
			"SkeletonHorse" => SkeletonHorse::class,
			"Slime" => Slime::class,
			"Spider" => Spider::class,
			"Squid" => Squid::class,
			"Stray" => Stray::class,
			"TropicalFish" => TropicalFish::class,
			"Villager" => Villager::class,
			"Witch" => Witch::class,
			"Wolf" => Wolf::class,
			"Zombie" => Zombie::class,
			"ZombieVillager" => ZombieVillager::class
		];
	}
}
