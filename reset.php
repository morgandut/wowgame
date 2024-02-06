<?php

session_start();

class Hero {
    public $name;
    public $level;
    public $experience;

    public function __construct($name, $level = 1, $experience = 0) {
        $this->name = $name;
        $this->level = $level;
        $this->experience = $experience;
    }

    public function reset() {
        $this->level = 1;
        $this->experience = 0;
    }
}

if (!isset($_SESSION['hero'])) {
    $_SESSION['hero'] = new Hero("Hero");
}

$_SESSION['hero']->reset();
?>
