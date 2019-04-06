<?php

namespace synapsepm\utils;


use pocketmine\network\mcpe\protocol\types\RuntimeBlockMapping;
use pocketmine\utils\MainLogger;

class Utils {

    public static function initBlockRuntimeIdMapping() {
        try {
            $reflect = new \ReflectionClass(RuntimeBlockMapping::class);
            $legacyToRuntimeMap = $reflect->getProperty("legacyToRuntimeMap");
            $runtimeToLegacyMap = $reflect->getProperty("runtimeToLegacyMap");
            $bedrockKnownStates = $reflect->getProperty("bedrockKnownStates");

            $legacyToRuntimeMap->setAccessible(true);
            $runtimeToLegacyMap->setAccessible(true);
            $bedrockKnownStates->setAccessible(true);

            $registerMapping = $reflect->getMethod("registerMapping");
            $registerMapping->setAccessible(true);

            $legacyIdMap = json_decode(file_get_contents(\pocketmine\RESOURCE_PATH . "legacy_id_map.json"), true);

            $bedrockKnownStates->setValue(json_decode(file_get_contents(\pocketmine\RESOURCE_PATH . "runtimeid_table.json"), true));
            $runtimeToLegacyMap->setValue([]);
            $legacyToRuntimeMap->setValue([]);

            foreach ($bedrockKnownStates->getValue() as $k => $obj) {
                //this has to use the json offset to make sure the mapping is consistent with what we send over network, even though we aren't using all the entries
                if (!isset($legacyIdMap[$obj["name"]])) {
                    continue;
                }

                $registerMapping->invokeArgs(null, [$k, $legacyIdMap[$obj["name"]], $obj["data"]]);
            }

        } catch (\ReflectionException $e) {
            MainLogger::getLogger()->logException($e);
        }
    }
}