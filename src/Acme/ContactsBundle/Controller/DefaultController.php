<?php

namespace Acme\ContactsBundle\Controller;

use Acme\ContactsBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AcmeContactsBundle:Contact');
        $contact = $repository->findAll();
        
        var_dump($contact); die;

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function createAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function storeAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function showAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function editAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function updateAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

    public function destroyAction($name)
    {
        $contact = new Contact();
        $contact->setLastName('A Foo Bar');
        $contact->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

//        return new Response('Created product id ' . $product->getId());
        return $this->render('AcmeContactsBundle:Default:index.html.twig', array('name' => $contact->getLastName()));
    }

}
