<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Download;
use AppBundle\Form\SubFileType;
use AppBundle\Entity\SubFile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    public function fileAction(Request $request)
    {
        $subfile = new SubFile();

        $form = $this->createForm(SubFileType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form['brochure']->getData();
            $nameFile = $form['namefile']->getData();
            $subjectName =  $form['subjectname']->getData();
            //$typeName = $form['typename']->getData();

            if($brochureFile) {

                $brochureFileName = $nameFile.'-'.uniqid().'.'.$brochureFile->guessExtension();
                $extensionFile = $brochureFile->guessExtension();
                $time = new \DateTime();
                $nowTime = $time->format('d-m-Y');

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $brochureFileName
                    );
                } catch (FileException $e) {
                    //todo: error
                }

                $subfile->setNameFile($nameFile);
                $subfile->setExtensionFile($extensionFile);
                $subfile->setCreatedAt($nowTime);
                $subfile->setSubjectName($subjectName);
                $subfile->setBrochureFileName($brochureFileName);
                // $subfile->setTypeFile($typeName);

                try {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($subfile);
                    $entityManager->flush();
                    $this->addFlash('success_f','Pomyślnie dodano plik: '.$nameFile.' do bazy danych.');
                }catch(\Doctrine\DBAL\DBALException $e){
                    $this->addFlash('fault_f','Error: this file name already exist in database.');
                }
            }
        }

        if($form->isSubmitted() && !$form->isValid()) {
            $error = $form->getErrors(true);
            $this->addFlash('fault_f',$error);
        }

        $em = $this->getDoctrine()->getManager();
        $file = $em->getRepository(SubFile::class)->findAll();


        return $this->render('default/subfile.html.twig', [
            'form' => $form->createView(),
            'files' => $file,
        ]);
    }

    public function getFileAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $file = $em->getRepository(SubFile::class)->find($id);
        $fileName = $file->getNameFile();

        $user = $this->getUser();
        $userName = $user->getIndNumber();

        $ip = $request->getClientIp();

        $fullFileName = $file->getBrochureFileName();

        $pdfPath = $this->getParameter('brochures_directory').'/'.$fullFileName;

        $download = new Download();
        $download->setUser($userName);
        $download->setFile($fileName);
        $download->setIp($ip);

        $em->persist($download);
        $em->flush();

        return $this->file($pdfPath);
    }
}
