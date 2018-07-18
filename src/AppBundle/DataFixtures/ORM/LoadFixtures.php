<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Nelmio\Alice\Loader\NativeLoader;


class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $objects= Fixtures::load(
            __DIR__.'/fixtures.yml',$manager
        );
    }
}
