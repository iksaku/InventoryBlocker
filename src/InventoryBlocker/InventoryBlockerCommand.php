<?php
namespace InventoryBlocker;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\utils\TextFormat;

class InventoryBlockerCommand extends Command implements PluginIdentifiableCommand{
    /** @var Loader */
    private $plugin;

    public function __construct(Loader $plugin){
        parent::__construct("inventoryblocker", "Change the features of the plugin!", "/inventoryblocker <keepinventory|dropitems|pickitems> <world> <on|off>", ["ib", "invblocker", "invblock"]);
        $this->setPermission("inventoryblocker.command");
        $this->plugin = $plugin;
    }

    /**
     * @return Loader
     */
    public function getPlugin(){
        return $this->plugin;
    }

    public function execute(CommandSender $sender, $alias, array $args){
        if(!$this->testPermission($sender)){
            return false;
        }
        switch(count($args)){
            case 3:
                if($args[2] !== "on" || $args[2] !== "off"){
                    $sender->sendMessage(TextFormat::RED . $this->getUsage());
                    return false;
                }
                $args[2] = ($args[2] === "on" ? true : false);
                $message = TextFormat::YELLOW . "Successfully " . ($args[2] ? "enabled" : "disabled") . " ";
                switch($args[0]){
                    case "keepinventory":
                        $this->getPlugin()->setInventoryKeepOnWorld($args[1], $args[2]);
                        $message .= "inventory keep";
                        break;
                    case "dropitems":
                        $this->getPlugin()->setDropItemsOnWorld($args[1], $args[2]);
                        $message .= "item drops";
                        break;
                    case "pickitems":
                        $this->getPlugin()->setPickupItemsOnWorld($args[1], $args[2]);
                        $message .= "item pickups";
                        break;
                    default:
                        $sender->sendMessage(TextFormat::RED . $this->getUsage());
                        return false;
                        break;
                }
                $message .= " on world " . TextFormat::AQUA . $args[1];
                $sender->sendMessage($message);
                break;
            default:
                $sender->sendMessage(TextFormat::RED . $this->getUsage());
                return false;
                break;
        }
        return true;
    }
}