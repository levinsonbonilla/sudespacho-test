<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\ValueAddedTax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class AppFixtures extends Fixture
{
    private string $projectDir;

    public function __construct(private KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }

    public function load(ObjectManager $manager): void
    {
        /* Route yaml */
        $routeYaml = $this->projectDir . "/test_data/";

        $this->createValueAddedTax(Yaml::parseFile($routeYaml . "ValueAddedTax.yaml"), $manager);
        $this->createUsers(Yaml::parseFile($routeYaml . "Users.yaml"), $manager);

        $manager->flush();
    }

    private function createValueAddedTax(array $data, ObjectManager $em): void
    {
        foreach ($data as $key => $value) {
            $valueAddedTax = new ValueAddedTax();
            $valueAddedTax->add(
                $value["percentage"],
                $value["enabled"]
            );
            $em->persist($valueAddedTax);
        }
    }

    private function createUsers(array $data, ObjectManager $em) : void
    {
        foreach ($data as $key => $value) {
            $valueAddedTax = new User();
            $valueAddedTax->add(
                $value["email"],
                $value["roles"],
                $value["password"]
            );
            $em->persist($valueAddedTax);
        }
    }
}
