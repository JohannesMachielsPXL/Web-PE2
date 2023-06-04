<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Student;
use App\Entity\Image;
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Student
        $student = new Student();
        $student->setVoornaam('Wannes');
        $student->setAchternaam('Machiels');
        $student2 = new Student();
        $student2->setVoornaam('Kevin');
        $student2->setAchternaam('Theys');
        $student3 = new Student();
        $student3->setVoornaam('Lotte');
        $student3->setAchternaam('Jansen');
        $student4 = new Student();
        $student4->setVoornaam('Benjamin');
        $student4->setAchternaam('Vandendriessche');

        // Create a new Image
        $image = new Image();
        $image->setFilename('foto-wannes.jpg');
        $image->setPath('./Images/foto-wannes.jpg');
        $image2 = new Image();
        $image2->setFilename('foto-kevin.png');
        $image2->setPath('./Images/foto-kevin.png');
        $image3 = new Image();
        $image3->setFilename('foto-lotte.jpg');
        $image3->setPath('./Images/foto-lotte.jpg');
        $image4 = new Image();
        $image4->setFilename('foto-benjamin.png');
        $image4->setPath('./Images/foto-benjamin.png');

        // Associate the Image with the Student
        $student->setImage($image);
        $student2->setImage($image2);
        $student3->setImage($image3);
        $student4->setImage($image4);

        // Persist the entities
        $entityManager->persist($student);
        $entityManager->persist($student2);
        $entityManager->persist($student3);
        $entityManager->persist($student4);
        $entityManager->flush();

        // Retrieve the list of students with their images
        $students = $entityManager->getRepository(Student::class)->findAll();

        return $this->render('students.html.twig', [
            'students' => $students,
        ]);

    }
}
