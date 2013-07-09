<?php

namespace Acme\ContactsBundle\Controller;

use Acme\ContactsBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    public function indexAction()
    {
        $isAjaxCall = $this->getRequest()->isXmlHttpRequest();
        if ($isAjaxCall) {
            $repository = $this->getDoctrine()->getRepository('AcmeContactsBundle:Contact');
            $contacts = $repository->findAll();
            
            $serializedEntity = $this->container->get('serializer')->serialize($contacts, 'json');
            return new Response($serializedEntity);        
        }

        return $this->render('AcmeContactsBundle:Default:index.html.twig', array(
//            'name' => 'test',
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
