<?php 
namespace classes;

class Druid extends Character
{
    private $forestRounds = 0;

    public function attack(Character $target) {
        $rand = rand(1, 10);
        if ($rand == 1) {
            //On appelle le pouvoir de heal
            return $this->heal();
        }elseif ($rand <= 4 && $this->forestRounds == 0) {
            //On appelle la foret
            return $this->forestStrength();
        }else{
            //On appelle le coup de baton
            return $this->stickHit($target);
        }
    }

    private function heal() {
        $this->realSetLifePoints(100);
        $status = "{$this->name} se soigne totalement! Il est mainteant à {$this->getLifePoints()} !";
        return $status;
    }

    private function forestStrength() {
        $this->forestRounds = 3;
        $status = "{$this->name} se concentre pour invoquer la force de la forêt !";
        return $status;
    }

    private function stickHit(Character $target) {
        $attack = rand(2, 7);
        if ($this->forestRounds > 0) {
            $coef = 1.5;
            $attack *= $coef;
            $this->forestRounds -= 1;
        }
        $target->setlifePoints($attack);
        $status = "{$this->name} frappe {$target->name} d'un coup de baton! Il reste {$target->getLifePoints()} à {$target->name} !";
        return $status;
    }
}