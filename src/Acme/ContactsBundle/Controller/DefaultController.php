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
            
            $serializedContacts = $this->container->get('serializer')->serialize($contacts, 'json');
            return new Response($serializedContacts);        
        }

        return $this->render('AcmeContactsBundle:Default:index.html.twig', array(
            
        ));
    }
    
    public function createAction()
    {
    }

    public function storeAction()
    {
        $isAjaxCall = $this->getRequest()->isXmlHttpRequest();
        if ($isAjaxCall) {
            $content = $this->get("request")->getContent(); 

            $contact = $this->container->get('serializer')->deserialize(
                $content,
                'Acme\ContactsBundle\Entity\Contact', 
                'json'
            );
            
            try {
                $em = $this->getDoctrine()->getEntityManager();
                $em->getConnection()->beginTransaction();     
                $em->persist($contact);
                $em->flush();

                $newContact = $em->getRepository('AcmeContactsBundle:Contact')->findOneBy(
                    array(
                        'email_address' => $contact->getEmailAddress()
                    )
                );

                $newSerializedContact = $this->container->get('serializer')
                                                        ->serialize($newContact, 'json');

                $em->getConnection()->commit();
            } catch (Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                throw $e;
            }
            
            return new Response($newSerializedContact);        
        }        

        return $this->render('AcmeContactsBundle:Default:index.html.twig', array(
            
        ));
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

    public function destroyAction($contactId)
    {
        $em = $this->getDoctrine()->getEntityManager();        
        $repository = $em->getRepository('AcmeContactsBundle:Contact');
        $contact = $repository->find($contactId);
        
        $em->remove($contact);
        $em->flush();
        
        return new Response('success', 200);    
    }

}
