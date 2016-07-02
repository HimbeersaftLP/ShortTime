<?php
namespace HimbeersaftLP\ShortTime;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("ShortTime by HimbeersaftLP enabled!");
     }
     
     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "stime":
                    if(!isset($args[0]) || !is_numeric($args[0])){
                         return false;
                         break;
                    }else{
                         $t = (int) $args[0];
                         if ($t < 0) {
                              $t = 0;
                         } elseif ($t > 24000) {
                              $t = 24000;
                         }
                         foreach ($sender->getServer()->getLevels() as $level) {
                              $level->checkTime();
                              $level->setTime($t);
                              $level->checkTime();
                         }
                         //broadcast stuff
                    }
          }
          return true;
     }
}
