<?php


use thecodeholicc\phpmvcc\db\Database;
use thecodeholicc\phpmvcc\db\DbModel;



class Application
{

    public static string $ROOT_DIR;
    public string $layout='main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;

    public View $view;
    public Database $db;
    public  Session  $session;

    public static Application $app;

    public  ?DbModel $user;

    public ?Controller $controller=null;

    public function __construct($rootPath, array $config)
    {

        $this->userClass=$config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view=new View();

        $primaryValue=$this->session->get('user');

            if ($primaryValue) {
                $primaryKey = $this->userClass::primaryKey();
                $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            }
            else
            {
                $this->user=null;
            }

    }

    public static function isquest()
    {
        return !self::$app->user;
    }


    public function run()
    {
        try {
            $this->router->resolve();
        }
        catch (\Exception $e)
        {
            $this->response->setStatusCode($e->getCode());

            echo  $this->view->renderView('error',[
                'exception'=>$e
            ]);
        }
    }


    public function getController():Controller
    {
        return $this->controller;
    }
    public function setController(Controller $controller):void
    {
        $this->controller = $controller;
    }



    public function login(DbModel $user)
    {
        $this->user=$user;
        $primaryKey=$user->primaryKey();
        $primaryValue=$user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user=null;
        $this->session->remove('user');
    }



}