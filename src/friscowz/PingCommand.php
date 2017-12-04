<?php
/**
 * Created by PhpStorm.
 * User: FRISCOWZ
 * Date: 12/1/2017
 * Time: 2:06 AM
 */

namespace friscowz;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class PingCommand extends PluginCommand
{
    /**
     * PingCommand constructor.
     * @param Pinger $plugin
     */
    public function __construct(Pinger $plugin)
    {
        parent::__construct("ping", $plugin);
        $this->setAliases(["ms", "latency", "pinger"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool|mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            $sender->sendMessage(str_replace("{ping}", $sender->getPing(), Pinger::getConfigFile()->get("Message")));
        }
    }
}
