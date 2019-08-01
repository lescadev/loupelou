<?php

namespace App\Controller;

use App\Entity\ArticleBlog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController
    extends AbstractController
{

    /**
     * Liste des articles du blog
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $articles = $repo->findAll();

        return $this->render( 'blog/index.html.twig',
            [
                'articles' => $articles,
            ] );
    }

    /**
     * Affichage d'un article
     * @Route("/blog/{id}", name="blogArticle")
     */
    public function article( $id )
    {
        $repo = $this->getDoctrine()->getRepository( ArticleBlog::class );

        $article = $repo->find( $id );

        return $this->render( 'blog/article.html.twig',
            [
                "article" => $article,
            ] );
    }
}
