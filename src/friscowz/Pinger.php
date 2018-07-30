<?php
/**
 * Created by PhpStorm.
 * User: FRISCOWZ
 * Date: 12/1/2017
 * Time: 2:05 AM
 */

namespace friscowz;


use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Pinger extends PluginBase
{
    const CONFIG_FILE = "config.yml";

    public static $instance;
    public static $config;

    public function onEnable()
    {
        self::setInstance($this);
        if (!is_dir($this->getDataFolder())) @mkdir($this->getDataFolder());
        if (file_exists($this->getDataFolder() . self::CONFIG_FILE)) {
            $config = new Config($this->getDataFolder() . self::CONFIG_FILE, Config::YAML);
            self::setConfigFile($config);
        } else {
            $config = new Config($this->getDataFolder() . self::CONFIG_FILE, Config::YAML, ["Message" => "§aYour ping is {ping}ms!"]);
            self::setConfigFile($config);
        }
        $this->registerCommands();
    }

    /**
     * @return Config
     */
    public static function getConfigFile() : Config
    {
        return self::$config;
    }

    /**
     * @param Config $config
     */
    public static function setConfigFile(Config $config)
    {
        self::$config = $config;
    }

    /**
     * @return Pinger
     */
    public static function getInstance() : Pinger
    {
        return self::$instance;
    }

    /**
     * @param Pinger $instance
     */
    public static function setInstance(Pinger $instance)
    {
        self::$instance = $instance;
    }

    public function registerCommands()
    {
        $this->getServer()->getCommandMap()->register("ping", new PingCommand($this));
    }
}
