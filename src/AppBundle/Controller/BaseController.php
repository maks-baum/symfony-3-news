<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected function handleForm(string $type, $data, Request $request)
    {
        $form = $this->createForm($type, $data)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (!$em->contains($data)) {
                $em->persist($data);
            }
            $em->flush();
        }

        return $form;
    }
}