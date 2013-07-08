<?php

namespace Acme\ContactsBundle\Controller;

use Acme\ContactsBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AcmeContactsBundle:Contact');
        $contacts = $repository->findAll();

        return $this->render('AcmeContactsBundle:Default:index.html.twig', array(
            'name' => 'test'
//            'contacts' => $this->get('jms_serializer')->serialize($contacts, 'json')
        ));
    }

    public function createAction()
    {
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
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('AcmeStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        $product->setName('New product name!');
        $em->flush();
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
