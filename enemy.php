<?php
class Enemy {
    public $name;
    public $current_hp;
    public $max_hp;
    public $enemylevel;

    public function __construct($name, $current_hp, $max_hp, $enemylevel) {
        $this->name = $name;
        $this->current_hp = $current_hp;
        $this->max_hp = $max_hp;
        $this->enemylevel = $enemylevel;
    }


    public function setCurrentHP($current_hp) {
        $this->current_hp = $current_hp;
    }

    public function attack($damage) {
        $this->current_hp -= $damage;
        if ($this->current_hp > 0) {
        return $this->current_hp;
        } else if ($this->current_hp < 0) {
        return $this->current_hp = $this->max_hp;
        }
    }
    public function reset() {
        $this->max_hp = 100;
        $this->enemylevel = 1;
    }
}

?>
