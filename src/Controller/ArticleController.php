<?php

namespace App\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_routes")
     */
    public function showArticles(ArticleRepository $ArticleRepository ): Response
    {
        $articles=$ArticleRepository->findAll();
        if(!$articles){
          throw $this->createNotFoundException("aucun articles trouvés");
        }
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_routes")
     */
    public function showArticle(int $id,ArticleRepository $ArticleRepository):Response
    {
        $article=$ArticleRepository->find($id);
        if(!$id)
        {
            throw $this->createNotFoundException("id incorrect");
        }
        return $this->render('articles/show.html.twig',[
            'article'=>$article,]);  
    }
     /**
     * @Route("/article/add",priority=2, name="article_new")
     */

    public function AddArticle(Request $request, EntityManagerInterface $entityManager):Response
    {
        $article=new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $article=$form->getData();
        $entityManager->persist($article);
        $entityManager->flush();
         return $this->render('articles/index.html.twig',[
            'article'=>$article
         ]);
        }
        return $this->render('articles/form.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Route("/article/edit/{id}",priority=3, name="article_udate")
     */

    public function editArticle(Article $article,EntityManagerInterface $entityManager):Response
    {
     if(!$article)
      {
        return $this->createNotFoundException("Aucun Article Correspand a cette ID");
      }
     $article->SetPrix(100);
     #permer d'executer la requete et d'envoyer a la BD tout ce qui a été persisté dans entity manager
     $entityManager->flush();
     return $this->redirectToRoute('articles_routes');
}
}