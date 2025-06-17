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
    public function get_travel_id(): string {
        return $this->travel_id;
    }
    public function get_start(): string {
        return $this->start;
    }
    public function get_end(): string {
        return $this->end;
    }
}