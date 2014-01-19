<?php

namespace Acme\ContactsBundle\Controller;

use Acme\ContactsBundle\Entity\Contact;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @todo Refactor using Restbundle, cover by tests, Symfony form, check
 * how it is done in fapcu 
 */
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
    
    public function storeAction()
    {
        $isAjaxCall = $this->getRequest()->isXmlHttpRequest();
        if ($isAjaxCall) {
            $content = $this->get('request')->getContent(); 

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

    public function updateAction($contactId)
    {
        $requst = ($this->get('request'));
        $em = $this->getDoctrine()->getEntityManager();        
        $contact = $em->getRepository('AcmeContactsBundle:Contact')->find($contactId);
        
        if (!$contact) {
            throw $this->createNotFoundException('No contact found for id ' . $contactId);
        }
        
        $contact->setFirstName($requst->get('first_name'))
                ->setLastName($requst->get('last_name'))
                ->setEmailAddress($requst->get('email_address'))
                ->setDescription($requst->get('description'))
                ;
                
        $em->flush();
        
        return new Response('success', 200);           
    }

    public function destroyAction($contactId)
    {
        $em = $this->getDoctrine()->getEntityManager();        
        $contact = $em->getRepository('AcmeContactsBundle:Contact')->find($contactId);
        
        $em->remove($contact);
        $em->flush();
        
        return new Response('success', 200);    
    }

}
