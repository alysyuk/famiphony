<?php

namespace Acme\ContactsBundle\Controller;

use Acme\ContactsBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
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
