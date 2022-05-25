<?php

declare(strict_types=1);

namespace App\Provider;

use Faker\Provider\Base;

class CodeProvider extends Base
{
    protected static $codeformat = '{{codeWord}}-{{codeWord}}-{{codeWord}}-{{codeWord}}-{{codeWord}}';
    protected static $codeWord = ['aigle', 'alouette', 'ane', 'baleine', 'belette', 'bison', 'bouc', 'chevre', 'taureau',
       'vache', 'buffle', 'bufflonne', 'canard', 'cane', 'carpe', 'castor', 'cerf', 'biche', 'chacal', 'chameau', 'chamelle', 'chat', 'chauve-souris', 'cheval', 'etalon', 'jument',
       'chevreuil', 'chevrette', 'chien', 'chienne', 'chimpanze', 'chouette', 'cigale', 'cigogne', 'coq', 'poule', 'corbeau', 'coyote', 'crocodile', 'daim', 'dauphin', 'dindon',
       'dromadaire', 'ecureuil', 'elephant', 'faisan', 'gazelle', 'geai', 'girafe', 'gorille', 'grenouille', 'guepard', 'guepe', 'hamster', 'herisson', 'hibou', 'hippopotame',
       'hirondelle', 'hyene', 'jaguar', 'jars', 'oie', 'kangourou', 'koala', 'lama', 'lapin', 'lapine', 'leopard', 'lievre', 'hase', 'lion', 'lionne', 'loup', 'louve', 'loutre',
       'lynx', 'marmotte', 'merle', 'moineau', 'mouton', 'belier', 'brebis', 'ours', 'ourse', 'panda', 'paon', 'paonne', 'perdrix', 'perroquet', 'perruche', 'phoque', 'pie',
       'pigeon', 'rat', 'renard', 'rhinoceros', 'rossignol', 'sanglier', 'laie', 'serpent', 'singe', 'guenon', 'souris', 'taon', 'taupe', 'tigre', 'tigresse', 'tourterelle', 'vison', 'zebre', ];

    public function code(): string
    {
        return $this->generator->parse(static::$codeformat);
    }

    public function codeWord(): string
    {
        return static::randomElement(static::$codeWord);
    }
}
