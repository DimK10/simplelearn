<?php

namespace App\Tests\Controller;

use App\Controller\LessonController;
use App\Converter\LessonToLessonDTO;
use App\Dto\LessonDTO;
use App\Entity\Lesson;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Service\UserService;
use App\Tests\util\ClientFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\AmpHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LessonControllerTest extends TestCase
{

    /**
     * @throws TransportExceptionInterface
     */
    public function testIndex()
    {
        // Given
        $admin = new User();
        $admin->setId(1);

        $lessons = [];
        $lesson1 = new Lesson();
        $lesson1->setId(1);

        $lesson2 = new Lesson();
        $lesson2->setId(2);

        array_push($lessons, $lesson1, $lesson2);

        $lessonDTOs = [];
        $lessonDTO1 = new LessonDTO();
        $lessonDTO1->setId(1);

        $lessonDTO2 = new LessonDTO();
        $lessonDTO2->setId(2);

        array_push($lessonDTOs, $lessonDTO1, $lessonDTO2);

        $client = ClientFactory::createAuthenticatedClient();

        // When
        $matcher = $this->createMock(UrlMatcherInterface::class);

//        $userServiceMock = $this->createMock(UserService::class);
//        $userServiceMock->expects(self::once())
//            ->method('getCurrentUser')
//            ->willReturn($admin);

        $lessonToLessonDTOMock = $this->createMock(LessonToLessonDTO::class);
        $lessonToLessonDTOMock->expects(self::any())
            ->method('convert');

        $lessonRepository = $this->createMock(LessonRepository::class);
//        $lessonRepository->expects(self::once())
//            ->method('getAllLessonsForTutor')
//            ->with($admin, 0, 10)
//            ->willReturn($lessons);



        // Then
        /**
         * @var HttpClientInterface $client
         */
//        $client = HttpClient::create();

        $response = $client->request('GET', 'http://localhost:8000/api/lessons/tutor/0/10');

//        $matcher->expects($this->once())
//            ->method("match")
//            ->will($this->returnValue([
//                '_route' => '/api/lessons/tutor/{pageNo}/{numOfRecords}',
//                'pageNo' => '0',
//                'numOfRecords' => 10,
//                '_controller' => [new LessonController($userServiceMock, $lessonToLessonDTOMock), 'index']
//            ]));
//        $matcher
//            ->expects($this->once())
//            ->method('getContext')
//            ->will($this->returnValue($this->createMock(RequestContext::class)))
//        ;
//
//        $controllerResolver = new ControllerResolver();
//        $argumentResolver = new ArgumentResolver();
//
//        $framework = new Framework($matcher, $controllerResolver, $argumentResolver);
//
//        $response = $framework->handle(new Request());

        $this->assertEquals(200, $response->getStatusCode());
    }
}
