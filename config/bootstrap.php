<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

use Cake\Database\TypeFactory;

TypeFactory::map('serialized', CakeApiConnector\Database\Type\SerializedType::class);