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

use pocketmine\data\bedrock\BiomeIds;
use pocketmine\player\Player;

class Biomes {
	public function getMobsForBiome(string $biome) {
		$biome = strtoupper($biome);
		$biometable = [
			"BIRCH FOREST" => ["Cat", "Chicken", "Cow", "Horse", "Parrot", "Pig", "Rabbit", "Sheep", "Slime"],
			"DESERT" => ["Cow", "Horse", "Pig", "Rabbit", "Sheep"],
			//"END" => ["Enderman"],
			"FOREST" => ["Bat", "Cat", "Chicken", "Cow", "Horse", "Parrot", "Pig", "Rabbit", "Sheep", "Bee"],
			"HELL" => ["Bat", "Cat", "Chicken", "Cow", "Horse", "Parrot", "Pig", "Rabbit", "Sheep"],
			"ICE PLAINS" => ["PolarBear", "Goat"],
			"MOUNTAINS" => ["Bat", "Cat", "Chicken", "Cow", "Horse", "Llama", "Parrot", "Pig", "Rabbit", "Sheep", "Goat"],
			"OCEAN" => ["Cod", "Axolotl", "Dolphin", "ElderGuardian", "PufferFish", "Salmon", "Squid", "TropicalFish", "Drowned"],
			"PLAINS" => ["Bee", "Cat", "Chicken", "Cow", "Donkey", "Horse", "Parrot", "Pig", "Rabbit", "Sheep", "Fox"],
			"RIVER" => ["Cod", "Axolotl", "PufferFish", "Salmon", "TropicalFish", "Drowned"],
			"SMALL MOUNTAIN" => ["Cat", "Chicken", "Cow", "Horse", "Llama", "Parrot", "Pig", "Rabbit", "Sheep", "Bee", "Fox", "Goat"],
			"SWAMP" => ["Bat", "Cow", "Horse", "Pig", "Rabbit", "Sheep", "Slime"],
			"TAIGA" => ["Bat", "Cat", "Chicken", "Cow", "Horse", "Ocelot", "Pig", "Rabbit", "Sheep", "Goat"]
		];

		if (!array_key_exists($biome, $biometable)) {
			$biome = "PLAINS";
		}

		return $biometable[$biome];
	}

	public function getNightMobsForBiome(string $biome) {
		$biome = strtoupper($biome);
		$biometable = [
			"BIRCH FOREST" => ["Creeper", "Skeleton", "Spider", "Wolf", "Zombie", "Phantom", "Enderman", "ZombieVillager", "Witch", "Slime", "Witch", "Evoker", "Vindicator"],
			"DESERT" => ["Creeper", "Husk", "Skeleton", "Spider", "Stray", "Wolf", "Zombie", "Phantom", "ZombieVillager", "Enderman", "Evoker", "Vindicator"],
			"END" => ["Enderman"],
			"FOREST" => ["Creeper", "Enderman", "Skeleton", "Spider", "Wolf", "Zombie", "ZombieVillager", "Witch"],
			"HELL" => ["Skeleton", "Zombie", "Spider", "Creeper", "Enderman", "Vindicator"],
			"ICE PLAINS" => ["Skeleton", "Zombie", "Skeleton", "Enderman", "Spider", "Creeper"],
			"MOUNTAINS" => ["Creeper", "Enderman", "Skeleton", "Spider", "Wolf", "Zombie", "Phantom", "Evoker", "Vindicator", "Witch"],
			"OCEAN" => ["Cod", "Axolotl", "PufferFish", "Salmon", "TropicalFish", "Guardian", "ElderGuardian", "Drowned"],
			"PLAINS" => ["Creeper", "Enderman", "Skeleton", "Spider", "Wolf", "Zombie", "ZombieVillager", "Phantom", "Evoker", "Vindicator", "Witch"],
			"SMALL MOUNTAIN" => ["Creeper", "Enderman", "Skeleton", "Spider", "Wolf", "Zombie", "ZombieVillager", "Phantom"],
			"RIVER" => ["Cod", "Axolotl", "PufferFish", "Salmon", "TropicalFish", "Guardian", "ElderGuardian", "Drowned"],
			"SMALL MOUNTAIN" => ["Creeper", "Skeleton", "Spider", "Wolf", "Zombie", "Evoker", "Vindicator", "Witch"],
			"SWAMP" => ["Spider", "Stray", "Witch", "Zombie", "Slime"],
			"TAIGA" => ["Spider", "Stray", "Zombie", "Enderman", "Skeleton", "Creeper"],
		];

		if (!array_key_exists($biome, $biometable)) {
			$biome = "PLAINS";
		}

		return $biometable[$biome];
	}
}
