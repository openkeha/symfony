<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/conferences/{id?2}", name="conference")
     */
    public function index(Conference $conference , CommentRepository $comments): Response
    {
        return $this->render('conference/index.html.twig', [
            'conference' => $conference,
            'comments' => $comments->findBy(['conference' => $conference], ['createdAt' => 'DESC']),
        ]);
    }

    /**
     * @Route("/", name="conferences")
     */
    public function comments(ConferenceRepository $conferences): Response
    {
        return $this->render('conference/conferences.html.twig', [
            'conferences' => $conferences->findAll(),
        ]);
    }
}