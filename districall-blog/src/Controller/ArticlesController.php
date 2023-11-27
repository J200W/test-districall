<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    private $em;

    private $articleRepository;

    public function __construct(EntityManagerInterface $em, ArticleRepository $articleRepository)
    {
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }
    
    #[Route(path:"", name:"", methods: ["GET"])]
    public function home(): Response
    {
        return $this->redirectToRoute("articles");
    }

    #[Route('/articles', name: 'articles')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findAll();
        
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}