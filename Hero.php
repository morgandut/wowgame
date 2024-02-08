<?php
// Définition de la classe Hero
class Hero {
    public $name;
    public $level;
    public $damage;
    public $experience;
    public $expGained;

    public function __construct($name, $level = 1, $damage = 5, $experience = 0, $expGained = 0) {
        $this->name = $name;
        $this->level = $level;
        $this->damage = $damage;
        $this->experience = $experience;
        $this->expGained = $expGained;
    }

    public function gainExperience($exp) {
        $this->experience += $exp;

        while ($this->experience >= $this->level * 500) {
            $this->level++;
            $this->experience = 0;
        }

        return ['level' => $this->level, 'experience' => $this->experience];
    }

    public function reset() {
        $this->level = 1;
        $this->experience = 0;
    }
}

?>
