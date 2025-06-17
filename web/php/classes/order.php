<?php

namespace classes;

class order {
    private string $travel_id;
    private string $start;
    private string $end;

    public function __construct($travel_id, $start, $end) {
        $this->travel_id = $travel_id;
        $this->start = $start;
        $this->end = $end;
    }
    public function getId(): string {
        return $this->travel_id;
    }
    public function getStart(): string {
        return $this->start;
    }
    public function getEnd(): string {
        return $this->end;
    }
}