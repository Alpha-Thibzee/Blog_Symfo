<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil/{slug}', name: 'app_profil')]
    public function show(UserRepository $repo, $slug): Response
    {
        $user = $repo->findOneBy(['slug' => $slug]);
        return $this->render('profil/show.html.twig', [
            'user' => $user,
            'controller_name' => 'ProfilController',
        ]);
    }
}
