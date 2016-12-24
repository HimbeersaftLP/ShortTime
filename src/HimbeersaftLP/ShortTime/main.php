<?php
namespace HimbeersaftLP\ShortTime;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\TranslationContainer;
use pocketmine\level\Level;

class main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("ShortTime by HimbeersaftLP enabled!");
     }
     
     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "stime":
                    if(!isset($args[0])){
                         return false;
                         break;
                    }else{
                         if ($args[0] === "day") {
                              $t = 0;
                         } elseif ($args[0] === "night") {
                              $t = Level::TIME_NIGHT;
                         } elseif ($args[0] === "sunrise") {
                              $t = Level::TIME_SUNRISE;
                         } elseif ($args[0] === "sunset") {
                              $t = Level::TIME_SUNSET;
                         } else {
                              $t = (int) $args[0];
                              if ($t < 0) {
                                   $t = 0;
                              } elseif ($t > 30000000) {
                                   $t = 30000000;
                              }
                         }
                         foreach ($sender->getServer()->getLevels() as $level) {
                              $level->checkTime();
                              $level->setTime($t);
                              $level->checkTime();
                         }
                         Command::broadcastCommandMessage($sender, new TranslationContainer("commands.time.set", [$t]));
                    }
                    break;
          }
          return true;
     }
}
