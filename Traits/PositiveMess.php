<?php

trait PositiveMess {

    public function positive(): string {
        return 'Love your '. $this-> species;
    }

}