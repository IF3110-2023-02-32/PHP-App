<?php

class MediaAccess
{
    protected $filepath;
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public function getDuration()
    {
        $dur = shell_exec("ffmpeg -i " . $this->filepath . " 2>&1");
        if (preg_match("/: Invalid /", $dur)) {
            return false;
        }
        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if (!isset($duration[1])) {
            return false;
        }
        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];
        return $seconds + ($minutes * MINUTE) + ($hours * HOUR);
    }
}
