<?php

namespace App\Stars\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $stars = $app['repository.star']->getAll();
        $users = $app['repository.user']->getAll();

        return $app['twig']->render('stars.list.html.twig', array('stars' => $stars, 'users' => $users));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.star']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('stars.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $star = $app['repository.star']->getById($parameters['id']);
        $users = $app['repository.user']->getAll();
        return $app['twig']->render('stars.form.html.twig', array('star' => $star, 'users' => $users));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $star = $app['repository.star']->update($parameters);
        } else {
            $star = $app['repository.star']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('stars.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        $users = $app['repository.user']->getAll();
        return $app['twig']->render('stars.form.html.twig', array('users' => $users));
    }
}
