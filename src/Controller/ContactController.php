<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Planning;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact-us', name: 'contact-us')]
    public function contact(ManagerRegistry $doctrine, Request $request, MailerInterface $mailer): Response
    {
        //Récupération du planning d'ouverture
        $repositoryPlanning = $doctrine->getRepository(Planning::class);
        $horaires = $repositoryPlanning->findAll();


        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('garage-parrot@gmail.com')
            ->subject($contact->getSubject() ? $contact->getSubject() : "Demande d'informations")
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'firstname' => $contact->getFirstname(),
                'lastname' => $contact->getLastname(),
                'telephone' => $contact->getTelNumber(),
                'message' => $contact->getMessage(),
                ]);
        
            $mailer->send($email);

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/form.html.twig', [
            "horaires" => $horaires,
            "contact_form" => $form->createView(),
        ]);
    }
}
