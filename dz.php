<?php

$human = new Human('Наталья', 'Краснова', Human::GENDER_FEMALE);
$human->age = 30;
echo $human->name;
echo $human->getProps();