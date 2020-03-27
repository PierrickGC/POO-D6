<?php 
namespace classes;

class Necromancer extends Character
{
    private $prediction;

    public function attack(Character $target) {
        $rand = rand(1, 100);
        if ($rand <= 1) {
            //1%
            //On appelle le pouvoir d'entrainer son adversaire vers la mort (oneshot)
            return $this->death($target);
        }elseif ($rand <= 31 && is_null($this->prediction)) {
            //30%
            //Le nécromencien predit la mort de l'adversaire en nombre de tours, si elle est atteinte avant qu'il ne meurt lui même, l'adversaire meurt
            return $this->deathPredict($target);
        }else{
            //69%
            //On appelle le coup de baton
            return $this->reapingHook($target);
        }
    }

    private function death(Character $target) {
        $target->realSetLifePoints(0);
        $status = "{$this->name} entraine {$target->name} vers la mort!";
        return $status;
    }

    private function deathPredict(Character $target) {
        $rounds = rand(5,25);
        $this->prediction = $rounds;
        $status = "{$this->name} prédit la mort de {$target->name} dans {$rounds} tours !";
        return $status;
    }

    private function reapingHook(Character $target) {
        $attack = rand(2, 7);
        if ($this->prediction > 1) {
            $this->prediction -= 1;
            $target->setlifePoints($attack);
            $status = "{$this->name} frappe {$target->name} avec sa faucille! Il reste {$target->getLifePoints()} à {$target->name} !";
        }elseif($this->prediction == 1){
            $target->realSetLifePoints(0);
            $status = "La prédiction de {$this->name} était juste, {$target->name} est mort !";
        }else{
            $target->setlifePoints($attack);
            $status = "{$this->name} frappe {$target->name} avec sa faucille! Il reste {$target->getLifePoints()} à {$target->name} !";
        }
        return $status;
    }
}