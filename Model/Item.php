<?php

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 27.05.2016
 * Time: 10:59
 */
class Item extends AppModel
{
    var $actsAs = array('Media.Transfer', 'Media.Coupler', 'Media.Meta','Media.Generator');
}