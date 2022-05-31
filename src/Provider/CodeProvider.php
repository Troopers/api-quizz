<?php

declare(strict_types=1);

namespace App\Provider;

use Faker\Provider\Base;

class CodeProvider extends Base
{
    protected static $codeformat = '{{starWars}}-{{fruit}}-{{starWars}}-{{fruit}}';

    protected static $starWars = ['Anakin', 'Skywalker', 'Luke', 'DarkVador', 'HanSolo', 'BenSolo', 'Chewbacca', 'LeiaOrgana', 'C3PO',
        'R2D2', 'BB8', 'OwenLars', 'BeruWhitesun', 'WilhuffTarkin', 'ObiWanKenobi', 'Lando', 'Palpatine', 'Yoda', 'Rey', 'PadméAmidala',
        'DarkMaul', 'KyloRen', 'AmiralAckbar', 'BobaFett', 'Jabba', 'ComteDooku', 'Starkiller', 'JarJarBinks',
        'Bacara', 'Cody', 'Echo', 'Rex', 'Fives', 'Havoc', 'Jester', 'Omega', 'Tracker', 'AhsokaTano', 'PloKoon', 'MaceWindu', ];

    protected static $fruit = ['Abricot', 'Airelle', 'Amande', 'Ananas', 'Avocat', 'Banane', 'Cassis', 'Cerise', 'Citron', 'Coing',
        'Datte', 'Figue', 'Fraise', 'Grenade', 'Groseille', 'Kaki', 'Kiwi', 'Kumquat', 'Litchi', 'Mangue', 'Melon', 'Mirabelle',
        'Mûre', 'Myrtille', 'Nectarine', 'Noisette', 'Noix', 'Orange', 'Papaye', 'Pastèque', 'Pêche', 'Poire', 'Pomme', 'Prune',
        'Quetsche', 'Raisin', ];

    public function code(): string
    {
        return $this->generator->parse(static::$codeformat);
    }

    public function starWars(): string
    {
        return static::randomElement(static::$starWars);
    }

    public function fruit(): string
    {
        return static::randomElement(static::$fruit);
    }
}
