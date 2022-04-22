<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserFixtures extends Fixture
{

    private $encoder;
    private $slug;

    public function __construct(UserPasswordHasherInterface $encoder,  SluggerInterface $slug)
    {
        $this->encoder = $encoder;
        $this->slug = $slug;

    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@admin.fr")
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->encoder->hashPassword($admin, 'adminadmin'))
            ->setName("Thibzee le roi")
            ->setAvatar("NoAvailable.png")
            ->setSlug(strtolower($this->slug->slug($admin->getName().'-'.rand(100,999))));
            

        $manager->persist($admin);

        $user = new User();
        $user->setEmail("user@user.fr")
            ->setRoles(["ROLE_USER"])
            ->setPassword($this->encoder->hashPassword($user, 'user'))
            ->setName("Thibzee le simple user")
            ->setAvatar("NoAvailable.png")
            ->setSlug(strtolower($this->slug->slug($user->getName().'-'.rand(100,999))));

        $manager->persist($user);

        $manager->flush();
    }
}
