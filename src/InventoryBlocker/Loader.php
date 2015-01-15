<?php
namespace InventoryBlocker;

use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
    public function onEnable(){
        if(!is_dir($this->getDataFolder())){
            mkdir($this->getDataFolder());
        }
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);
    }

    /**
     * @param string $world
     * @return bool
     */
    public function canKeepInventoryOnWorld($world){
        if(is_array($c = $this->getConfig()->get("AllowInventoryOnDeath"))){
            $r = false;
            foreach($c as $w){
                if(strtolower($w) === strtolower($world)){
                    $r = true;
                }
            }
            return $r;
        }else{
            return $c;
        }
    }

    /**
     * @param string $world
     * @param bool $mode
     */
    public function setInventoryKeepOnWorld($world, $mode){
        if($mode === $this->canKeepInventoryOnWorld($world)){
            return;
        }
        if(is_array($w = $this->getConfig()->get("AllowInventoryOnDeath"))){
            if($mode){
                $w[] = $world;
            }else{
                unset($w[$world]);
            }
            $this->getConfig()->set("AllowInventoryOnDeath", $w);
            $this->getConfig()->save();
        }
    }

    /**
     * @param string $world
     * @return bool
     */
    public function canDropItemsOnWorld($world){
        if(is_array($c = $this->getConfig()->get("AllowItemDrops"))){
            $r = false;
            foreach($c as $w){
                if(strtolower($w) === strtolower($world)){
                    $r = true;
                }
            }
            return $r;
        }else{
            return $c;
        }
    }

    /**
     * @param string $world
     * @param bool $mode
     */
    public function setDropItemsOnWorld($world, $mode){
        if($mode === $this->canDropItemsOnWorld($world)){
            return;
        }
        if(is_array($w = $this->getConfig()->get("AllowItemDrops"))){
            if($mode){
                $w[] = $world;
            }else{
                unset($w[$world]);
            }
            $this->getConfig()->set("AllowItemDrops", $w);
            $this->getConfig()->save();
        }
    }

    /**
     * @param string $world
     * @return bool
     */
    public function canPickupItemsOnWorld($world){
        if(is_array($c = $this->getConfig()->get("AllowItemPickups"))){
            $r = false;
            foreach($c as $w){
                if(strtolower($w) === strtolower($world)){
                    $r = true;
                }
            }
            return $r;
        }else{
            return $c;
        }
    }

    /**
     * @param string $world
     * @param bool $mode
     */
    public function setPickupItemsOnWorld($world, $mode){
        if($mode === $this->canPickupItemsOnWorld($world)){
            return;
        }
        if(is_array($w = $this->getConfig()->get("AllowItemPickups"))){
            if($mode){
                $w[] = $world;
            }else{
                unset($w[$world]);
            }
            $this->getConfig()->set("AllowItemPickups", $w);
            $this->getConfig()->save();
        }
    }
}