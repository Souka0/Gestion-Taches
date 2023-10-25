<?php

namespace App\Controller;

use App\Entity\task;
use App\Form\TaskFormType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    private $em;
    private $taskRepository;
    public function __construct(TaskRepository $taskRepository , EntityManagerInterface $em) 
    {
        $this->taskRepository = $taskRepository;
        $this->em = $em;
    }


    #[Route('/tasks', name: 'tasks')]
    public function index(Request $request ,PaginatorInterface $paginator,TaskRepository $taskRepository): Response
    {
        $tasks = $this->taskRepository->findAll(); 
        $pagination = $paginator->paginate(

            $tasks,
            $request->query->get('page',1),
            5
        );

        return $this->render('tasks/index.html.twig',[
            'pagination' => $pagination
        ]);
    }

    #[Route('/tasks/addnewtask', name: 'add_task')]
    public function create(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskFormType::class, $task);
        
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            $newTask = $form->getData();

            $this->em->persist($newTask);
            $this->em->flush();

            return $this->redirectToRoute('tasks'); 
        }

        return $this->render('tasks/Addnewtask.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tasks/edittask/{id}', name: 'edit_task')]
    public function edit($id, Request $request ): Response 
    {
        $task = $this->taskRepository->find($id);
        $form = $this->createForm(TaskFormType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task->setTitre($form->get('Titre')->getData());
            $task->setDescription($form->get('Description')->getData());
            $task->setDateCreation($form->get('DateCreation')->getData());
            $task->setEtat($form->get('etat')->getData());

            $this->em->flush();
            return $this->redirectToRoute('tasks');

        }
        return $this->render('tasks/Editetask.html.twig', [
            'task' => $task,
            'form' => $form->createView()
        ]);
    }


    #[Route('/tasks/deletetask/{id}', methods: ['GET', 'DELETE'], name: 'delete_task')]
    public function delete($id): Response
    {
        $task = $this->taskRepository->find($id);
        $this->em->remove($task);
        $this->em->flush();

        return $this->redirectToRoute('tasks');
    }

    #[Route('/tasks/{id}', methods: ['GET'], name: 'read_tasks')]
    public function show($id): Response
    {
        $task = $this->taskRepository->find($id);
        
        return $this->render('tasks/ReadTask.html.twig', [
            'task' => $task
        ]);
    }

}
