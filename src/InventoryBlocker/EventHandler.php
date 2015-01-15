<?php
namespace InventoryBlocker;


use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;

class EventHandler implements Listener{
    /** @var Loader */
    private $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
    }

    /**
     * @param PlayerDeathEvent $event
     */
    public function onPlayerDeath(PlayerDeathEvent $event){
        if($this->plugin->canKeepInventoryOnWorld($event->getEntity()->getLevel()->getName())){
            $event->setKeepInventory(true);
        }
    }

    /**
     * @param PlayerDropItemEvent $event
     */
    public function onItemDrop(PlayerDropItemEvent $event){
        if(!$this->plugin->canDropItemsOnWorld($event->getPlayer()->getLevel()->getName())){
            $event->setCancelled(true);
        }
    }

    /**
     * @param InventoryPickupItemEvent $event
     */
    public function onItemPickUp(InventoryPickupItemEvent $event){
        if(!$this->plugin->canPickupItemsOnWorld($event->getItem()->getLevel()->getName())){
            $event->setCancelled(true);
        }
    }
}