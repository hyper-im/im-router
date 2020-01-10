<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Exception\ServiceException;
use App\Exception\ValidateException;
use Hyperf\HttpMessage\Cookie\Cookie;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Annotation\Controller as AnnotationController;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @AnnotationController(prefix="/v1/index")
 */
class IndexController extends Controller
{
    /**
     * @RequestMapping(path="index")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $data = [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
        return $data;
    }

    /**
     * @RequestMapping(path="demo")
     */
    public function demo(ResponseInterface $response)
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $data = [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
        return $response->json($data);
    }

    /**
     * @RequestMapping(path="cookie")
     */
    public function cookie()
    {
        $cookie = new Cookie('cookie-hy', 'xiaoz');
        var_dump($cookie);
        return $this->response->withCookie($cookie)->withContent('Hello Hyperf.');
    }

    /**
     * @RequestMapping(path="v")
     */
    public function validate(){
        throw new ValidateException(null);
    }

    /**
     * @RequestMapping(path="s")
     */
    public function service(){
        throw new ServiceException("ServiceException异常抛出");
    }

}
