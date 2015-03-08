<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    
    session_start();
    if (empty($_SESSION['contact_list'])) {
        $_SESSION['contact_list'] = array();
    }
    //session info goes here
    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' =>__DIR__."/../views"));

    //twig goes here

    $app->get("/", function() use ($app) {
        return $app['twig']->render('contacts.twig', array('contacts'=>Contact::getAll()));
    });

    $app->post("/contact_added", function() use ($app){
        $contact = new Contact($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['image']);
        $contact->save();

        return $app['twig']->render('contact_added.twig', array('new_contact'=> $contact));
    });

    $app->post("/delete", function() use ($app){
        return $app['twig']->render('delete.twig', array('contacts'=>Contact::deleteAll())); 
    });

    $app->post("/search", function() use ($app){
        $matching_contacts = array();

        foreach (Contact::getAll() as $contact){
            if ($contact->nameMatch($_POST['name'])){
                array_push($matching_contacts, $contact);
            }   
        }
        return $app['twig']->render('search.twig', array ('contact_search'=> $matching_contacts));
    });

    return $app;
?>
