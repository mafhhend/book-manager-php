<?php

class Validation
{
    public function isEmpty($data)
    {
        return  $data==null || $data=='';
    }
}
