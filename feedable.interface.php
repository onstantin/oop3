<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 20:14
 */

interface feedable
{
    public function feed_item();
    public function add_to_feed();
}